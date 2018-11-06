<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Persona'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'per_id',
            'per_ced_ruc',
            'per_nombre',
            'per_apellido',
            'per_genero',
            //'per_fecha_nacimiento',
            //'per_estado_civil',
            //'per_correo',
            //'per_tipo_sangre',
            //'per_foto',
            //'per_estado_activo',
            //'per_est_log',
            //'per_fec_cre',
            //'per_fec_mod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
