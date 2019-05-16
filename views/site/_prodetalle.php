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
//$Ruta=Url::base() . Yii::$app->params["imgFolder"];
?>

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <?= app\models\Utilities::verImagen($model[0]['cod_art']); ?>

<!--            <h3>ZOOM</h3>-->
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
<!--            <img src="<?= Url::base() ?>/web/img/product-details/new.jpg" class="newarrival" alt="" />-->
            <h2><?= $model[0]['des_com'] ?></h2>
            <p>PARTE ID: <?= $model[0]['cod_art'] ?></p>
            <img src="<?= Url::base() ?>/web/img/product-details/rating.png" alt="" />
            <span>
                <span>$<?= app\models\Utilities::round_out($model[0]['p_venta'], 2) ?></span>
                <label><?= Yii::t("store", "Quantity") ?>:</label>
                <input id="txt_cant" type="text" value="<?= $cant ?>" />
                <?php //Html::a(Yii::t("store", "Add to cart"), ['/site/cart'], ['class' => 'btn btn-fefault cart']) ?>
                <?= Html::button('<i class="fa fa-shopping-cart"></i>'.Yii::t("store", "Add to cart"), 
                                ['class' => 'btn btn-fefault cart','onclick'=>'addCarrito(\''.$model[0]["ids_pro"].'\',\''.$model[0]["cod_art"].'\',\''.$model[0]["des_com"].'\',\''.$model[0]["p_venta"].'\',\'txt_cant\')'])?>
        
            </span>
            <p><b><?= Yii::t("store", "Availability") ?>:</b> <?= Yii::t("store", "In Stock") ?></p>
            <p><b><?= Yii::t("store", "Condition") ?>:</b> <?= Yii::t("store", "New") ?></p>
            <p><b><?= Yii::t("store", "Brand") ?>:</b> <?= $model[0]['nom_mar'] ?></p>
            <a href=""><img src="<?= Url::base() ?>/web/img/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<?php
/*
<!--DETALLE DEL PRODUCTO-->
<!--category-tab-->
<div class="category-tab shop-details-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#reviews" data-toggle="tab">Detalles</a></li>
            <li><a href="#details" data-toggle="tab">Especificaciones</a></li>

        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details" >
            <p>
                Otenga color definido y calidad de imagen fotográfica exacta.
                Las fórmulas de tintas patentadas basadas en colorantes de los cartuchos de tinta color HP 11 permiten resultados profesionales de modo fácil y confiable, otorgando un valor excelente.
                Calidad de impresión excepcional y constante.
                Impresión sencilla de bajo mantenimiento.
                La fiabilidad de HP le permite ahorrar tiempo, aumentar su productividad y obtener una gran relación calidad-precio. 
            </p>



        </div>

        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">

                <strong>Color(es) de cartuchos de impresión:&nbsp;</strong>Amarillo<br>
                <strong>Gota de tinta:&nbsp;</strong>4 pl<br>
                <strong>Tipos de tinta compatible:&nbsp;</strong>Basada en colorantes<br>
                <strong>Rendimiento de la página (color):&nbsp;</strong>2.550 páginas<br>
                <br>             

                <!-- <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>-->
            </div>
        </div>

    </div>
</div><!--/category-tab-->
  */                      
?>

