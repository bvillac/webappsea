<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//
use yii\helpers\Html;
use yii\helpers\Url;
$seccion=\app\models\Tienda::getSeccionTienda();
?>
<div class="brands_products"><!--brands_products-->
    <h2><?=Yii::t("store", "Tienda")?></h2>
    <div class="brands-name">
        <ul id="nivel_0" class="nav nav-pills nav-stacked">
        <!--<ul id="categoria" class="nav nav-pills nav-stacked">-->
            <?php 
                $nomSelected=$nivel_0[0]['nom_cat'];
                for ($i = 0; $i < sizeof($seccion); $i++) {  
                    $nombre=$seccion[$i]['nom_cat']; 
                    if($nombre==$nomSelected){ ?>            
                        <li><?= Html::a('<h4><span class="badge badge-secondary">'.$nomSelected.'</span></h4>',Url::to('#') ,['onclick' => 'javascript:mostrarCategoria(\'' . base64_encode($seccion[$i]['ids_cat']) . '\',\'' . $seccion[$i]['nom_cat'] . '\');']) ?></li>
                    <?php } else { ?>
                        <li><?= Html::a($nombre,Url::to('#') ,['onclick' => 'javascript:mostrarCategoria(\'' . base64_encode($seccion[$i]['ids_cat']) . '\',\'' . $seccion[$i]['nom_cat'] . '\');']) ?></li>
                    <?php }  ?>
            <?php }  ?>
        </ul>
    </div>
</div><!--/brands_products-->
