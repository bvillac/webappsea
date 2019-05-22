<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="brands_products"><!--brands_products-->
    <h2 id="lbl_NameCat_N2"><?= Yii::t("store", $nomCat)?></h2>
    <div id="listaSubCategorias" class="brands-name">
        <?php if(sizeof($seccion)<1){ ?>
            <div class="col-sm-12 alert alert-warning" role="alert">
                <?= Yii::t("store", "Has no results !!!") ; ?>
            </div> 
        <?php } ?>
        <ul id="nivel_2" class="nav nav-pills nav-stacked">
            <?php for ($i = 0; $i < sizeof($seccion); $i++) {  ?>
            <li><?= Html::a($seccion[$i]['nom_cat'],['site/productos','codigo' => base64_encode($seccion[$i]['ids_cat'])]); ?> 
            <?php }  ?>
        </ul>
    </div>
</div><!--/brands_products-->
