<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\FontAwesomeAsset;
use app\assets\AppAsset;
use app\themes\adminLTE\resources\AdminLTEAsset;
use app\models\Menu;
use odaialali\yii2toastr\ToastrAsset;
use app\vendor\penblu\blockui\BlockuiAsset;
use app\vendor\penblu\magnificpopup\MagnificPopupAsset;

/* @var $this \yii\web\View */
/* @var $content string */
$session = Yii::$app->session;
$isUser = FALSE;
$isUser = $session->get('PB_isuser', FALSE);
//Verifica La Session Activa  
//if ($session->isActive){
if ($isUser != FALSE && $session->isActive ){
    //\app\models\Utilities::putMessageLogFile(' Es Verdadero ');
    $isUser = $session->get('PB_isuser', FALSE);
}else{
    //\app\models\Utilities::putMessageLogFile(' Es falso ');
    //$this->redirect(Yii::$app->urlManager->createUrl(["site/login"]));
    
    //$url=Yii::$app->urlManager->createUrl([‘user/view’, ‘id’ => 1]);
    $url=Yii::$app->urlManager->createUrl(["site/login"]);
    Yii::$app->getResponse()->redirect($url);
}

if (Yii::$app->controller->action->id === 'login' && $isUser) {
    echo $this->render(
        'login',
        ['content' => $content]
    );
} elseif(isset($_GET['popup']) || isset($_POST['popup'])) {
    require_once("popup.php");
}else {
    Menu::getScripts($this, Yii::$app->controller->id, Yii::$app->controller->module->id);
    $assetsAdminLTE = AdminLTEAsset::register($this);
    $assetsApp      = AppAsset::register($this);
    $assetsFont     = FontAwesomeAsset::register($this);
    $assetsToastr   = ToastrAsset::register($this);
    $assetsBlockui  = BlockuiAsset::register($this);
    $assetsPopup    = MagnificPopupAsset::register($this);

    //$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/admin-lte';
    $directoryAsset = $assetsAdminLTE->baseUrl;

    $arr_date['Jan'] = Yii::t("calendar","Jan");
    $arr_date['Feb'] = Yii::t("calendar","Feb");
    $arr_date['Mar'] = Yii::t("calendar","Mar");
    $arr_date['Apr'] = Yii::t("calendar","Apr");
    $arr_date['May'] = Yii::t("calendar","May");
    $arr_date['Jun'] = Yii::t("calendar","Jun");
    $arr_date['Jul'] = Yii::t("calendar","Jul");
    $arr_date['Aug'] = Yii::t("calendar","Aug");
    $arr_date['Sep'] = Yii::t("calendar","Sep");
    $arr_date['Oct'] = Yii::t("calendar","Oct");
    $arr_date['Nov'] = Yii::t("calendar","Nov");
    $arr_date['Dec'] = Yii::t("calendar","Dec");
    $_SESSION['JSLANG'] = $arr_date;
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?= $directoryAsset; ?>/img/logos/favicon.ico" type="image/x-icon" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!--<script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>-->
        <?php $this->head() ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <?php Menu::generateJSLang("messages", Yii::$app->language); ?>
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-blue-light                         |
    |               | skin-black                              |
    |               | skin-black-light                        |
    |               | skin-purple                             |
    |               | skin-purple-light                       |
    |               | skin-yellow                             |
    |               | skin-yellow-light                       |
    |               | skin-red                                |
    |               | skin-red-light                          |
    |               | skin-green                              |
    |               | skin-green-light                        |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |---------------------------------------------------------|

    -->
    <body class="hold-transition skin-black sidebar-mini body-system">
    <?php $this->beginBody() ?>
        <div class="wrapper">
            <!-- Main Header -->
            <?= $this->render('header.php',['directoryAsset' => $directoryAsset]) ?>

            <!-- Left side column. contains the logo and sidebar -->
            <?= $this->render('left.php',['directoryAsset' => $directoryAsset]) ?>

            <!-- Content Wrapper. Contains page content -->
            <?= $this->render('wrapper.php',['directoryAsset' => $directoryAsset, 'content' => $content]) ?>

            <!-- Main Footer -->
            <?= $this->render('footer.php',['directoryAsset' => $directoryAsset]) ?>

        </div>
        <!-- Modal -->
        <?= $this->render('modal.php',['directoryAsset' => $directoryAsset]); ?>
        <!-- Chat Content -->
        <div class="div-chat">
            <div class="chat-section"></div>
        </div>
        <?= $this->render('hiddenVars.php',['directoryAsset' => $directoryAsset]); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
