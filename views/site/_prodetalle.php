<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Tienda;
use yii\helpers\Url;
?>

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
<!--            <img src="images/product-details/1.jpg" alt="" />-->
            <img src="<?= Url::base().Yii::$app->params["imgFolder"] ?>imgG.jpg" alt="" />
            
            <h3>ZOOM</h3>
        </div>
<!--        <div id="similar-product" class="carousel slide" data-ride="carousel">

             Wrapper for slides 
            <div class="carousel-inner">
                <div class="item active">
                    <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                </div>

            </div>

             Controls 
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>-->

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="<?= Url::base() ?>/web/img/product-details/new.jpg" class="newarrival" alt="" />
            <h2><?= $model[0]['des_com'] ?></h2>
            <p>PARTE ID: <?= $model[0]['cod_art'] ?></p>
            <img src="<?= Url::base() ?>/web/img/product-details/rating.png" alt="" />
            <span>
                <span>$<?= app\models\Utilities::round_out($model[0]['p_venta'], 2) ?></span>
                <label><?=Yii::t("store", "Quantity")?>:</label>
                <input type="text" value="0" />
                <?= Html::a(Yii::t("store", "Add to cart"), ['/site/cart'], ['class'=>'btn btn-fefault cart']) ?>
                <?php //Html::button('<i class="fa fa-shopping-cart"></i>'.Yii::t("store", "Add to cart"), ['class' => 'btn btn-fefault cart'])?>
<!--                <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                </button>-->
            </span>
            <p><b><?=Yii::t("store", "Availability")?>:</b> <?=Yii::t("store", "In Stock")?></p>
            <p><b><?=Yii::t("store", "Condition")?>:</b> <?=Yii::t("store", "New")?></p>
            <p><b><?=Yii::t("store", "Brand")?>:</b> <?= $model[0]['nom_mar'] ?></p>
            <a href=""><img src="<?= Url::base() ?>/web/img/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

