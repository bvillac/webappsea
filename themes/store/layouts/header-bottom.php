<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\jui\AutoComplete;
use yii\web\JsExpression;


$SeccPro=app\models\Tienda::getSeccionTienda();
?>
<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <!----------------->
                
                <!----------------->
                <div class="mainmenu pull-left ">
                    <ul class="nav navbar-nav collapse navbar-collapse ">
                        <li><?= Html::a(Yii::t("store", "Home"), ['site/index'],['class' => 'active']); ?></li>                       
                        <li class="dropdown"><?= Html::a(Yii::t("store", "Shop").'<i class="fa fa-angle-down"></i> ', ['site/index']); ?></a>
                            <ul role="menu" class="sub-menu">
                                <?php for ($i = 0; $i < sizeof($SeccPro); $i++) {  ?>
                                <li><?= Html::a($SeccPro[$i]['nom_cat'], Url::to('#'),['onclick' => 'javascript:mostrarCategoria(\'' . base64_encode($SeccPro[$i]['ids_cat']) . '\');']); ?></li>
                                <?php }  ?>
<!--                            <li><?= Html::a(Yii::t("store", "Products"), ['site/shop']); ?></li>
                                <li><?= Html::a(Yii::t("store", "Product Details"), ['site/product-details']); ?></li> 
                                <li><?= Html::a(Yii::t("store", "Checkout"), ['site/checkout']); ?></li> 
                                <li><?= Html::a(Yii::t("store", "Cart"), ['site/cart']); ?></li> 
                                <li><?= Html::a(Yii::t("store", "Login"), ['site/login']); ?></li> -->
                            </ul>
                        </li> 
                        <li><?= Html::a(Yii::t("store", "Contact"), ['site/contact']); ?></li>      
                    </ul>
                </div>
<!--                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>-->
                
            </div>
            <div class="col-sm-6">
                <div class="search_box pull-right">
                        <?=
                        AutoComplete::widget([
                            'name' => 'txt_buscarData',
                            'id' => 'txt_buscarData',
                            'clientOptions' => [
                                'autoFill' => true,
                                'minLength' => '3',
                                'source' => new JsExpression("function( request, response ) {
                                            autocompletarBuscarProducto(request, response,'txt_buscarData','COD-NOM');
                                            }"),
                                'select' => new JsExpression("function( event, ui ) {
                                                    alert(ui.item.id);
                                                    //actualizaBuscarPersona(ui.item.PER_ID); 
                                                    //$('#txth_ids').val(ui.item.nombre);
                                                    //actualizarGrid();
                                             }")
                            ],
                            'options' => [
                                'class' => 'form-control',
                                //'Onkeyup' => 'clearGrid()',
                                'placeholder' => Yii::t("formulario", "Buscar productos")
                            ],
                        ]);
                        ?>
             
                </div>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->

