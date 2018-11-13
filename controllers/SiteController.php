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
        $resul=array();

        /*$query = Tienda::getProductoTienda();
        $countQuery = $query;//clone $query;
        Utilities::putMessageLogFile($query);
        $pages = new Pagination(['totalCount' => count($countQuery)]);
        $models = $query->offset($pages->offset)
                ->limit(\Yii::$app->params['pagePro'])
                ->all();
        //return $this->render('index');
        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pages,
        ]);*/
        //$data = Yii::$app->request->get();
        //if (\Yii::$app->user->isGuest) {
            
        //}
        
        //Utilities::putMessageLogFile("llego 1");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $resul = Tienda::getProductoTienda($page);

            if ($resul['status']) {
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $resul['data']);
            }
        }
        //$pages=1;
        $resul = Tienda::getProductoTienda(null);
        //$countQuery = $query;
        //$pages = new Pagination(['totalCount' => count($countQuery)]);
        //Utilities::putMessageLogFile($pages->offset);
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
