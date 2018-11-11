<?php

use yii\helpers\Html;
use app\assets\FontAwesomeAsset;
use app\assets\AppAsset;
use app\themes\adminLTE\resources\AdminLTEAsset;
use app\vendor\penblu\magnificpopup\MagnificPopupAsset;

$assetsAdminLTE = AdminLTEAsset::register($this);
$assetsApp = AppAsset::register($this);
$assetsFont = FontAwesomeAsset::register($this);
$assetsPopup    = MagnificPopupAsset::register($this);
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/admin-lte';
$directoryAsset = $assetsAdminLTE->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black sidebar-collapse">
        <?php $this->beginBody() ?>
        <header class="main-header">
            <!-- Logo -->
            <a href="javascript:" class="logo"><img src="<?= Html::encode($directoryAsset . "/img/logos/logoh_". Yii::$app->language .".png") ?>" alt="logo" style="height: 100%;" /></a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation"></nav>
        </header>
        <div class="content-wrapper">
            <div class="box-body">
                <?= $content ?>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

        <!-- Main Footer -->
        <?= $this->render('footer.php', ['directoryAsset' => $directoryAsset]) ?>

    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

