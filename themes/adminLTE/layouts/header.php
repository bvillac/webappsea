<?php
use yii\helpers\Url;
use \app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>

<header class="main-header">

    <!-- Logo -->
    <a href="<?= Yii::$app->params['web'] ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?= Html::encode($directoryAsset . "/img/logos/miniLogoA.png") ?>" alt="minilogo" style="height: 100%;" /></span>
        <img src="<?= Html::encode($directoryAsset . "/img/logos/logoh_".Yii::$app->language.".png") ?>" alt="logo" style="height: 100%;" />
        <!-- logo for regular state and mobile devices 
        <span class="logo-lg"><b><?= Yii::$app->params['copyright'] ?></b></span>-->
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="javascript:" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="pbtimebox">
                    <a href="javascript:">
                        <span class="time-box">
                            <span class="pbtimeHour"></span>
                            <span class="pbtimeSep"></span>
                            <span class="pbtimeMin"></span>
                            <span class="time-minilb"></span>
                            <span class="time-minidate"></span>
                        </span>
                    </a>
                </li>
                <!-- User Account Menu -->
                <li class="user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="javascript:" class="usuSession">
                        <span><?= @Yii::$app->session->get("RolName").": ". Html::encode(Yii::t("perfil", "Hello")) . ", " . @Yii::$app->session->get("PB_nombres") ?></span>
                    </a>
                </li>
                <li>
                    <?= Html::a("<i class='glyphicon glyphicon-log-out'></i>", ['/site/logout'], ['data-method' => 'post', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'data-trigger' => 'hover' ,'title' => Html::encode(Yii::t("login", "Sign Out"))]) ?></span>
                </li>
            </ul>
        </div>
    </nav>
</header> 
