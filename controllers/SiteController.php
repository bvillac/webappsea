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
                    [
                        'actions' => ['index','opcion'],
                        'allow' => true,
                        //'roles' => ['@','?'],
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
        
        //$pages=1;
        $resul = Tienda::getProductoTienda(null);
        return $this->render('index', [
                    'models' => $resul['data'],
                    'pages' => $resul['trows'],
        ]);
    }
    
    public function actionOpcion() {
        if (Yii::$app->request->isAjax) {
            Utilities::putMessageLogFile("llego post OTR");
            $data = Yii::$app->request->post();
            Utilities::putMessageLogFile($data);
            Utilities::putMessageLogFile($data["page"]);
            //$resul = Tienda::getProductoTienda($data);
            if ($resul['status']) {
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $resul['data']);
            }
            //echo "terminado";
            echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Success"), false, NULL);
        }
        
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
