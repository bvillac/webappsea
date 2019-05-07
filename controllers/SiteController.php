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
use app\models\Utilities;
use \yii\helpers\Url;
use app\models\Tienda;
use yii\data\Pagination;


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
        $nivel=array();
        $data = Yii::$app->request->get();
        //$ids=isset($data["codigo"]) ? base64_decode($data['codigo']) : "0";
        //$page=isset($data["page"]) ? base64_decode($data['page']) : "1";          
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $op=(isset($data["op"]))?$data["op"]:'';
           
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
        $resul = Tienda::getProductoTiendaIndex($data);
        $IdsScat=Tienda::getNivelSuperior($resul['data'][0]['ids_cat']);//Obtiene nivel superior
        $nivel = Tienda::getNivelTienda($IdsScat[0]['ids_scat']);//obtiene categoria de nivel
        //Utilities::putMessageLogFile($resul);
        return $this->render('productos', [
                    'models' => $resul['data'],
                    'subnivel' => $nivel,
                    'pages' => $resul['trows'],
                    'nomCat' => $IdsScat[0]['nom_cat'],
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
    
    public function actionConfirmarpedido()
    {
        return $this->render('confirmarpedido');
    }
    
    public function actionMicuenta()
    {
        return $this->render('micuenta');
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
