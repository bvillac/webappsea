<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $rol_id
 * @property string $rol_nombre
 * @property string $rol_color
 * @property string $rol_descripcion
 * @property string $rol_estado_activo
 * @property string $rol_fecha_creacion
 * @property string $rol_fecha_modificacion
 * @property string $rol_estado_logico
 *
 * @property GrupoRol[] $grupoRols
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_estado_activo', 'rol_estado_logico'], 'required'],
            [['rol_fecha_creacion', 'rol_fecha_modificacion'], 'safe'],
            [['rol_nombre'], 'string', 'max' => 50],
            [['rol_descripcion'], 'string', 'max' => 45],
            [['rol_estado_activo', 'rol_estado_logico'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rol_id' => Yii::t('app', 'Rol ID'),
            'rol_nombre' => Yii::t('app', 'Rol Nombre'),
            'rol_descripcion' => Yii::t('app', 'Rol Descripcion'),
            'rol_estado_activo' => Yii::t('app', 'Rol Estado Activo'),
            'rol_fecha_creacion' => Yii::t('app', 'Rol Fecha Creacion'),
            'rol_fecha_modificacion' => Yii::t('app', 'Rol Fecha Modificacion'),
            'rol_estado_logico' => Yii::t('app', 'Rol Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoRols()
    {
        return $this->hasMany(GrupoRol::className(), ['rol_id' => 'rol_id']);
    }
    
    public function getRolsByUser($id_user, $id_empresa){
        $sql = "SELECT 
                    r.rol_nombre AS rol
                FROM 
                    usuario AS u 
                    INNER JOIN grupo_rol AS gr ON u.usu_id = gr.usu_id
                    INNER JOIN rol AS r ON gr.rol_id = r.rol_id
                    INNER JOIN grupo AS g ON gr.gru_id = g.gru_id
                WHERE 
                    u.usu_id=:usu_id AND
                    gr.grol_estado_logico=1 AND 
                    gr.grol_estado_activo=1 AND 
                    u.usu_estado_logico=1 AND 
                    u.usu_estado_activo=1 AND 
                    r.rol_estado_activo=1 AND 
                    r.rol_estado_logico=1 AND
                    g.gru_estado_activo=1 AND 
                    g.gru_estado_logico=1 
                ORDER BY rol ASC";
        $comando = Yii::$app->db->createCommand($sql);
        $comando->bindParam(":usu_id", $id_user, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public static function buscarTipoUser($ids){
        $con = \Yii::$app->db;
        $sql="select a.rol_id rolid,c.rol_nombre rolName
                from  " . $con->dbname . ".usuario_empresa a
                  inner join " . $con->dbname . ".usuario b on a.usu_id=b.usu_id
                  inner join " . $con->dbname . ".rol c on a.rol_id=c.rol_id
              where b.usu_id=:ids and b.usu_est_log=1 ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ids", $ids, \PDO::PARAM_INT);
        return $comando->queryOne();
    }
    
    public function guardarEmpresaRol($usu_id,$emp_id,$rol_id) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {       
            $sql = "INSERT INTO " . $con->dbname . ".usuario_empresa
                (usu_id,rol_id,emp_id,uemp_est_log)VALUES
                (:usu_id,:rol_id,:emp_id,1) ";
            $command = $con->createCommand($sql);
            $command->bindParam(":usu_id",$usu_id, \PDO::PARAM_INT);
            $command->bindParam(":rol_id",$rol_id, \PDO::PARAM_INT);
            $command->bindParam(":emp_id",$emp_id, \PDO::PARAM_INT);
            $command->execute();
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            return false;
        }
    }
    
    //Guarada Datos de Empreasa y roles para los accesos
    public static function saveEmpresaRol($con,$usu_id,$emp_id,$rol_id) {     
            $sql = "INSERT INTO " . $con->dbname . ".usuario_empresa
                (usu_id,rol_id,emp_id,uemp_est_log)VALUES
                (:usu_id,:rol_id,:emp_id,1) ";
            $command = $con->createCommand($sql);
            $command->bindParam(":usu_id",$usu_id, \PDO::PARAM_INT);
            $command->bindParam(":rol_id",$rol_id, \PDO::PARAM_INT);
            $command->bindParam(":emp_id",$emp_id, \PDO::PARAM_INT);
            $command->execute();

    }

}
