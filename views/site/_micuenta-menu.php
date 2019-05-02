<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//active disabled
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading">Mi Cuenta</div>
    <div class="panel-body">
        <div class="list-group list-group-flush">
            <li class="list-group-item"><?= Html::a(Yii::t("store", "Mis Datos"), ['site/micuenta']); ?></li>
            <li class="list-group-item"><?= Html::a(Yii::t("store", "Mis Pedidos"), ['site/mispedidos']); ?></li>
            <li class="list-group-item"><?= Html::a(Yii::t("store", "Lista de Pedidos"), ['site/mislistas']); ?></li>
            <li class="list-group-item"><?= Html::a('<i class="glyphicon glyphicon-log-out"></i> '.Yii::t("store", "Salir"), ['site/logout']); ?></li>           
        </div>
    </div>
</div>


