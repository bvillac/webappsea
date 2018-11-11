<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>
<footer class="footer">
    <div class="container">
        <p class="pull-left"><strong>Copyright &copy; <?= Html::encode(date("Y")) ?> <a href="<?= Html::encode(\Yii::$app->params['web']) ?>" target="_blank"><?= Html::encode(\Yii::$app->params['copyright']) ?></a></strong> <?= Html::encode(Yii::t("app", "All rights reserved.")) ?></p>

<!--        <p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>








