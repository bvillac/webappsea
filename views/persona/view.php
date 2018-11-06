<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = $model->per_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->per_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->per_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'per_id',
            'per_ced_ruc',
            'per_nombre',
            'per_apellido',
            'per_genero',
            'per_fecha_nacimiento',
            'per_estado_civil',
            'per_correo',
            'per_tipo_sangre',
            'per_foto',
            'per_estado_activo',
            'per_est_log',
            'per_fec_cre',
            'per_fec_mod',
        ],
    ]) ?>

</div>
