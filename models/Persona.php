<?php

namespace app\models;

use Yii;
use app\models\Usuario;

/**
 * This is the model class for table "persona".
 *
 * @property int $per_id
 * @property string $per_ced_ruc
 * @property string $per_nombre
 * @property string $per_apellido
 * @property string $per_genero
 * @property string $per_fecha_nacimiento
 * @property string $per_estado_civil
 * @property string $per_correo
 * @property string $per_tipo_sangre
 * @property string $per_foto
 * @property string $per_estado_activo
 * @property string $per_est_log
 * @property string $per_fec_cre
 * @property string $per_fec_mod
 *
 * @property DataPersona[] $dataPersonas
 * @property Usuario[] $usuarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['per_fecha_nacimiento', 'per_fec_cre', 'per_fec_mod'], 'safe'],
            [['per_estado_activo'], 'required'],
            [['per_ced_ruc'], 'string', 'max' => 15],
            [['per_nombre', 'per_apellido', 'per_correo', 'per_foto'], 'string', 'max' => 100],
            [['per_genero', 'per_estado_civil', 'per_estado_activo', 'per_est_log'], 'string', 'max' => 1],
            [['per_tipo_sangre'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'per_id' => Yii::t('app', 'Per ID'),
            'per_ced_ruc' => Yii::t('app', 'Per Ced Ruc'),
            'per_nombre' => Yii::t('app', 'Per Nombre'),
            'per_apellido' => Yii::t('app', 'Per Apellido'),
            'per_genero' => Yii::t('app', 'Per Genero'),
            'per_fecha_nacimiento' => Yii::t('app', 'Per Fecha Nacimiento'),
            'per_estado_civil' => Yii::t('app', 'Per Estado Civil'),
            'per_correo' => Yii::t('app', 'Per Correo'),
            'per_tipo_sangre' => Yii::t('app', 'Per Tipo Sangre'),
            'per_foto' => Yii::t('app', 'Per Foto'),
            'per_estado_activo' => Yii::t('app', 'Per Estado Activo'),
            'per_est_log' => Yii::t('app', 'Per Est Log'),
            'per_fec_cre' => Yii::t('app', 'Per Fec Cre'),
            'per_fec_mod' => Yii::t('app', 'Per Fec Mod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataPersonas()
    {
        return $this->hasMany(DataPersona::className(), ['per_id' => 'per_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['per_id' => 'per_id']);
    }
    
    public static function findIdentity($id) {
        return static::findOne($id);
    }
    
    public static function insertarDataPerfil($con,$data) {      
        //Datos de Perfil
        $sql = "INSERT INTO " . $con->dbname . ".persona
        (per_tipo_persona,per_ced_ruc,per_empresa,per_nombre,per_apellido,per_genero,per_fecha_nacimiento,per_estado_civil,per_correo,per_tipo_sangre,per_foto,per_estado_activo,per_est_log)VALUES
        (:per_tipo_persona,:per_ced_ruc,:per_empresa,:per_nombre,:per_apellido,:per_genero,:per_fecha_nacimiento,:per_estado_civil,:per_correo,:per_tipo_sangre,:per_foto,1,1 ); ";
        $command = $con->createCommand($sql);
        //$command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":per_tipo_persona", $data[0]['per_tipo_persona'], \PDO::PARAM_STR);
        $command->bindParam(":per_empresa", $data[0]['per_empresa'], \PDO::PARAM_STR);
        $command->bindParam(":per_nombre", $data[0]['per_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":per_apellido", $data[0]['per_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":per_ced_ruc", $data[0]['per_ced_ruc'], \PDO::PARAM_STR);        
        $command->bindParam(":per_genero", $data[0]['per_genero'], \PDO::PARAM_STR);
        $command->bindParam(":per_fecha_nacimiento", $data[0]['per_fecha_nacimiento'], \PDO::PARAM_STR);
        $command->bindParam(":per_estado_civil", $data[0]['per_estado_civil'], \PDO::PARAM_STR);
        $command->bindParam(":per_correo", $data[0]['per_correo'], \PDO::PARAM_STR);
        $command->bindParam(":per_tipo_sangre", $data[0]['per_tipo_sangre'], \PDO::PARAM_STR);
        $command->bindParam(":per_foto", $data[0]['per_foto'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    public static function insertarDataPerfilDatoAdicional($con,$data,$per_id) { 
         //Datos Adicionales
        $sql = "INSERT INTO " . $con->dbname . ".data_persona
                (per_id,pai_id,prov_id,can_id,dper_direccion,dper_telefono,dper_celular,dper_contacto,dper_est_log)VALUES
                (:per_id,:pai_id,:prov_id,:can_id,:dper_direccion,:dper_telefono,:dper_celular,:dper_contacto,1);";
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $per_id, \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":pai_id", $data[0]['pai_id'], \PDO::PARAM_INT);
        $command->bindParam(":prov_id", $data[0]['prov_id'], \PDO::PARAM_INT);
        $command->bindParam(":can_id", $data[0]['can_id'], \PDO::PARAM_INT);
        $command->bindParam(":dper_direccion", $data[0]['dper_direccion'], \PDO::PARAM_STR);
        $command->bindParam(":dper_contacto", $data[0]['dper_contacto'], \PDO::PARAM_STR);
        $command->bindParam(":dper_telefono", $data[0]['dper_telefono'], \PDO::PARAM_STR);
        $command->bindParam(":dper_celular", $data[0]['dper_celular'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    public static function actualizarDataPerfil($con,$data) {
        $sql = "UPDATE " . $con->dbname . ".persona
            SET per_ced_ruc = :per_ced_ruc,per_nombre = :per_nombre,per_apellido = :per_apellido,
            per_genero = :per_genero,per_fecha_nacimiento = :per_fecha_nacimiento,per_estado_civil = :per_estado_civil,
            per_correo = :per_correo,per_tipo_sangre = :per_tipo_sangre,per_foto = :per_foto,per_fec_mod = CURRENT_TIMESTAMP()
            WHERE per_id=:per_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":per_nombre", $data[0]['per_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":per_apellido", $data[0]['per_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":per_ced_ruc", $data[0]['per_ced_ruc'], \PDO::PARAM_STR);        
        $command->bindParam(":per_genero", $data[0]['per_genero'], \PDO::PARAM_STR);
        $command->bindParam(":per_fecha_nacimiento", $data[0]['per_fecha_nacimiento'], \PDO::PARAM_STR);
        $command->bindParam(":per_estado_civil", $data[0]['per_estado_civil'], \PDO::PARAM_STR);
        $command->bindParam(":per_correo", $data[0]['per_correo'], \PDO::PARAM_STR);
        $command->bindParam(":per_tipo_sangre", $data[0]['per_tipo_sangre'], \PDO::PARAM_STR);
        $command->bindParam(":per_foto", $data[0]['per_foto'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    public static function actualizarDataAdicional($con,$data) {
        //Verificamos SI existe los Datos Adicionales
        $dper_id=  Persona::existeDataAdicional($con, $data[0]['per_id']);
        if($dper_id>0){
            //Existe y Hay que Actualizar
            $sql = "UPDATE " . $con->dbname . ".data_persona
                SET per_id = :per_id,pai_id = :pai_id,prov_id = :prov_id,can_id = :can_id,dper_direccion = :dper_direccion,
                dper_telefono = :dper_telefono,dper_celular = :dper_celular,dper_contacto = :dper_contacto,dper_est_log = 1,
                dper_fec_mod=CURRENT_TIMESTAMP() WHERE dper_id=$dper_id "; 
        }else{
            //No Existe y Hay que Insertar
            $sql = "INSERT INTO " . $con->dbname . ".data_persona
                (per_id,pai_id,prov_id,can_id,dper_direccion,dper_telefono,dper_celular,dper_contacto,dper_est_log)VALUES
                (:per_id,:pai_id,:prov_id,:can_id,:dper_direccion,:dper_telefono,:dper_celular,:dper_contacto,1);";
        }
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":pai_id", $data[0]['pai_id'], \PDO::PARAM_INT);
        $command->bindParam(":prov_id", $data[0]['prov_id'], \PDO::PARAM_INT);
        $command->bindParam(":can_id", $data[0]['can_id'], \PDO::PARAM_INT);
        $command->bindParam(":dper_direccion", $data[0]['dper_direccion'], \PDO::PARAM_STR);
        $command->bindParam(":dper_contacto", $data[0]['dper_contacto'], \PDO::PARAM_STR);
        $command->bindParam(":dper_telefono", $data[0]['dper_telefono'], \PDO::PARAM_STR);
        $command->bindParam(":dper_celular", $data[0]['dper_celular'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    public static function existeDataAdicional($con,$ids){
        $sql = "SELECT dper_id FROM " . $con->dbname . ".data_persona WHERE per_id=:per_id ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":per_id", $ids, \PDO::PARAM_INT);
        $rawData=$comando->queryScalar();
        if ($rawData === false)
            return 0; //en caso de que existe problema o no retorne nada tiene 1 por defecto 
        return $rawData;
    }
    
    public function buscarPersonaID($ids){
        $con = \Yii::$app->db;        
        $sql = "SELECT A.per_id Ids,A.per_ced_ruc Cedula,A.per_nombre Nombre,A.per_apellido Apellido,A.per_genero Genero,A.per_fecha_nacimiento Fec_Nac,
            A.per_estado_civil Est_Civ,A.per_correo Correo,A.per_tipo_sangre Gru_San,A.per_foto Foto,A.per_estado_activo,
            A.per_est_log,A.per_fec_cre,B.pai_id Pais,B.prov_id Provincia,B.can_id Canton,B.dper_direccion Direccion,
            B.dper_telefono Telefono,B.dper_celular Celular,B.dper_contacto Contacto
              FROM " . $con->dbname . ".persona A
            LEFT JOIN " . $con->dbname . ".data_persona B ON A.per_id=B.per_id
        WHERE A.per_est_log=1 AND A.per_id=:per_id  ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":per_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    
    
}
