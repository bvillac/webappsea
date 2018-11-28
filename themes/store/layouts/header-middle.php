<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;
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
                        <li><?= Html::a('<i class="fa fa-user"></i> '.Yii::t("store", "Account"), ['site/index']); ?></li>
                        <li><?= Html::a('<i class="fa fa-star"></i> '.Yii::t("store", "Wishlist"), ['site/index']); ?></li>
                        <li><?= Html::a('<i class="fa fa-crosshairs"></i> '.Yii::t("store", "Checkout"), ['site/checkout']); ?></li>
                        <li><?= Html::a('<i class="fa fa-shopping-cart"></i> '.Yii::t("store", "Cart"), ['site/cart']); ?></li>
                        <li><?= Html::a('<i class="fa fa-lock"></i> '.Yii::t("store", "Login"), ['site/login']); ?></li>
                   
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-middle-->

