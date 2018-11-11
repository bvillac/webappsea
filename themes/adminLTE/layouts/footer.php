<?php

use yii\helpers\Html;
?>
<footer class="main-footer">
    <!-- To the right 2.3.0-->
    <div class="pull-right hidden-xs">
<?php //echo Html::encode(Yii::t("app", "Version")) ?> <?php //echo Html::encode(\Yii::$app->params['version']) ?>
    </div>
    <!-- Default to the left --> 
    <strong>Copyright &copy; <?= Html::encode(date("Y")) ?> <a href="<?= Html::encode(\Yii::$app->params['web']) ?>" target="_blank"><?= Html::encode(\Yii::$app->params['copyright']) ?></a></strong> <?= Html::encode(Yii::t("app", "All rights reserved.")) ?>
</footer>

