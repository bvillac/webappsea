<?php

/**
 * This is the model class for table "VSCompania".
 *
 * The followings are the available columns in table 'VSCompania':
 * @property string $IdCompania
 * @property string $Ruc
 * @property string $RazonSocial
 * @property string $NombreComercial
 * @property string $Mail
 * @property integer $EsContribuyente
 * @property string $Direccion
 * @property string $UsuarioCreacion
 * @property string $FechaCreacion
 * @property string $UsuarioModificacion
 * @property string $FechaModificacion
 * @property string $UsuarioEliminacion
 * @property string $FechaEliminacion
 * @property string $Estado
 *
 * The followings are the available model relations:
 * @property VSAlerta[] $vSAlertas
 * @property VSCertificadoDigital[] $vSCertificadoDigitals
 * @property VSClaveContingencia[] $vSClaveContingencias
 * @property VSDirectorio[] $vSDirectorios
 * @property VSFirmaDigital[] $vSFirmaDigitals
 * @property VSProceso[] $vSProcesos
 * @property VSServiciosSRI[] $vSServiciosSRIs
 * @property VSServidorCorreo[] $vSServidorCorreos
 * @property VSUsuario[] $vSUsuarios
 */
namespace app\modules\fe_edoc\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;
use yii\base\Exception;

class VSCompania extends \app\modules\fe_edoc\components\CActiveRecord {

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('IdCompania, Ruc', 'required'),
            array('EsContribuyente', 'numerical', 'integerOnly' => true),
            array('IdCompania', 'length', 'max' => 20),
            array('Ruc', 'length', 'max' => 50),
            array('RazonSocial, NombreComercial, Direccion', 'length', 'max' => 300),
            array('Mail', 'length', 'max' => 100),
            array('UsuarioCreacion, UsuarioModificacion, UsuarioEliminacion', 'length', 'max' => 150),
            array('Estado', 'length', 'max' => 1),
            array('FechaCreacion, FechaModificacion, FechaEliminacion', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdCompania, Ruc, RazonSocial, NombreComercial, Mail, EsContribuyente, Direccion, UsuarioCreacion, FechaCreacion, UsuarioModificacion, FechaModificacion, UsuarioEliminacion, FechaEliminacion, Estado', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'vSAlertas' => array(self::HAS_MANY, 'VSAlerta', 'IdCompania'),
            'vSCertificadoDigitals' => array(self::HAS_MANY, 'VSCertificadoDigital', 'IdCompania'),
            'vSClaveContingencias' => array(self::HAS_MANY, 'VSClaveContingencia', 'IdCompania'),
            'vSDirectorios' => array(self::HAS_MANY, 'VSDirectorio', 'IdCompania'),
            'vSFirmaDigitals' => array(self::HAS_MANY, 'VSFirmaDigital', 'IdCompania'),
            'vSProcesos' => array(self::HAS_MANY, 'VSProceso', 'IdCompania'),
            'vSServiciosSRIs' => array(self::HAS_MANY, 'VSServiciosSRI', 'IdCompania'),
            'vSServidorCorreos' => array(self::HAS_MANY, 'VSServidorCorreo', 'IDCompania'),
            'vSUsuarios' => array(self::HAS_MANY, 'VSUsuario', 'IdCompania'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IdCompania' => 'Id Compania',
            'Ruc' => 'Ruc',
            'RazonSocial' => 'Razon Social',
            'NombreComercial' => 'Nombre Comercial',
            'Mail' => 'Mail',
            'EsContribuyente' => 'Es Contribuyente',
            'Direccion' => 'Direccion',
            'UsuarioCreacion' => 'Usuario Creacion',
            'FechaCreacion' => 'Fecha Creacion',
            'UsuarioModificacion' => 'Usuario Modificacion',
            'FechaModificacion' => 'Fecha Modificacion',
            'UsuarioEliminacion' => 'Usuario Eliminacion',
            'FechaEliminacion' => 'Fecha Eliminacion',
            'Estado' => 'Estado',
        );
    }

    /**
     * Función que muestra los Usuario de Ficha Medica con Busquedas.
     *
     * @author Byron Villacreses
     * @access public
     * @return Un Array con Datos Seleccionados
     */
    public function mostrarCompanias() {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        
        $sql = "SELECT A.EMP_ID IdCompania,A.EMP_RUC Ruc,A.EMP_RAZONSOCIAL RazonSocial,A.EMP_NOM_COMERCIAL NombreComercial,A.EMP_DIRECCION_MATRIZ DireccionMatriz 
                    FROM " . $con->dbname . ".EMPRESA A WHERE A.EMP_EST_LOG='1'";
        
        $rawData = $con->createCommand($sql)->queryAll();
        
        return new ArrayDataProvider(array(
                    'key' => 'IdCompania',
                    'allModels' => $rawData,
                    'sort' => array(
                        'attributes' => array(
                            'IdCompania', 'Ruc', 'RazonSocial', 'NombreComercial', 'DireccionMatriz',
                        ),
                    ),
                    //'totalItemCount' => count($rawData),
                    'pagination' => array(
                        'pageSize' => Yii::$app->params['pageSize'],
                    //'itemCount'=>count($rawData),
                    ),
                ));
        
    }
    
    public function insertarEmpresa($objEmp) {
        $con = Yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            //$objEmp[0]['UsuarioCreacion']= Yii::$app->session->get('user_name', FALSE);//Define el usuario Session
            $this->insertarDatosEmpresa($con, $objEmp);
            $idEmp = $con->getLastInsertID($con->dbname.'.EMPRESA');
            $this->datoFirmaDigital($con, $objEmp, $idEmp);
            $trans->commit();
            return true;
        } catch (Exception $e) {
            $trans->rollback();
            throw $e;
            return false;
        }
    }
    
    private function insertarDatosEmpresa($con, $objEmp) {
        
        $sql = "INSERT INTO " . $con->dbname . ".EMPRESA
            (EMP_RUC,EMP_RAZONSOCIAL,EMP_NOM_COMERCIAL,EMP_AMBIENTE,EMP_TIPO_EMISION,EMP_DIRECCION_MATRIZ,EMP_OBLIGA_CONTABILIDAD,EMP_CONTRI_ESPECIAL,
            EMP_TELEFONO,EMP_EMAIL,EMP_EMAIL_DIGITAL,EMP_EMAIL_CONTA,EMP_MONEDA,EMP_WEBSITE,USUARIO,EMP_EST_LOG)VALUES(
                '" . $objEmp[0]['Ruc'] . "',
                 '" . $objEmp[0]['RazonSocial'] . "',
                 '" . $objEmp[0]['NombreComercial'] . "',
                 '" . $objEmp[0]['Ambiente'] . "',
                 '" . $objEmp[0]['TipoEmision'] . "',
                 '" . $objEmp[0]['DireccionMatriz'] . "',
                 '" . $objEmp[0]['ObligadoContabilidad'] . "',
                 '" . $objEmp[0]['EsContribuyente'] . "',
                 '" . $objEmp[0]['Telefono'] . "',
                 '" . $objEmp[0]['Mail'] . "',
                 '" . $objEmp[0]['CorreoElectonico'] . "',
                 '" . $objEmp[0]['CorreoContador'] . "',
                 '" . $objEmp[0]['Moneda'] . "',
                 '" . $objEmp[0]['Website'] . "',               
                 '" . Yii::$app->session->get('user_name', FALSE) . "',
                 '1')";

        
        /*$sql = "INSERT INTO " . $con->dbname . ".VSCompania
                (Ruc,RazonSocial,NombreComercial,Mail,ContribuyenteEspecial,DireccionMatriz,UsuarioCreacion,FechaCreacion,Estado)VALUES();*/
        //echo $sql;
        $command = $con->createCommand($sql);
        $command->execute();
    }
    private function datoFirmaDigital($con, $objEmp,$idEmp) {
        $sql = "INSERT INTO " . $con->dbname . ".VSFirmaDigital 
                (IdCompania,Clave,RutaFile,FechaCaducidad,EmpresaCertificadora,UsuarioCreacion,FechaCreacion,Estado)VALUES(
                " . $idEmp . ",
                '" . $objEmp[0]['Clave'] . "',
                '" . $objEmp[0]['RutaFirma'] . "',
                '" . $objEmp[0]['FechaCaducidad'] . "',
                '" . $objEmp[0]['EmpresaCertificadora'] . "',
                '" . Yii::$app->session->get('user_id', FALSE) . "',
                CURRENT_TIMESTAMP(),
                 '" . $objEmp[0]['Estado'] . "')";

        //DATE(" . $cabOrden[0]['CDOR_FECHA_INGRESO'] . "),
        //echo $sql;
        $command = $con->createCommand($sql);
        $command->execute();
    }
    
    public function removerEmpresa($ids) {
        $con = Yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            $sql = "UPDATE " . $con->dbname . ".EMPRESA SET EMP_EST_LOG='0' WHERE EMP_ID IN($ids)";
            $comando = $con->createCommand($sql);
            $comando->execute();
            $trans->commit();
            return true;
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            $trans->rollBack();
            throw $e;
            return false;
        }
    }
    
    public function recuperarEmpresa($id) {
        //$con = Yii::$app->db_edoc;
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.EMP_ID IdCompania,A.EMP_RUC Ruc,A.EMP_RAZONSOCIAL RazonSocial,A.EMP_NOM_COMERCIAL NombreComercial,
            A.EMP_AMBIENTE Ambiente,A.EMP_TIPO_EMISION TipoEmision,A.EMP_DIRECCION_MATRIZ DireccionMatriz,A.EMP_OBLIGA_CONTABILIDAD ObligadoContabilidad,
            A.EMP_MONEDA Moneda,A.EMP_TELEFONO Telefono,A.EMP_EMAIL Correo,A.EMP_EMAIL_DIGITAL CorreoDigital,A.EMP_EMAIL_CONTA CorreoContador,A.EMP_WEBSITE Website,
            A.EMP_CONTRI_ESPECIAL EsContribuyente,B.Clave,B.FechaCaducidad,B.EmpresaCertificadora 
	FROM " . $con->dbname . ".EMPRESA A
		LEFT JOIN " . $con->dbname . ".VSFirmaDigital B
			ON A.EMP_ID=B.EMP_ID
        WHERE A.EMP_EST_LOG=1 AND A.EMP_ID='$id'";
        
        //echo $sql;
        return $con->createCommand($sql)->query();
    }
    
    public function actualizarEmpresa($objEmp) {
        $con = Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            //$objEmp[0]['UsuarioModificacion']= Yii::$app->session->get('user_name', FALSE);//Define el usuario Session
            $this->actualizaEmpresa($con, $objEmp); //Actiañoza datos de la Empresa
            $this->actualizaFirmaDigital($con, $objEmp); //Actiañoza datos de la Firma Digital
            
            $trans->commit();
            return true;
        } catch (Exception $e) {
            $trans->rollback();
            throw $e;
            return false;
        }
    }
    
    private function actualizaEmpresa($con, $objEmp) {
         $sql = "UPDATE " . $con->dbname . ".EMPRESA SET
                    EMP_RUC = '" . $objEmp[0]['Ruc'] . "',
                    EMP_RAZONSOCIAL = '" . $objEmp[0]['RazonSocial'] . "',
                    EMP_NOM_COMERCIAL = '" . $objEmp[0]['NombreComercial'] . "',
                    EMP_EMAIL = '" . $objEmp[0]['Mail'] . "',
                    EMP_CONTRI_ESPECIAL = '" . $objEmp[0]['EsContribuyente'] . "',   
                    EMP_OBLIGA_CONTABILIDAD = '" . $objEmp[0]['ObligadoContabilidad'] . "',
                    EMP_AMBIENTE = '" . $objEmp[0]['Ambiente'] . "',
                    EMP_TIPO_EMISION = '" . $objEmp[0]['TipoEmision'] . "',
                    EMP_TELEFONO = '" . $objEmp[0]['Telefono'] . "',
                    EMP_DIRECCION_MATRIZ = '" . $objEmp[0]['DireccionMatriz'] . "',                        
                    EMP_EMAIL_DIGITAL = '" . $objEmp[0]['CorreoElectonico'] . "',
                    EMP_EMAIL_CONTA = '" . $objEmp[0]['CorreoContador'] . "',
                    EMP_MONEDA = '" . $objEmp[0]['Moneda'] . "',
                    EMP_WEBSITE = '" . $objEmp[0]['Website'] . "',
                    EMP_FEC_MOD = CURRENT_TIMESTAMP()
                WHERE EMP_ID=" . $objEmp[0]['IdCompania'] . " ";
        //echo $sql;
        $command = $con->createCommand($sql);
        $command->execute();
    }
    
    private function actualizaFirmaDigital($con, $objEmp) {
        $sql = "UPDATE " . $con->dbname . ".VSFirmaDigital SET
                    Clave = '" . base64_encode($objEmp[0]['Clave']) . "',
                    RutaFile = '" . base64_encode($objEmp[0]['RutaFirma']) . "',
                    FechaCaducidad = '" . $objEmp[0]['FechaCaducidad'] . "',
                    EmpresaCertificadora = '" . $objEmp[0]['EmpresaCertificadora'] . "',
                    UsuarioModificacion = '" . Yii::$app->session->get('user_id', FALSE) . "',
                    FechaModificacion = CURRENT_TIMESTAMP()
                WHERE IdCompania=" . $objEmp[0]['IdCompania'] . " ";
        //echo $sql;
        $command = $con->createCommand($sql);
        $command->execute();
    }

}
