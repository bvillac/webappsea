<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><?= Html::a(Yii::t("store", "Home"), ['site/index'],['class' => 'active']); ?></li>                       
                        <li class="dropdown"><?= Html::a(Yii::t("store", "Shop").'<i class="fa fa-angle-down"></i> ', ['site/index']); ?></a>
                            <ul role="menu" class="sub-menu">
                                <li><?= Html::a(Yii::t("store", "Products"), ['site/shop']); ?></li>
                                <li><?= Html::a(Yii::t("store", "Product Details"), ['site/product-details']); ?></li> 
                                <li><?= Html::a(Yii::t("store", "Checkout"), ['site/checkout']); ?></li> 
                                <li><?= Html::a(Yii::t("store", "Cart"), ['site/cart']); ?></li> 
                                <li><?= Html::a(Yii::t("store", "Login"), ['site/login']); ?></li> 
                            </ul>
                        </li> 
<!--                        <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="blog.html">Blog List</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                            </ul>
                        </li> 
                        <li><a href="404.html">404</a></li>                 -->
                        <li><?= Html::a(Yii::t("store", "Contact"), ['site/contact']); ?></li>      
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="search_box pull-right">
                    <input type="text" placeholder="Search"/>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->

