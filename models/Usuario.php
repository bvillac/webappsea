<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use app\models\Persona;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usu_id
 * @property int $per_id
 * @property string $usu_username
 * @property string $usu_password
 * @property string $usu_sha
 * @property string $usu_session
 * @property string $usu_last_login
 * @property string $usu_link_activo
 * @property string $usu_estado_activo
 * @property string $usu_alias
 * @property string $usu_est_log
 * @property string $usu_fec_cre
 * @property string $usu_fec_mod
 *
 * @property Log[] $logs
 * @property Persona $per
 * @property UsuarioEmpresa[] $usuarioEmpresas
 */
class Usuario extends ActiveRecord implements IdentityInterface  {
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['per_id', 'usu_estado_activo'], 'required'],
            [['per_id'], 'integer'],
            [['usu_last_login', 'usu_fec_cre', 'usu_fec_mod'], 'safe'],
            [['usu_link_activo'], 'string'],
            [['usu_username'], 'string', 'max' => 45],
            [['usu_password', 'usu_sha', 'usu_session'], 'string', 'max' => 255],
            [['usu_estado_activo', 'usu_est_log'], 'string', 'max' => 1],
            [['usu_alias'], 'string', 'max' => 60],
            [['per_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['per_id' => 'per_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => Yii::t('app', 'Usu ID'),
            'per_id' => Yii::t('app', 'Per ID'),
            'usu_username' => Yii::t('app', 'Usu Username'),
            'usu_password' => Yii::t('app', 'Usu Password'),
            'usu_sha' => Yii::t('app', 'Usu Sha'),
            'usu_session' => Yii::t('app', 'Usu Session'),
            'usu_last_login' => Yii::t('app', 'Usu Last Login'),
            'usu_link_activo' => Yii::t('app', 'Usu Link Activo'),
            'usu_estado_activo' => Yii::t('app', 'Usu Estado Activo'),
            'usu_alias' => Yii::t('app', 'Usu Alias'),
            'usu_est_log' => Yii::t('app', 'Usu Est Log'),
            'usu_fec_cre' => Yii::t('app', 'Usu Fec Cre'),
            'usu_fec_mod' => Yii::t('app', 'Usu Fec Mod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPer()
    {
        return $this->hasOne(Persona::className(), ['per_id' => 'per_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioEmpresas()
    {
        return $this->hasMany(UsuarioEmpresa::className(), ['usu_id' => 'usu_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->usu_sha;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }
    
    public static function findByCondition($condition) {
        return parent::findByCondition($condition);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['usu_sha' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }
    
    /*
        Login de Usuario  valida User
     *      */
    public static function findByUsername($username) {
        $user = static::findOne(['usu_username' => $username, 'usu_estado_activo' => 1]);
        if (isset($user->usu_id))
            return $user;
        else
            return NULL;
    }
    
    /*
     * Validates password
     */
    public function validatePassword($password) {
        $security = new Security();//admin AdminUt3g17
        return ($this->usu_sha === $security->decryptByPassword(base64_decode($this->usu_password), $password));
    }
    
    public function setPassword($password) {
        $security = new Security();
        $hash = (isset($this->usu_sha) ? $this->usu_sha : ($this->generateAuthKey()));
        $this->usu_password = base64_encode($security->encryptByPassword($hash, $password));
    }
    
    public function generateAuthKey() {
        $security = new Security();
        $this->usu_sha = $security->generateRandomString();
        return $this->usu_sha;
    }
    
    //CREAR TODAS LAS SESCI9ONES DE LA APLICACION
    public function createSession($id_empresa = NULL) {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $session->open();
            //$session->close();
            $model_persona = Persona::findIdentity($this->per_id);
            $nombre_persona = $model_persona->per_nombre;
            $apellido_persona = $model_persona->per_apellido;
            $session->set('PB_isuser', true);
            $session->set('PB_username', $this->usu_username);
            $session->set('PB_nombres', $nombre_persona . " " . $apellido_persona);
            //$session->set('PB_idempresa', $id_empresa);
            $session->set('PB_empresa', $nombre_empresa);
            $session->set('PB_perid', $this->per_id);
            $session->set('PB_iduser', $this->usu_id);
            $session->set('PB_yii_lang', Yii::$app->language);
            //$session->set('PB_yii_theme', Yii::$app->view->theme->themeName);
        } else {
            $session->destroy();
        }
    }
    
    public static function addVarSession($alias, $value){
        $session = Yii::$app->session;
        if ($session->isActive) {
            $session->set($alias, $value);
        }
    }
    
    public function regenerateSession() {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $id = Yii::$app->session->getId();
            Yii::$app->session->regenerateID($id);
        }
    }
    
    public function destroySession() {
        $usuario = $this->findIdentity(Yii::$app->session->get("PB_iduser"));
        $session = Yii::$app->session;
        $session->close();
        $session->destroy();
    }
    
    public function crearUsuario($username, $password, $id_persona) {
        // se debe verificar de que el usuario no exista
        $this->usu_user = $username;
        $this->generateAuthKey(); // generacion de hash
        $this->setPassword($password);
        $this->per_id = $id_persona;
        if ($this->save())
            return true;
        return false;
    }
    
    //Solo Genera Link Sin Guardar en la Base
    public static function crearLinkActivacion(){
        $security = new Security();
        $hash = $security->generateRandomString();
        $sublink = urlencode($hash);
        $sublink = str_replace("/", "", $sublink);
        $sublink = str_replace("+", "", $sublink);
        $sublink = str_replace("-", "", $sublink);
        $sublink = str_replace("_", "", $sublink);
        $sublink = str_replace(" ", "", $sublink);
        $sublink = str_replace("?", "", $sublink);
        $link = Url::base(true)."/site/activation?wg=".$sublink;
        return $link;
    }
    
    public function activarLinkCuenta($link){
        $result=false;
        $user = static::findOne(['usu_link_activo' => $link]);
        $dbLink = $user->usu_link_activo;
        if(isset($dbLink) && $dbLink != ""){
            if($dbLink == $link){
                $user->usu_link_activo = "";
                $user->usu_estado_activo = 1;
                $id = $user->usu_id;
                $result= $this->activarCuenta($id);
                //$user->update(true, array("usu_link_activo","usu_estado_activo"));
                //EN CASO DE AGREGAR MAS DATOS EN LA ACTIVACION AKI
                //return true;
                //$nombres = $data[0]['per_nombre'];
                if($result){
                    $tituloMensaje = Yii::t("register","Successful Registration");
                    $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];//
                    //Correo para el Usuario Final
                    $body = Utilities::getMailMessage("registerUsuarioActivo", 
                            array("[[username]]" => $user->usu_username,
                                  ), Yii::$app->language);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["no-responder"], 
                                        [$user->usu_username => $user->usu_username],
                                        [],//Bcc
                                        $asunto, $body);
                    
                }
                
            }
        }
        return $result;
    }
    
    public function activarCuenta($ids) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            //$ids = isset($data['ids']) ? base64_decode($data['ids']) :NULL;
            $sql = "UPDATE " . $con->dbname . ".usuario SET usu_estado_activo=1,usu_link_activo='' "
                    . " WHERE usu_id=:usu_id";
            $command = $con->createCommand($sql);
            $command->bindParam(":usu_id", $ids, \PDO::PARAM_INT);
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
    
    
    /* INSERTAR DATOS */
    public function insertarUsuario($data) {
        $arroout = array();
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data = isset($data['DATA']) ? $data['DATA'] : array();
            //Utilities::putMessageLogFile($data);
            Persona::insertarDataPerfil($con, $data);
            $per_id=$con->getLastInsertID();//IDS de la Persona
            Persona::insertarDataPerfilDatoAdicional($con, $data, $per_id);
            //Inserta Datos de Usuario
            //$password=Utilities::generarCodigoKey(8);//Passw Generado Automaticamente
            $password=$data[0]['usu_password'];
            $estado_activo=$data[0]['usu_estado_activo'];
            $linkActiva=Usuario::crearLinkActivacion();
            Usuario::insertarDataUser($con, $data[0]['per_correo'], $password, $per_id,$linkActiva,$estado_activo); 
            $usu_id=$con->getLastInsertID();//IDS de la Persona
            //Rol::saveEmpresaRol($con, $usu_id, 1, $this->rolDefault);//Empresas 1 Por Defecto
            //###############################
            
            Utilities::insertarLogs($con, $usu_id, 'usuario', 'Insert -> Per_id,Usu_id');
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            $arroout["status"]= true;
            
            //Enviar correo electronico para activacion de cuenta
                $nombres = $data[0]['per_nombre'];
                $tituloMensaje = Yii::t("register","Successful Registration");
                $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];//
                //Correo para el Usuario Final
                $body = Utilities::getMailMessage("registerUsuario", 
                        array("[[user]]" => $nombres, 
                              "[[username]]" => $data[0]['per_correo'],
                              "[[clave]]" => $password), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["no-responder"], 
                                    [$data[0]['per_correo'] => $data[0]['per_nombre'] . " " . $data[0]['per_apellido']],
                                    [],//Bcc
                                    $asunto, $body);
                
                //Correo para el Usuario de Activacion es decir para hacer la activacion el administrador
                $TipoPersona=($data[0]['per_tipo_persona']=='N')?'Natural':'Jurídica';
                $body = Utilities::getMailMessage("activarUsuario", 
                        array("[[user]]" => $nombres,
                              "[[tipoPersona]]" => $TipoPersona,"[[ced_ruc]]" => $data[0]['per_ced_ruc'],  
                              "[[Empresa]]" => $data[0]['per_empresa'],
                              "[[Nombres]]" => $data[0]['per_nombre'] . " " . $data[0]['per_apellido'],
                              "[[username]]" => $data[0]['per_correo'],"[[clave]]" => $password, 
                              "[[link_verification]]" => $linkActiva), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["no-responder"], 
                                    [$data[0]['per_correo'] => $data[0]['per_nombre'] . " " . $data[0]['per_apellido']],
                                    [],//Bcc
                                    $asunto, $body);
            //Find Datos Mail
            //Utilities::putMessageLogFile($data);
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            throw $e;
            $arroout["status"]= false;
            return $arroout;
        }
    }
    
    public static function insertarDataUser($con,$username, $password, $id_persona,$link,$estado_activo) {
        $security = new Security();
        $usu_sha = $security->generateRandomString();//String de Seguridad
        $usu_password = base64_encode($security->encryptByPassword($usu_sha, $password));//Nuevo Pass con SHA Y 64 BITS        
        $sql = "INSERT INTO " . $con->dbname . ".usuario
            (per_id,usu_username,usu_password,usu_sha,usu_link_activo,usu_estado_activo,usu_est_log)VALUES
            (:per_id,:usu_username,:usu_password,:usu_sha,:usu_link_activo,:usu_estado_activo,1);";
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $id_persona, \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":usu_username", $username, \PDO::PARAM_STR);
        $command->bindParam(":usu_password", $usu_password, \PDO::PARAM_STR);
        $command->bindParam(":usu_sha", $usu_sha, \PDO::PARAM_STR);
        $command->bindParam(":usu_link_activo", $link, \PDO::PARAM_STR);
        $command->bindParam(":usu_estado_activo", $estado_activo, \PDO::PARAM_STR);
        $command->execute();
    }
    
    
    
    
    
}
