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

<?= Html::hiddenInput('txth_idsCat', $nivel_2[0]['ids_cat'], ["id" => "txth_idsCat"]) ?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <?= $this->render('_seccion-productos.php') ?> 
        <?= $this->render('_seccion-s1-productos.php',['nomCat' => Yii::t("store", "Category"),'seccion' => $nivel_1,'nomSelected' => $nomCatSup]) ?> 
        <?= $this->render('_seccion-s2-productos.php', ['nomCat' => $nomCatSup,'seccion' => $nivel_2,'nomSelected' => $nomCat]) ?>             
        <?php //$this->render('_brands_products.php', ['directoryAsset' => $directoryAsset]) ?> 
    </div>
</div>


<div class="col-sm-9 padding-right">
    <?= $this->render('_barrabuscar.php') ?> 
    <?= $this->render('_features_items.php', ['models'=> $models,'pages' => $pages,
                        'seccion' => $nivel_2,'nomCat' => $nomCat]) ?> 
    <?= $this->render('_recommended_items.php') ?> 
</div>


