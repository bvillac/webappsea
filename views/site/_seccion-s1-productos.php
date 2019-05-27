<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!--<h2><?php //Yii::t("store", "Category")?></h2>
<div class="brands_products">brands_products
    <div id="listaCategorias"></div>
</div>/category-products-->

<div class="brands_products"><!--brands_products-->
    <h2 id="lbl_NameCat_N1"><?= Yii::t("store", $nomCat)?></h2>
    <div id="listaCategorias"  class="brands-name">
        <?php if(sizeof($seccion)<1){ ?>
            <div class="col-sm-12 alert alert-warning" role="alert">
                <?= Yii::t("store", "Has no results !!!") ; ?>
            </div> 
        <?php } ?>
        <ul id="nivel_1" class="nav nav-pills nav-stacked">
            <?php for ($i = 0; $i < sizeof($seccion); $i++) {
                $ids=$seccion[$i]['ids_cat'];
                $nombre=$seccion[$i]['nom_cat'];            
                if($seccion[$i]['nom_cat']==$nomSelected){ ?>
                    <li><?= Html::a('<h4><span class="badge badge-secondary">'.$nomSelected.'</span></h4>',Url::to('#'),['onclick'=>"javascript:mostrarSubCategoria('$ids','$nombre')"]); ?> 
                    
                <?php } else { ?>
                    <li><?= Html::a($nombre,Url::to('#'),['onclick'=>"javascript:mostrarSubCategoria('$ids','$nombre')"]); ?> 
                <?php } ?>
                
            <?php }  ?>
        </ul>
    </div>
</div><!--/brands_products-->

