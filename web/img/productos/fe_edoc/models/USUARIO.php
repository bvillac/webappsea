<?php

/**
 * This is the model class for table "USUARIO".
 *
 * The followings are the available columns in table 'USUARIO':
 * @property string $USU_ID
 * @property string $PER_ID
 * @property string $USU_NOMBRE
 * @property string $USU_PASSWORD
 * @property string $USU_EST_LOG
 * @property string $USU_FEC_CRE
 * @property string $USU_FEC_MOD
 *
 * The followings are the available model relations:
 * @property PERSONA $pER
 */
namespace app\modules\fe_edoc\models;

use Yii;

class USUARIO extends \app\modules\fe_edoc\components\CActiveRecord {

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('PER_ID', 'required'),
            array('PER_ID', 'length', 'max' => 20),
            array('USU_NOMBRE', 'length', 'max' => 100),
            array('USU_PASSWORD', 'length', 'max' => 50),
            array('USU_EST_LOG', 'length', 'max' => 1),
            array('USU_FEC_CRE, USU_FEC_MOD', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('USU_ID, PER_ID, USU_NOMBRE, USU_PASSWORD, USU_EST_LOG, USU_FEC_CRE, USU_FEC_MOD', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pER' => array(self::BELONGS_TO, 'PERSONA', 'PER_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'USU_ID' => 'Usu',
            'PER_ID' => 'Per',
            'USU_NOMBRE' => 'Usu Nombre',
            'USU_PASSWORD' => 'Usu Password',
            'USU_EST_LOG' => 'Usu Est Log',
            'USU_FEC_CRE' => 'Usu Fec Cre',
            'USU_FEC_MOD' => 'Usu Fec Mod',
        );
    }


    public function cambiarPassword($pass) {
        $ids = Yii::$app->session->get('user_id', FALSE);
        $msg = new VSexception();
        $con = yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            $sql = "UPDATE " . $con->dbname . ".usuario SET usu_password=MD5('$pass') WHERE usu_id=$ids ";
            $comando = $con->createCommand($sql);
            $comando->execute();
            //echo $sql;
            $trans->commit();
            return $msg->messageSystem('OK', null, 20, null, null);
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            $trans->rollBack();
            //throw $e;
            return $msg->messageSystem('NO_OK', $e->getMessage(), 11, null, null);
        }
    }
    
    public function cambiarMailDoc($ids,$correo) {
        $msg = new VSexception();
        $con = yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        if($ids==0){return $msg->messageSystem('NO_OK', $e->getMessage(), 11, null, null);}
        try {
            $sql = "UPDATE " . $con->dbname . ".usuario SET usu_correo='$correo' WHERE usu_id=$ids ";
            $comando = $con->createCommand($sql);
            $comando->execute();
            //echo $sql;
            $trans->commit();
            return $msg->messageSystem('OK', null, 20, null, null);
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            $trans->rollBack();
            //throw $e;
            return $msg->messageSystem('NO_OK', $e->getMessage(), 11, null, null);
        }
    }
    
    public function getMailUserDoc($id,$tipDoc) {
        $con = yii::$app->db_edoc;
                switch ($tipDoc) {
                    Case "FA"://FACTURAS
                        $sql = "SELECT A.IdentificacionComprador CedRuc,C.usu_id UsuId,B.per_nombre Nombres,C.usu_correo Correo
                                FROM " . $con->dbname . ".NubeFactura A
                                        INNER JOIN (" . $con->dbname . ".persona B
                                                        INNER JOIN " . $con->dbname . ".usuario C
                                                                ON C.per_id=B.per_id)
                                                ON B.per_ced_ruc=A.IdentificacionComprador
                            WHERE A.IdFactura='$id';";                       
                        break;
                    Case "GR"://GUIAS DE REMISION
                        $sql = "SELECT D.IdentificacionDestinatario CedRuc,C.usu_id UsuId,B.per_nombre Nombres,C.usu_correo Correo
                                FROM " . $con->dbname . ".NubeGuiaRemision A
                                        INNER JOIN " . $con->dbname . ".NubeGuiaRemisionDestinatario D
                                                ON D.IdGuiaRemision=A.IdGuiaRemision
                                        INNER JOIN (" . $con->dbname . ".persona B
                                                INNER JOIN " . $con->dbname . ".usuario C
                                                        ON C.per_id=B.per_id)
                                                ON B.per_ced_ruc=D.IdentificacionDestinatario
                            WHERE A.IdGuiaRemision='$id'";
                           
                        break;
                    Case "RT"://RETENCIONES
                            $sql = "SELECT A.IdentificacionSujetoRetenido CedRuc,C.usu_id UsuId,B.per_nombre Nombres,C.usu_correo Correo
                                    FROM " . $con->dbname . ".NubeRetencion A
                                            INNER JOIN (" . $con->dbname . ".persona B
                                                    INNER JOIN " . $con->dbname . ".usuario C
                                                            ON C.per_id=B.per_id)
                                                    ON B.per_ced_ruc=A.IdentificacionSujetoRetenido
                            WHERE A.IdRetencion='$id' ";
                        
                        break;
                    Case "NC"://NOTAS DE CREDITO
                        $sql = "SELECT A.IdentificacionComprador CedRuc,C.usu_id UsuId,B.per_nombre Nombres,C.usu_correo Correo
                                FROM " . $con->dbname . ".NubeNotaCredito A
                                        INNER JOIN (" . $con->dbname . ".persona B
                                                INNER JOIN " . $con->dbname . ".usuario C
                                                        ON C.per_id=B.per_id)
                                                ON B.per_ced_ruc=A.IdentificacionComprador
                            WHERE A.IdNotaCredito='$id'";
                        
                        break;
                    Case "ND"://NOTAS DE DEBITO
                        //$sql = "UPDATE " . $con->dbname . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                }

        $rawData = $con->createCommand($sql)->queryAll();
        return $rawData;
    }

}
