<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$model = 0;
?>
<section id="cart_items"><!--#cart_items-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#"><?= Yii::t("store", "Home") ?></a></li>
                <li class="active"><?= Yii::t("store", "Shopping Cart") ?></li>
            </ol>
        </div>
        <?= $this->render('_cart_items.php', ['directoryAsset' => $directoryAsset, 'model' => $model]) ?> 
    </div>
</section><!--#cart_items-->


