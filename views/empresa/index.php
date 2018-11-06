<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Empresa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'emp_id',
            'emp_nombre',
            'emp_ruc',
            'emp_descripcion',
            'emp_direccion',
            //'emp_telefono',
            //'emp_est_log',
            //'emp_fec_cre',
            //'emp_fec_mod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
