<?php

namespace app\modules\fe_edoc\controllers;

use Yii;
use app\modules\fe_edoc\models\NubeFactura;
use app\modules\fe_edoc\models\VSDirectorio;
use app\modules\fe_edoc\models\VSDocumentos;
use app\modules\fe_edoc\models\VSFirmaDigital;
use app\modules\fe_edoc\models\VSexception;
use app\modules\fe_edoc\models\VSacceso;
use app\modules\fe_edoc\models\mailSystem;
use app\modules\fe_edoc\models\USUARIO;
use app\models\ExportFile;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

class NubefacturaController extends \app\components\CController {

    public $pdf_numeroaut = "";
    public $pdf_numero = "";
    public $pdf_nom_empresa = "";
    public $pdf_ruc = "";
    public $pdf_num_contribuyente = "";
    public $pdf_contabilidad = "";
    public $pdf_dir_matriz = "";
    public $pdf_dir_sucursal = "";
    public $pdf_fec_autorizacion = "";
    public $pdf_emision = "";
    public $pdf_ambiente = "";
    public $pdf_cla_acceso = "";
    public $pdf_tipo_documento = "";
    public $pdf_cod_barra = "";

    public function actionIndex() {
        $modelo = new NubeFactura();
        $tipDoc= new VSDirectorio();
        $aproba= new VSacceso();
        $contBuscar = array();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter'] || $data['page']) {
            //$contBuscar = isset($_POST['CONT_BUSCAR']) ? json_encode($_POST['CONT_BUSCAR']) : array();
            //echo CJSON::encode($modelo->mostrarDocumentos($contBuscar));
            $arrayData = array();
            $contBuscar = isset($data['CONT_BUSCAR']) ? json_decode($data['CONT_BUSCAR'],true) : array();
            //$contBuscar[0]['PAGE'] = isset($data['page']) ? $data['page'] : 0;
            $arrayData = $modelo->mostrarDocumentos($contBuscar);
            return $this->render('_indexGrid', array(
                'model' => $arrayData,
                    ));
        }
        if (Yii::$app->request->isAjax) {
            $valor = isset($_POST['valor']) ? $_POST['valor'] : "";
            $op = isset($_POST['op']) ? $_POST['op'] : "";
            $arrayData = array();
            $arrayData = $modelo->retornarPersona($valor, $op);
            header('Content-type: application/json');
            echo json_encode($arrayData);
            return;
        }
        //$this->view->title = Yii::t('DOCUMENTOS', 'Bills');
        return $this->render('index', array(
            //'dataProvider' => $dataProvider,
            'model' => $modelo->mostrarDocumentos($contBuscar),
            'tipoDoc' => $tipDoc->recuperarTipoDocumentos(),
            'tipoApr' => $aproba->tipoAprobacion(),
        ));
    }

    public function actionGenerarpdf($ids) {//ok
        try {
            $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
            $rep = new ExportFile();
            //$this->layout = false;
            $this->layout = '@modules/fe_edoc/views/tpl_fe/main';
            //$this->view->title = "Invoices";
            $modelo = new NubeFactura(); //Ejmpleo code 3
            $cabFact = $modelo->mostrarCabFactura($ids);
            $detFact = $modelo->mostrarDetFacturaImp($ids);
            $impFact = $modelo->mostrarFacturaImp($ids);
            $pagFact = $modelo->mostrarFormaPago($ids);
            $adiFact = $modelo->mostrarFacturaDataAdicional($ids);
            $venFact= VSDocumentos::buscarDatoVendedor($cabFact['USU_ID']);//DATOS DEL VENDEDOR QUE AUTORIZO

            $this->pdf_numeroaut = $cabFact['AutorizacionSri'];
            $this->pdf_numero = $cabFact['NumDocumento'];
            $this->pdf_nom_empresa = $cabFact['RazonSocial'];
            $this->pdf_ruc = $cabFact['Ruc'];
            $this->pdf_num_contribuyente = $cabFact['ContribuyenteEspecial'];
            $this->pdf_contabilidad = $cabFact['ObligadoContabilidad'];
            $this->pdf_dir_matriz = $cabFact['DireccionMatriz'];
            $this->pdf_dir_sucursal = $cabFact['DireccionEstablecimiento'];
            $this->pdf_fec_autorizacion = $cabFact['FechaAutorizacion'];
            $this->pdf_emision = \app\modules\fe_edoc\Module::t("fe", 'NORMAL');//$cabFact['TipoEmision'];
            $this->pdf_ambiente = ($cabFact['Ambiente']==1)? \app\modules\fe_edoc\Module::t("fe", 'PRODUCTION'): \app\modules\fe_edoc\Module::t("fe", 'TEST');
            $this->pdf_cla_acceso = $cabFact['ClaveAcceso'];
            $this->pdf_tipo_documento = \app\modules\fe_edoc\Module::t("fe", 'INVOICE');
            $this->pdf_cod_barra = "";

            $rep->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical   
            
            $rep->createReportPdf(
                $this->render('@modules/fe_edoc/views/tpl_fe/factura', [
                    'cabFact' => $cabFact,
                    'detFact' => $detFact,
                    'impFact' => $impFact,
                    'pagFact' => $pagFact,
                    'adiFact' => $adiFact,
                    'venFact' => $venFact,
                ])
            );
            $rep->mpdf->Output('FACTURA_' . $cabFact['NumDocumento'] . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD); 
            //exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionBuscaDataIndex() {
        if (Yii::$app->request->isAjax) {
            $arrayData = array();
            $obj = new NubeFactura();
            $contBuscar = isset($_POST['CONT_BUSCAR']) ? json_encode($_POST['CONT_BUSCAR']) : array();
            $arrayData = $obj->mostrarDocumentos($contBuscar);
            return $this->render('_indexGrid', array(
                'model' => $arrayData,));
        }
    }

    public function actionXmlautorizado($ids) {//ok
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $modelo = new NubeFactura();
        $nomDocfile= array();
        $nomDocfile=$modelo->mostrarRutaXMLAutorizado($ids);
        if ($nomDocfile["EstadoDocumento"] == "AUTORIZADO") { // Si retorna un Valor en el Array
            $nombreDocumento = $nomDocfile["NombreDocumento"];
            //echo "file created";exit;
            header('Content-type: text/xml');   // i am getting error on this line
            //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)
            header('Content-Disposition: Attachment; filename="' . $nombreDocumento . '"');
            // File to download
            readfile($nomDocfile["DirectorioDocumento"] . $nombreDocumento);        // i am not able to download the same file
        } else {
            echo "Documento No autorizado";
        }
    }

    public function actionEnviarCorreccion() {
        if (Yii::$app->request->isAjax) {
            $modelo = new NubeRetencion(); //Ejmpleo code 3
            $errAuto= new VSexception();
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $result=VSDocumentos::anularDodSri($ids,'FA',5);//Anula Documentos Retenciones del Sistema
            $arroout=$errAuto->messageSystem('NO_OK',null, 1, null, null);
            if($result['status'] == 'OK'){//Si es Verdadero actualizo datos de base intermedia
                $result=VSDocumentos::corregirDocSEA($ids,'FA');
                if($result['status'] == 'OK'){
                    $arroout=  $errAuto->messageSystem('OK', null,12,null, null);
                }
            }
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionEnviarAnular() {
        if (Yii::$app->request->isAjax) {
            $dataMail = new mailSystem;
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $arroout=VSDocumentos::anularDodSri($ids, 'FA',8);//Anula Documentos Autorizados del Websea
            if($arroout['status'] == 'OK'){//Si es Verdadero actualizo datos de base intermedia
                $CabPed=VSDocumentos::enviarInfoDodSri($ids,'FA');
                $DatVen=VSDocumentos::buscarDatoVendedor($CabPed["UsuId"]);//Datos del Vendedor que AUTORIZO
                $htmlMail = $this->render('mensaje', array(
                'CabPed' => $CabPed,
                'DatVen' => $DatVen,
                    ));
                $Subject = "Ha Recibido un(a) Orden de Anulación!!!";
                $dataMail->enviarMailInforma($htmlMail,$CabPed,$DatVen,$Subject,1);//Notificacion a Usuarios
            }
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionEnviarCorreo() {
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $arroout=VSDocumentos::reenviarDodSri($ids, 'FA',2);//Anula Documentos Autorizados del Websea
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionUpdatemail($id) {
        $model = new USUARIO;
        $model = $model->getMailUserDoc($id,'FA');
        return $this->render('updatemail', array(
            'model' => $model,
        ));
    }
    public function actionSavemail() {
        $model = new USUARIO;
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ID']) ? $_POST['ID'] : 0;
            $correo = isset($_POST['DATA']) ? trim($_POST['DATA']) : '';
            $arrayData = $model->cambiarMailDoc($ids,$correo);
            header('Content-type: application/json');
            echo json_encode($arrayData);
            return;
        }
    }

}
