<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->params['alias']; //'My Yii Application';
?>
<!--slider-->
    <?= $this->render('_slider.php', ['directoryAsset' => $directoryAsset]) ?> 
<!--/slider-->
<div class="col-sm-3">
    <div class="left-sidebar">
        <?= $this->render('_category-products.php', ['directoryAsset' => $directoryAsset]) ?> 
        <?php //$this->render('_brands_products.php', ['directoryAsset' => $directoryAsset]) ?> 
        <div class="price-range"><!--price-range-->
            <h2><?= Yii::t("store", "Price Range")?></h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center"><!--shipping-->
            <!--<img src="images/home/shipping.jpg" alt="" />-->
        </div><!--/shipping-->

    </div>
</div>


<div class="col-sm-9 padding-right">
    <?= $this->render('_features_items.php', ['directoryAsset' => $directoryAsset,'pages' => $pages]) ?> 
    <?php //$this->render('_category-tab.php', ['directoryAsset' => $directoryAsset]) ?> 
    <?php //$this->render('_recommended_items.php', ['directoryAsset' => $directoryAsset]) ?> 			
</div>


<script>
    
    //var varData = JSON.parse(base64_decode('<?php //echo $data; ?>')) ;
    //var varData = JSON.parse('<?php //echo $data; ?>') ;
    //var varData = ('<?php //echo $data; ?>') ;
     
    //loadDataIndex();
    

</script>
