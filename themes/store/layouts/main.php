<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\Html;
use app\themes\store\resources\StoreAsset;
use app\assets\FontAwesomeAsset;
use app\models\Menu;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//use odaialali\yii2toastr\ToastrAsset;
use app\vendor\penblu\blockui\BlockuiAsset;
use app\vendor\penblu\magnificpopup\MagnificPopupAsset;
//AppAsset::register($this);

$assetsStore= StoreAsset::register($this);
$assetsApp = AppAsset::register($this);
$assetsFont = FontAwesomeAsset::register($this);
//$assetsToastr = ToastrAsset::register($this);
$assetsBlockui = BlockuiAsset::register($this);
$assetsPopup = MagnificPopupAsset::register($this);

$directoryAsset = $assetsStore->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= $directoryAsset; ?>/img/themeHome/favicon.ico" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php Menu::generateJSLang("messages", Yii::$app->language); ?>
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    
    <div>   
    	<header id="header"><!--header-->
            <?= $this->render('header') ?> 
            <?= $this->render('header_top.php',['directoryAsset' => $directoryAsset]) ?> 
            <?= $this->render('header-middle.php',['directoryAsset' => $directoryAsset]) ?> 
            <?= $this->render('header-bottom.php',['directoryAsset' => $directoryAsset]) ?> 
	</header><!--/header-->
        
        

        <section>
            <div class="container">
                <div class="row">
                    <?= $content ?>
                </div>
            </div>
        </section>
        
       
	
	 <!-- Main Footer -->
        <footer id="footer"><!--Footer-->
            <?php //$this->render('footer-top.php',['directoryAsset' => $directoryAsset]) ?> 
            <?= $this->render('footer-widget.php',['directoryAsset' => $directoryAsset]) ?> 
            <?= $this->render('footer.php') ?> 
        </footer><!--/Footer-->
</div> 
<!--    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKq8Ruomuy6eniHPeTyDHxlZs54LGipDk&callback=initMap">
    </script>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
