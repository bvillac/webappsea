<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('app', 'Create Empresa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
