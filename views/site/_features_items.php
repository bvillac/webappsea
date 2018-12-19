<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Tienda;

//$CastPro=app\models\Tienda::getMarcaTienda();
$num_total_rows= Tienda::getCountProductoTienda();
?>

<div class="features_items"><!--features_items-->
    <h2 class="title text-center"><?=Yii::t("store", "Features Items")?></h2>
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="cmb_orden" class="col-sm-6 control-label"><?= Yii::t("perfil", "Ordenar por:") ?></label>
            <div class="col-sm-6">
                <?= Html::dropDownList("cmb_orden", 0, app\models\Utilities::orderItems(), ["class" => "form-control", "id" => "cmb_orden"]) ?>
            </div>
        </div>
    </div>
    <div id="listaPedidos"></div>
</div><!--features_items-->


<?php
//$num_pages = 10;
if ($num_total_rows > 0) {
    $num_pages = ceil($num_total_rows / (\Yii::$app->params['pagePro']));
    echo '<div class="row">';
    echo '<div class="col-lg-12">';
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-end">';
    //for ($i = 1; $i <= $num_pages; $i++) {
    for ($i = 1; $i <= 10; $i++) {
        $class_active = '';
        if ($i == 1) {
            $class_active = 'active';
        }
        //echo '<li class="page-item '.$class_active.'"><a class="page-link" href="#" data="'.$i.'">'.$i.'</a></li>';
        echo '<li class="page-item ' . $class_active . '"><a class="page-link" data="' . $i . '">' . $i . '</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';
    echo '</div>';
}
?>

<?php //LinkPager::widget([
    //'pagination' => $pages,
//])?>
