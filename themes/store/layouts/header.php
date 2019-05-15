<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
$session = Yii::$app->session;
$isUser = $session->get('PB_isuser', FALSE);
?>
<?= Html::hiddenInput('txth_activo', $isUser, ["id" => "txth_activo"]) ?>
<?= Html::hiddenInput('txth_base', Url::base(), ["id" => "txth_base"]) ?>
<?= Html::hiddenInput('txth_imgfolder', Url::base().Yii::$app->params["imgFolder"], ["id"=>"txth_imgfolder"]) ?>

