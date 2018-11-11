<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\FontAwesomeAsset;
use app\assets\AppAsset;
use app\models\Menu;
use app\themes\adminLTE\resources\AdminLTEAsset;
use app\vendor\penblu\blockui\BlockuiAsset;
use app\vendor\penblu\magnificpopup\MagnificPopupAsset;

$session = Yii::$app->session;
$isUser = FALSE;
if ($session->isActive) {
    $isUser = $session->get('PB_isuser');
}
if ($isUser) {
    $assetsAdminLTE = AdminLTEAsset::register($this);
    $assetsApp = AppAsset::register($this);
    $assetsFont = FontAwesomeAsset::register($this);
    $assetsBlockui = BlockuiAsset::register($this);
    $assetsPopup = MagnificPopupAsset::register($this);
    $directoryAsset = $assetsAdminLTE->baseUrl;
    ?>
    <?php $this->beginPage() ?>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="shortcut icon" href="<?= $directoryAsset; ?>/img/logos/favicon.ico" type="image/x-icon" />
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->
            <?php Menu::generateJSLang("messages", Yii::$app->language); ?>
        </head>
        <body class="hold-transition">
            <?php $this->beginBody() ?>
            <div>
                <!-- Content Wrapper. Contains page content -->
                <?= $this->render('wrapper-login.php', ['directoryAsset' => $directoryAsset, 'content' => $content]) ?>
            </div>
            <!-- Modal -->
            <?= $this->render('modal.php',['directoryAsset' => $directoryAsset]); ?>
            
            <?= $this->render('hiddenVars.php',['directoryAsset' => $directoryAsset]); ?>
            
            <?php $this->endBody() ?>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } else { ?>
    <html>
        <head>  
        </head>
        <body>
            No session
        </body>
    </html>
<?php } ?>

