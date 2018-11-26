<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <?= $this->render('_category-products.php', ['directoryAsset' => $directoryAsset]) ?> 
        <?php //$this->render('_brands_products.php', ['directoryAsset' => $directoryAsset]) ?> 
    </div>
</div>


<div class="col-sm-9 padding-right">
    <?= $this->render('_prodetalle.php', ['directoryAsset' => $directoryAsset,'model' => $model]) ?> 
    <?php //$this->render('_category-tab.php', ['directoryAsset' => $directoryAsset]) ?> 
    <?php //$this->render('_recommended_items.php', ['directoryAsset' => $directoryAsset]) ?> 			
</div>

