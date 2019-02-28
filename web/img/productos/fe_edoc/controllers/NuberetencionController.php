<?php

namespace app\modules\fe_edoc\controllers;

use Yii;
use app\modules\fe_edoc\models\VSacceso;
use app\modules\fe_edoc\models\VSDirectorio;
use app\modules\fe_edoc\models\VSDocumentos;
use app\modules\fe_edoc\models\VSexception;
use app\modules\fe_edoc\models\mailSystem;
use app\modules\fe_edoc\models\REPORTES;
use app\modules\fe_edoc\models\USUARIO;
use app\modules\fe_edoc\models\NubeRetencion;
use app\models\ExportFile;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

class NuberetencionController extends \app\components\CController  {

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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        return $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new NubeRetencion;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NubeRetencion'])) {
            $model->attributes = $_POST['NubeRetencion'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->IdRetencion));
        }

        return $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NubeRetencion'])) {
            $model->attributes = $_POST['NubeRetencion'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->IdRetencion));
        }

        return $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $modelo = new NubeRetencion();
        $aproba= new VSacceso();
        $tipDoc= new VSDirectorio();
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
        //$this->view->title = Yii::t('DOCUMENTOS', 'Proof of retention');
        return $this->render('index', array(
            'model' => $modelo->mostrarDocumentos($contBuscar),
            'tipoDoc' => $tipDoc->recuperarTipoDocumentos(),
            'tipoApr' => $aproba->tipoAprobacion(),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new NubeRetencion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NubeRetencion']))
            $model->attributes = $_GET['NubeRetencion'];

        return $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return NubeRetencion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = NubeRetencion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param NubeRetencion $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nube-retencion-form') {
            echo CActiveForm::validate($model);
            Yii::$app->end();
        }
    }
    
    public function actionBuscarPersonas() {
        if (Yii::$app->request->isAjax) {
            $valor = isset($_POST['valor']) ? $_POST['valor'] : "";
            $op = isset($_POST['op']) ? $_POST['op'] : "";
            $arrayData = array();
            $data = new NubeRetencion();
            $arrayData = $data->retornarPersona($valor, $op);
            header('Content-type: application/json');
            echo json_encode($arrayData);
        }
    }
    
    public function actionGenerarpdf($ids) {
        try {
            $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
            $rep = new ExportFile();
            $this->layout = '@modules/fe_edoc/views/tpl_fe/main';
            $modelo = new NubeRetencion(); //Ejmpleo code 3
            $cabDoc = $modelo->mostrarCabRetencion($ids);
            $detDoc = $modelo->mostrarDetRetencion($ids);
            $adiDoc = $modelo->mostrarRetencionDataAdicional($ids);

            $this->pdf_numeroaut = $cabDoc['AutorizacionSRI'];
            $this->pdf_numero = $cabDoc['NumDocumento'];
            $this->pdf_nom_empresa = $cabDoc['RazonSocial'];
            $this->pdf_ruc = $cabDoc['Ruc'];
            $this->pdf_num_contribuyente = $cabDoc['ContribuyenteEspecial'];
            $this->pdf_contabilidad = $cabDoc['ObligadoContabilidad'];
            $this->pdf_dir_matriz = $cabDoc['DireccionMatriz'];
            $this->pdf_dir_sucursal = $cabDoc['DireccionEstablecimiento'];
            $this->pdf_fec_autorizacion = $cabDoc['FechaAutorizacion'];
            $this->pdf_emision = \app\modules\fe_edoc\Module::t("fe", 'NORMAL');//$cabDoc['TipoEmision'];
            $this->pdf_ambiente = ($cabDoc['Ambiente'] == 1) ? \app\modules\fe_edoc\Module::t("fe", 'PRODUCTION') : \app\modules\fe_edoc\Module::t("fe", 'TEST');
            $this->pdf_cla_acceso = $cabDoc['ClaveAcceso'];
            $this->pdf_tipo_documento = \app\modules\fe_edoc\Module::t("fe", 'VOUCHER RETENTION');
            $this->pdf_cod_barra = "";
            
            //$Titulo=Yii::$app->getSession()->get('RazonSocial', FALSE) . " - " . $cabDoc['NombreDocumento'];
            //$nameFile=$cabDoc['NombreDocumento'] . '-' . $cabDoc['NumDocumento'];
            $rep->createReportPdf(
                    $this->render('@modules/fe_edoc/views/tpl_fe/retencion', array(
                        'cabDoc' => $cabDoc,
                        'detDoc' => $detDoc,
                        'adiDoc' => $adiDoc,
                                ))
                    );
             $rep->mpdf->Output('COMPROBANTE DE RETENCION_' . $cabDoc['NumDocumento'] . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
            //exit;
        } catch (Exception $e) {
            \app\models\Utilities::putMessageLogFile($e);
            $this->errorControl($e);
        }
    }
    
    public function actionXmlautorizado($ids) {
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $modelo = new NubeRetencion();
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
            $cabDoc = $modelo->mostrarCabRetencion($ids);
            $tipDoc=substr($cabDoc['CodigoTransaccionERP'], 0, 2);//Devuelve las 2 primero caracters sean CO Y PP
            $result=VSDocumentos::anularDodSri($ids, 'RT',5);//Anula Documentos Retenciones del Sistema
            $arroout=$errAuto->messageSystem('NO_OK',null, 1, null, null);
            if($result['status'] == 'OK'){//Si es Verdadero actualizo datos de base intermedia
                $result=VSDocumentos::corregirDocSEA($ids, $tipDoc);
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
            $arroout=VSDocumentos::anularDodSri($ids, 'RT',8);//Anula Documentos Autorizados del Websea
            if($arroout['status'] == 'OK'){//Si es Verdadero actualizo datos de base intermedia
                $CabPed=VSDocumentos::enviarInfoDodSri($ids,'RT');
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
            $arroout=VSDocumentos::reenviarDodSri($ids, 'RT',2);//Anula Documentos Autorizados del Websea
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionUpdatemail($id) {
        $model = new USUARIO;
        $model = $model->getMailUserDoc($id,'RT');
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
