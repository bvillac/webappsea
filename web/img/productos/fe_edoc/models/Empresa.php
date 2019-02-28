<?php

/**
 * This is the model class for table "EMPRESA".
 *
 * The followings are the available columns in table 'EMPRESA':
 * @property string $EMP_ID
 * @property string $EMP_RUC
 * @property string $EMP_RAZONSOCIAL
 * @property string $EMP_NOM_COMERCIAL
 * @property string $EMP_TIPO
 * @property string $EMP_TELEFONO
 * @property string $EMP_FAX
 * @property string $EMP_DIRECCION
 * @property string $EMP_CORREO
 * @property string $EMP_LOGO
 * @property string $EMP_EST_LOG
 * @property string $EMP_FEC_MOD
 * @property string $EMP_FEC_CRE
 *
 * The followings are the available model relations:
 * @property USUARIOEMPRESA[] $uSUARIOEMPRESAs
 */

namespace app\modules\fe_edoc\models;

class Empresa extends \app\modules\fe_edoc\components\CActiveRecord {

    public function buscarDataEmpresa($emp_id,$est_id,$pemi_id) {
        $conApp = Yii::$app->db_edoc;
        $rawData = array();
        $sql = "SELECT A.emp_id,A.emp_ruc Ruc,A.emp_razonsocial RazonSocial,A.emp_nom_comercial NombreComercial,
                    A.emp_ambiente Ambiente,A.emp_tipo_emision TipoEmision,A.emp_direccion_matriz DireccionMatriz,B.est_direccion DireccionSucursal,
                    A.emp_obliga_contabilidad ObligadoContabilidad,A.emp_contri_especial ContribuyenteEspecial,A.emp_email_digital,
                    B.est_numero Establecimiento,C.pemi_numero PuntoEmision,A.emp_moneda Moneda,A.emp_email_conta CorreoConta
                    FROM " . $conApp->dbname . ".empresa A
                            INNER JOIN (" . $conApp->dbname . ".establecimiento B
                                            INNER JOIN " . $conApp->dbname . ".punto_emision C
                                                    ON B.est_id=C.est_id AND C.est_log='1')
                                    ON A.emp_id=B.emp_id AND B.est_log='1'
            WHERE A.emp_id='$emp_id' AND A.emp_est_log='1' 
                     AND B.est_id='$est_id' AND C.pemi_id='$pemi_id'";
        //echo $sql;
        //$rawData = $conApp->createCommand($sql)->queryAll(); //Varios registros =>  $rawData[0]['RazonSocial']
        $rawData = $conApp->createCommand($sql)->queryRow();  //Un solo Registro => $rawData['RazonSocial']
        return $rawData;
    }
    
    public function buscarAmbienteEmp($IdCompania,$Ambiente) {
        //$conApp = yii::app()->dbvssea;
        $conApp = yii::app()->db;
        $rawData = array();
        $sql = "SELECT Recepcion,Autorizacion,RecepcionLote,TiempoRespuesta,TiempoSincronizacion "
                . "FROM " . $conApp->dbname . ".VSServiciosSRI WHERE EMP_ID=$IdCompania AND Ambiente=$Ambiente AND Estado=1";
        //echo $sql;
        //$rawData = $conApp->createCommand($sql)->queryAll(); //Varios registros =>  $rawData[0]['RazonSocial']
        $rawData = $conApp->createCommand($sql)->queryRow();  //Un solo Registro => $rawData['RazonSocial']
        $conApp->active = false;
        return $rawData;
    }
    
    public function buscarTipoUser($IdUser) {
        $conApp = yii::app()->db;
        $rawData = array();
        $sql = "SELECT A.UEMP_ID,A.USU_EMP_ERP UsuarioErp,A.USU_ID,B.USU_NOMBRE,C.ROL_ID,C.ROL_NOMBRE "
                        . "FROM " . $conApp->dbname . ".USUARIO_EMPRESA A "
                                . "INNER JOIN " . $conApp->dbname . ".USUARIO B "
                                        . "ON A.USU_ID=B.USU_ID "
                                . "INNER JOIN  " . $conApp->dbname . ".ROL C "
                                        . "ON A.ROL_ID=C.ROL_ID "
                . "WHERE A.USU_ID=$IdUser AND B.USU_EST_LOG=1 ";
        //echo $sql;
        //$rawData = $conApp->createCommand($sql)->queryAll(); //Varios registros =>  $rawData[0]['RazonSocial']
        $rawData = $conApp->createCommand($sql)->queryRow();  //Un solo Registro => $rawData['RazonSocial']
        $conApp->active = false;
        return $rawData;
    }

}
