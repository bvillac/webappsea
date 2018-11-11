<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\FontAwesomeAsset;
use app\assets\AppAsset;
use app\models\Menu;
use app\themes\adminLTE\resources\AdminLTEAsset;
use odaialali\yii2toastr\ToastrAsset;
use app\vendor\penblu\blockui\BlockuiAsset;
use app\vendor\penblu\magnificpopup\MagnificPopupAsset;

Menu::getScripts($this, Yii::$app->controller->id, Yii::$app->controller->module->id);
$assetsAdminLTE = AdminLTEAsset::register($this);
$assetsApp  = AppAsset::register($this);
$assetsFont = FontAwesomeAsset::register($this);
$assetsToastr   = ToastrAsset::register($this);
$assetsBlockui  = BlockuiAsset::register($this);
$assetsPopup    = MagnificPopupAsset::register($this);
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/admin-lte';
$directoryAsset = $assetsAdminLTE->baseUrl;
$this->title = $this->params["siteName"];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
    <body class="login-page skin-blue body-loginr">
        <?php $this->beginBody() ?>
        <div class="login-box">
            <!-- /.login-box-body -->
            <?= $this->render('index-login', ['directoryAsset' => $directoryAsset, 'model' => $model]) ?>
        </div><!-- /.login-box -->
        
        <!-- Modal -->
        <?= $this->render('modal.php',['directoryAsset' => $directoryAsset]); ?>
        
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

