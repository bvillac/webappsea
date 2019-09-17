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
$Ruta=Url::base() . Yii::$app->params["imgFolder"];
$ItemReco=$models;

$isUser = Yii::$app->session->get('PB_isuser', FALSE);

//$CastPro=app\models\Tienda::getMarcaTienda();
//$num_total_rows= Tienda::getCountProductoTienda();
?>


<div class="features_items"><!--features_items-->
    <h2 id="lbl_NameCat_N3" class="title text-center"><?= Yii::t("store", $nomCat)?></h2>
    <div class="form-group row">
        <div class="col-sm-6"></div>
        <label for="cmb_orden" class="col-sm-2 control-label"><?= Yii::t("perfil", "Ordenar por:") ?></label>
        <div class="col-sm-4">
            <?= Html::dropDownList("cmb_orden", 0, app\models\Utilities::orderItems(), ["class" => "form-control", "id" => "cmb_orden"]) ?>
        </div>
    </div>
 
    
    
    <div id="listaPedidos">
        <?php if(sizeof($ItemReco)<1){ ?>
            <div class="col-sm-12 alert alert-warning" role="alert">
                <?= Yii::t("store", "Has no results !!!") ; ?>
            </div> 
        <?php } ?>
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
                <?php if($isUser){ ?>
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">                                        
                                <?php //$imgData=Html::img($Ruta.$ItemReco[$fil]['cod_art']."_P-01.jpg",['class' => 'img-responsive ']); ?>
                                <?php $imgData= app\models\Utilities::verImagen($ItemReco[$fil]['cod_art']); ?>
                                <?= Html::a($imgData, ['/site/productodetalle','codigo' => $ItemReco[$fil]['ids_pro']], ['id' => 'btn_masvendidos']); ?> 
                                <h2>
                                    $<?= app\models\Utilities::round_out($ItemReco[$fil]['p_venta'], 2) ?>
                                    <img id="imgVisto_<?= $ItemReco[$fil]['cod_art']?>" style="display:none;" class="imgProVisto" src="<?= Url::base() ?>/web/img/product-details/VistoBueno.png" alt="" />
                                </h2>
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
                <?php }else{ ?>
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">                                        
                                <?php $imgData= app\models\Utilities::verImagen($ItemReco[$fil]['cod_art']); ?>
                                <?= Html::a($imgData, ['/site/productodetalle','codigo' => $ItemReco[$fil]['ids_pro']], ['id' => 'btn_masvendidos']); ?> 
                                <p><?=$ItemReco[$fil]['des_com']?></p>                                                               
                                <?= Html::a('Ver Detalle', ['/site/productodetalle','codigo' => $ItemReco[$fil]['ids_pro']], ['id' => 'btn_detalle','class'=>'btn btn-primary']); ?> 

                            </div>
                        </div>                        
                    </div>
                <?php } ?>
            </div> 
        <?php 
            $fil++; 
            $n++; 
        } 
        ?>
        </div>
    <?php 
        $i=$i+$n;                    
    }
     ?>
    </div>
    
</div><!--features_items-->


<?php
//$num_pages = 10;
$num_total_rows=$pages;
if ($num_total_rows > 0) {
    $num_pages = ceil($num_total_rows / (\Yii::$app->params['pagePro']));
    echo '<div class="row">';
    echo '<div id="Paginado" class="col-lg-12">';
    echo '<nav  aria-label="Page navigation">';
    echo '<ul class="pagination justify-content-end">';
    for ($i = 1; $i <= $num_pages; $i++) {
    //for ($i = 1; $i <= 10; $i++) {
        $class_active = '';
        if ($i == 1) {
            $class_active = 'active';
        }
        //echo '<li class="page-item '.$class_active.'"><a class="page-link" href="#" data="'.$i.'">'.$i.'</a></li>';
        echo '<li class="page-item ' . $class_active . '"><a class="page-link" data="' . $i . '">' . $i . '</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';
    echo '</div>';
}
?>

<?php //echo LinkPager::widget([
    //'pagination' => $pages
//])?>
