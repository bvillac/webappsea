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
                    'logout' => ['post'],
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
                    $resul = Tienda::getProductoTienda($data);
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
        $resul = Tienda::getProductoTienda(null);
        return $this->render('index', [
                    'models' => $resul['data'],
                    'pages' => $resul['trows'],
        ]);
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //if ($model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
    
    public function actionData(){
        Utilities::putMessageLogFile("llego ajax");
//        if (Yii::$app->request->isAjax) {
//            Utilities::putMessageLogFile("llego ajax");
//        }
    }
}
