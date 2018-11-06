<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'per_id')->textInput() ?>

    <?= $form->field($model, 'usu_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_sha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_session')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_last_login')->textInput() ?>

    <?= $form->field($model, 'usu_link_activo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usu_estado_activo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_est_log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_fec_cre')->textInput() ?>

    <?= $form->field($model, 'usu_fec_mod')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
