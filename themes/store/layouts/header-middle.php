<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;
$session = Yii::$app->session;
$isUser = FALSE;
$isUser = $session->get('PB_isuser', FALSE);
?>

<div class="header-middle"><!--header-middle-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="logo pull-left">
                    <?= Html::a(Html::img(Url::base().'/web/img/home/LogoTienda.png', ['alt'=>'Logo Utimpor']), ['site/index']); ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="shop-menu pull-right">
<!--                    <button type="button" class="btn btn-success openBtn">Open Modal</button>-->
                    <ul class="nav navbar-nav">
                        <?php if ($isUser != FALSE && $session->isActive ){ ?>
                            <li><?= Html::a('<i class="fa fa-user"></i> '.Yii::t("store", "Account"), ['site/micuenta']); ?></li>
                            <li><?= Html::a('<i class="fa fa-star"></i> '.Yii::t("store", "Wishlist"), ['site/index']); ?></li>
                            <li><?= Html::a('<i class="fa fa-crosshairs"></i> '.Yii::t("store", "Checkout"), ['site/checkout']); ?></li>
                        <?php }else{ ?>
                            <li><?= Html::a('<i class="fa fa-user"></i> '.Yii::t("login", "Create Account"), Url::to('#'),['onclick'=>'javascript:nuevaCuentaModal();']); ?></li>
                        <?php } ?>
                        <li><?php //Html::a('<i class="fa fa-user"></i> '.Yii::t("store", "Account"), ['site/index']); ?></li>

                        <li><?= Html::a('<i id="lbl_countCar" class="fa fa-shopping-cart"></i> '.Yii::t("store", "Cart"), ['site/carrito']); ?></li>
                        <?php if ($isUser != FALSE && $session->isActive ){ ?>
                            <li> <?= Html::a('<i class="glyphicon glyphicon-log-out"></i>Hola '.Yii::$app->user->identity->usu_username.' ('.Yii::t("login", "Sign Out").')', ['site/logout']); ?></li>
                        <?php }else{ ?>
                            <!--<li><?php //Html::a('<i class="fa fa-lock"></i> '.Yii::t("login", "Login"), ['site/login']); ?></li>-->
                            <li><?= Html::a('<i class="fa fa-lock"></i> '.Yii::t("login", "Login"), Url::to('#'),['onclick'=>'javascript:loginModal();']); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-middle-->

