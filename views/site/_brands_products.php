<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
$CastPro=app\models\Tienda::getMarcaTienda();
?>

<div class="brands_products"><!--brands_products-->
    <h2><?=Yii::t("store", "Brands")?></h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            <?php for ($i = 0; $i < sizeof($CastPro); $i++) {  ?>
            <li><?= Html::a('<span class="pull-right">('.$CastPro[$i]['rcount'].')</span>'.$CastPro[$i]['nom_mar'],['href' => 'javascript:verproducto(\'' . base64_encode($CastPro[$i]['ids_mar']) . '\');']); ?></li>
            <?php }  ?>
        </ul>
    </div>
</div><!--/brands_products-->

