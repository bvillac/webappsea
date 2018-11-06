<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_ruc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_est_log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_fec_cre')->textInput() ?>

    <?= $form->field($model, 'emp_fec_mod')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
