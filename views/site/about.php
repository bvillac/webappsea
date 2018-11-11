<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->title = Yii::$app->params['title']; //'My Yii Application';
$this->title = 'Nosotros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
