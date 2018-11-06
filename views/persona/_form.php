<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'per_ced_ruc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_genero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'per_estado_civil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_correo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_tipo_sangre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_estado_activo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_est_log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_fec_cre')->textInput() ?>

    <?= $form->field($model, 'per_fec_mod')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
