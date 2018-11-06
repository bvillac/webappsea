<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usu_id',
            'per_id',
            'usu_username',
            'usu_password',
            'usu_sha',
            //'usu_session',
            //'usu_last_login',
            //'usu_link_activo:ntext',
            //'usu_estado_activo',
            //'usu_alias',
            //'usu_est_log',
            //'usu_fec_cre',
            //'usu_fec_mod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
