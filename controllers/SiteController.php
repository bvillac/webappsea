<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\components\CController;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Usuario;
use app\models\Persona;
use app\models\Utilities;
use \yii\helpers\Url;
use app\models\Tienda;
use yii\data\Pagination;
use app\models\CabListapedidosTemp;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],                    
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
            
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        //exit('llego');
        $resul=array();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $op=(isset($data["op"]))?$data["op"]:'';
            switch ($op) {
                case 'categoria':
                    $ids=(isset($data["ids"]))?$data["ids"]:'0';
                    //Utilities::putMessageLogFile(Tienda::getNivelTienda($ids));
                    $dts = Tienda::getNivelTienda($ids);//Tienda::getSubNivelTienda($ids);
                    $resul["status"] = TRUE;
                    $resul["data"] = $dts;
                    break;
                case 'subCategoria':
                    //$ids=(isset($data["ids"]))?$data["ids"]:'0';
                    $ids=isset($data["ids"]) ? base64_decode($data['ids']) : "0";
                    $dts = Tienda::getSubNivelTienda($ids);
                    $resul["status"] = TRUE;
                    $resul["data"] = $dts;
                    break;
                case 'productos':
                    //$resul = Tienda::getProductoTienda($data);
                    //Tienda::getProductoTiendaMasVendidos($data);
                    break;
                default:
                   //echo "i no es igual a 0, 1 ni 2";
                    $resul['status']=FALSE;
            }
            
            if ($resul['status']) {
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $resul['data']);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
        //$pages=1;
        //$resul = Tienda::getProductoTienda(null);
        return $this->render('index', [
                    //'models' => $resul['data'],
                    //'pages' => $resul['trows'],
        ]);
    }
    
    /**
     * PRODUCTOS
     * @return Response|string
     */
     public function actionProductos() {
        $resul=array();
        $nivel_1=array();  
        $nivel_2=array();        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $op=(isset($data["op"]))?$data["op"]:'';
            //Utilities::putMessageLogFile('ajax '.$data);
            $resul = Tienda::getProductoTiendaIndex($data);
          
            if ($resul['status']) {
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $resul['data']);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
        $data = Yii::$app->request->get();
        //Utilities::putMessageLogFile('get '.$data);
        //DATOS 3 NIVEL
        $resul = Tienda::getProductoTiendaIndex($data);//Retorna los Items a mostrar osea resultado de Items    
        $IdsScat=Tienda::getNivelSuperior($resul['data'][0]['ids_cat']);//Obtiene nivel superior los IDS
        $IdsSubcat=Tienda::getNivelSuperior($IdsScat[0]['ids_scat']);//Obtiene el Menu de Nivel superior Categorias
        $nivel_0=Tienda::getNivelSuperior($IdsSubcat[0]['ids_scat']);
        //DATOS 2 NIVEL
        $nivel_2 = Tienda::getNivelTienda($IdsScat[0]['ids_scat']);//obtiene categoria de nivel
        //DATOS 1 NIVEL
        $nivel_1 = Tienda::getSubNivelTienda($IdsSubcat[0]['ids_scat']);//Menu de Categorias
        
      
        return $this->render('productos', [
                    'models' => $resul['data'],//nivel 3
                    'nivel_0' => $nivel_0,
                    'nivel_1' => $nivel_1,
                    'nivel_2' => $nivel_2,
                    'pages' => $resul['trows'],
                    'nomCat' => $IdsScat[0]['nom_cat'],
                    'nomCatSup' => $IdsSubcat[0]['nom_cat'],
        ]);
     }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        
        /*if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }*/
        $arroout = array();
        $model = new LoginForm();
        /*if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //if ($model->login()) {
            
        }*/
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $user = isset($data['USER']) ? base64_decode($data['USER']) : "NULL";
            $pass= isset($data['PASS']) ? base64_decode($data['PASS']) : "NULL";
            if($user!="NULL" || $pass!="NULL"){
                if ($model->login($user,$pass)) {
                    $arroout["status"]= true;
                    return $this->goHome();//retonra al login en acceso
                }
            }else{
                $arroout["status"]= false;
                //return $this->goBack();
            }
            //return $this->render('login');
            if ($resul['status']) {
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message,$resul);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
            
            
        }
            

        //$model->password = '';
        return $this->render('login', [
            //'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $usuario = new Usuario();
        $usuario->destroySession();
        Yii::$app->user->logout();
        //return $this->goHome();
        //return $this->redirect(Url::base(true).'/site/login');
        //return $this->redirect(Url::base(true).'/site/index');
        //$arroout["status"]= true;
        //return;
        //return $this->refresh();
        return $this->goBack();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();        
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionProductodetalle()
    {
        $data = Yii::$app->request->get();
        $ids=(isset($data["codigo"]))?$data["codigo"]:'';
        $cant=(isset($data["cant"]))?$data["cant"]:1;
        //Utilities::putMessageLogFile($ids);
        return $this->render('productodetalle', [
            //'model' => json_encode(Tienda::getProductoDetalle($ids)),
            'model' => Tienda::getProductoDetalle($ids),
            'cant' => $cant,
        ]);
    }
    
    public function actionCarrito()
    {
        return $this->render('carrito');
    }
    
    
    //Control de busqueda de productos
    public function actionBuscararticulo() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $valor = isset($data['valor']) ? $data['valor'] : "";
            
            $op = isset($data['op']) ? $data['op'] : "";
            
            //$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
            //$op = isset($_POST['op']) ? $_POST['op'] : "";
            $arrayData = array();
            $dataTienda = new Tienda();
            $arrayData = $dataTienda->retornarBuscArticulo($valor, $op);
            //Utilities::putMessageLogFile($arrayData);
            //echo json_encode($arrayData);
            
            return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $arrayData,null);
            return;
            //header('Content-type: application/json');
            //echo CJavaScript::jsonEncode($arrayData);
        }
    }
    
    public function actionActivation() {
        /*$data = Yii::$app->request->get();
        if (isset($data["wg"])) {
            $link = Url::base(true) . "/site/activation?wg=" . $data["wg"];
            $usuario = Usuario::findOne(['usu_link_activo' => $link]);
            $status = false;
            if (isset($usuario)) {
                $status = $usuario->activarLinkCuenta($link);
            }
            if ($status) {
                Yii::$app->session->setFlash('success', Yii::t("login", "<h4>Success</h4>Account is enabled. Please change your current password."));
                $passReset = new UserPassreset();
                $link2 = $passReset->generarLinkCambioClave($usuario->usu_id);
                return $this->redirect($link2);
            } else {
                $model = new LoginForm();
                Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Account is disabled. Please confirm the account with link activation in your email account or reset your password."));
                $link1 = Utilities::getLoginUrl();
                return $this->redirect(Url::base(true) . $link1);
            }
        }*/
        $data = Yii::$app->request->get();
        if(isset($data["wg"])){
            $usuario = new Usuario();
            
            $status = $usuario->activarLinkCuenta(Url::base(true)."/site/activation?wg=".$data["wg"]);
            if($status){
                Yii::$app->session->setFlash('success',Yii::t("login","<h4>Success</h4>Account is enabled. Please enter your email and password."));
                return $this->redirect(Url::base(true).'/site/login#');
            }else{
                $model = new LoginForm();
                Yii::$app->session->setFlash('error',Yii::t("login","<h4>Error</h4>Account is disabled. Please confirm the account with link activation in your email account or reset your password."));
                return $this->redirect(Url::base(true).'/site/login#');
            }
        }
    }
    
    public function actionConfirmarpedido()
    {
        $model = new Persona();
        $resul=array();                
        $actividad=false;
        $session = Yii::$app->session;
        $isUser = $session->get('PB_isuser', FALSE);
        //Utilities::putMessageLogFile($session->isActive );
        //if ($isUser != FALSE && $session->isActive ){
        if ($session->isActive ){//Si la session esta activa se redireciona con los datos
            $actividad=true;
            $perId = $session->get('PB_perid', FALSE);
            $usuId = $session->get('PB_iduser', FALSE);
            $resul=$model->buscarPersonaID($perId);
        }
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //$valor = isset($data['valor']) ? $data['valor'] : "";            
            //$op = isset($data['op']) ? $data['op'] : "";
            
        }
        

        return $this->render('confirmarpedido', [
            'actividad' => $actividad,
            'Data' => $resul,//json_encode(Tienda::getProductoDetalle($ids)),
            //'model' => Tienda::getProductoDetalle($ids),
            'cant' => $cant,
        ]);
        
    }
    
    //Guardar los pedidos
    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $model = new CabListapedidosTemp();
            $data = Yii::$app->request->post();//
            $dtsCab = isset($_POST['CAB_DATA']) ? $_POST['CAB_DATA'] : array();
            $dtsDet = isset($_POST['DET_DATA']) ? $_POST['DET_DATA'] : array();
            $accion = isset($data['ACCION']) ? $data['ACCION'] : "";
            $session = Yii::$app->session;
            $usuario = $session->get('PB_iduser', FALSE);
            $resul = $model->insertarLista($dtsCab,$dtsDet,$usuario);
            //if ($accion == "Create") {
                //Nuevo Registro
                //$resul = $model->insertarUsuario($data);
            //}else if($accion == "Update"){
                //Modificar Registro
                //$resul = $model->actualizarPacientes($data);                
            //}
            //$resul['status']=true;
            if ($resul['status']) {
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message,$resul);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }   
    }
    
    public function actionMicuenta()
    {
        //return $this->render('micuenta');
        
        $model = new Persona();
        $resul=array();
        $session = Yii::$app->session;
        //$isUser = $session->get('PB_isuser', FALSE);
        $perId = $session->get('PB_perid', FALSE);
        Utilities::putMessageLogFile($perId);
        $resul=$model->buscarPersonaID($perId);
        Utilities::putMessageLogFile($resul);
        return $this->render('micuenta', [
            'Data' => $resul,            
        ]);
    }
    public function actionMispedidos()
    {
        return $this->render('mispiedidos');
    }
    public function actionMislistas()
    {
        return $this->render('mislistas');
    }

}
