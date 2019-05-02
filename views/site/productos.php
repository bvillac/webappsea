<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->params['alias']; //'My Yii Application';
?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <?= $this->render('_seccion-sub-productos.php', ['directoryAsset' => $directoryAsset,
            'nomCat' => $nomCat,'seccion' => $subnivel]) ?> 
        <?php //$this->render('_seccion-productos.php', ['directoryAsset' => $directoryAsset]) ?> 
        <?php //$this->render('_category-products.php', ['directoryAsset' => $directoryAsset]) ?> 
        <?php //$this->render('_brands_products.php', ['directoryAsset' => $directoryAsset]) ?> 
    </div>
</div>


<div class="col-sm-9 padding-right">
    <?= $this->render('_barrabuscar.php') ?> 
    <?= $this->render('_features_items.php', ['directoryAsset' => $directoryAsset,'models'=> $models,'pages' => $pages]) ?> 
    <?= $this->render('_recommended_items.php', ['directoryAsset' => $directoryAsset]) ?> 
</div>


