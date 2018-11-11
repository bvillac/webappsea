<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\Html;
use app\themes\store\resources\StoreAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);

$assetsStore= StoreAsset::register($this);

$directoryAsset = $assetsStore->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    
    <div>   
    	<header id="header"><!--header-->
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
            <?= $this->render('footer-top.php',['directoryAsset' => $directoryAsset]) ?> 
            <?= $this->render('footer-widget.php',['directoryAsset' => $directoryAsset]) ?> 
            <?= $this->render('footer.php') ?> 
        </footer><!--/Footer-->
</div> 
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
