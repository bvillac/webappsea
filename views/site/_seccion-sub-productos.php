<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//
use yii\helpers\Html;
use yii\helpers\Url;
app\models\Utilities::putMessageLogFile($seccion);
?>
<div class="brands_products"><!--brands_products-->
    <h2><?=Yii::t("store", "Sub Categoria")?></h2>
    <div class="brands-name">
        <ul id="categoria" class="nav nav-pills nav-stacked">
            <?php for ($i = 0; $i < sizeof($seccion); $i++) {  ?>
            <li><?= Html::a($seccion[$i]['nom_cat'],['site/productos','codigo' => base64_encode($seccion[$i]['ids_cat'])]); ?> 
            <?php }  ?>
        </ul>
    </div>
</div><!--/brands_products-->
