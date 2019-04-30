<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;
$ItemReco=app\models\Tienda::getProductoTiendaMasVendidos('IDX');
$Ruta=Url::base() . Yii::$app->params["imgFolder"];
?>

<div class="features_items"><!--recommended_items-->
    <h2 class="title text-center"><?=Yii::t("store", "Recommended items")?></h2>
    <?php 
    $fil=0;
    $n=0;
    for ($i = 0; $i < sizeof($ItemReco); $i++) {  ?>
        <?php
        $n=0;?>
        <div class="row">
        <?php 
        while ($n < 3) { ?>
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">                                        
                            <?php $imgData=Html::img($Ruta.$ItemReco[$fil]['cod_art']."_G-01.jpg",['class' => 'img-responsive ']); ?>
                            <?= Html::a($imgData, ['/site/productodetalle','codigo' => $ItemReco[$fil]['ids_pro']], ['id' => 'btn_masvendidos']); ?> 
                            <h2>$<?= app\models\Utilities::round_out($ItemReco[$fil]['p_venta'], 2) ?></h2>
                            <p><?=$ItemReco[$fil]['des_com']?></p>                                         
                            <a onclick="addCarrito('<?= $ItemReco[$fil]['ids_pro'] ?>','<?= $ItemReco[$fil]['cod_art']?>','<?= $ItemReco[$fil]['des_com']?>','<?= $ItemReco[$fil]['p_venta']?>','0')" href="javascript:void(0)" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><?= Yii::t("store", "Add to cart") ?></a>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Agregar a lista de pedidos</a></li>
                            <li><?= Html::a("<i class='fa fa-plus-square'></i>Ver Carrito", ['/site/carrito']); ?></li>                            
                        </ul>
                    </div>
                </div>
            </div> 
        <?php 
            $fil++; 
            $n++; 
        } 
        ?>
        </div>
    <?php 
        $i=$i+$n;                    
    }  ?>

</div><!--/recommended_items-->

