<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('app', 'Update Empresa: ' . $model->emp_id, [
    'nameAttribute' => '' . $model->emp_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp_id, 'url' => ['view', 'id' => $model->emp_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="empresa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
