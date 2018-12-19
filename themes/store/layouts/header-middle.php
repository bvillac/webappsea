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
<!--                <div class="btn-group pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                            USA
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Canada</a></li>
                            <li><a href="#">UK</a></li>
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                            DOLLAR
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Canadian Dollar</a></li>
                            <li><a href="#">Pound</a></li>
                        </ul>
                    </div>
                </div>-->
            </div>
            <div class="col-sm-8">
                <div class="shop-menu pull-right">
                    <ul class="nav navbar-nav">
                        <?php if ($isUser != FALSE && $session->isActive ){ ?>
                            <li><?= Html::a('<i class="fa fa-user"></i> '.Yii::t("store", "Account"), ['site/index']); ?></li>
                        <?php }else{ ?>
                            <li><?= Html::a('<i class="fa fa-user"></i> '.Yii::t("login", "Create Account"), ['site/index']); ?></li>
                        <?php } ?>
                        <li><?php //Html::a('<i class="fa fa-user"></i> '.Yii::t("store", "Account"), ['site/index']); ?></li>
                        <li><?= Html::a('<i class="fa fa-star"></i> '.Yii::t("store", "Wishlist"), ['site/index']); ?></li>
                        <li><?= Html::a('<i class="fa fa-crosshairs"></i> '.Yii::t("store", "Checkout"), ['site/checkout']); ?></li>
                        <li><?= Html::a('<i class="fa fa-shopping-cart"></i> '.Yii::t("store", "Cart"), ['site/cart']); ?></li>
                        <?php if ($isUser != FALSE && $session->isActive ){ ?>
                            <li><?= Html::a('<i class="glyphicon glyphicon-log-out"></i> '.Yii::$app->user->identity->usu_username.' ('.Yii::t("login", "Sign Out").')', ['site/logout']); ?></li>
                        <?php }else{ ?>
                            <li><?= Html::a('<i class="fa fa-lock"></i> '.Yii::t("login", "Login"), ['site/login']); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-middle-->

