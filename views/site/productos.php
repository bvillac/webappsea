<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->params['alias']; //'My Yii Application';
?>

<?= Html::hiddenInput('txth_idsCat', $subnivel[0]['ids_cat'], ["id" => "txth_idsCat"]) ?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <?= $this->render('_seccion-productos.php') ?> 
        <?= $this->render('_seccion-sub-productos.php', ['nomCat' => $nomCat,'seccion' => $subnivel]) ?>         
        <?php //$this->render('_category-products.php', ['directoryAsset' => $directoryAsset]) ?> 
        <?php //$this->render('_brands_products.php', ['directoryAsset' => $directoryAsset]) ?> 
    </div>
</div>


<div class="col-sm-9 padding-right">
    <?= $this->render('_barrabuscar.php') ?> 
    <?= $this->render('_features_items.php', ['models'=> $models,'pages' => $pages,'seccion' => $subnivel]) ?> 
    <?= $this->render('_recommended_items.php') ?> 
</div>


