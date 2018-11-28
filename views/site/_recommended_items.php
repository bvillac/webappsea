<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
?>

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center"><?=Yii::t("store", "Recommended items")?></h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
<!--                                <img src="images/home/recommend1.jpg" alt="" />-->
                                <img src="<?= Url::base() . Yii::$app->params["imgFolder"] ?>A0032_P-01.jpg" alt="" />
                                <h2>$56</h2>
                                <p>PRODUCTO 1</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?= Url::base() . Yii::$app->params["imgFolder"] ?>A0037_P-01.jpg" alt="" />
                                <h2>$56</h2>
                                <p>PRODUCTO 2</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?= Url::base() . Yii::$app->params["imgFolder"] ?>A0038_P-01.jpg" alt="" />
                                <h2>$56</h2>
                                <p>PRODUCTO 3</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="item">	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?= Url::base() . Yii::$app->params["imgFolder"] ?>C0111_P-01.jpg" alt="" />
                                <h2>$56</h2>
                                <p>PRODUCTO 4</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?= Url::base() . Yii::$app->params["imgFolder"] ?>C0317_P-01.jpg" alt="" />
                                <h2>$56</h2>
                                <p>PRODUCTO 5</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                     <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?= Url::base() . Yii::$app->params["imgFolder"] ?>C0341_P-01.jpg" alt="" />
                                <h2>$56</h2>
                                <p>PRODUCTO 6</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>			
    </div>
</div><!--/recommended_items-->

