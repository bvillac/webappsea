<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::t('login', 'Log In Session');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-6">
    
</div>
<div class="login-box-body col-md-6">
    <div class="login-logo">
        <a href="<?= Html::encode(Yii::$app->params['web']) ?>"><img src="<?= Html::encode($directoryAsset . "/img/logos/logov_".Yii::$app->language.".png") ?>" alt="logo" /></a>
    </div><!-- /.login-logo -->
    <?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-error">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
    <?php endif;  ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <?php endif;  ?>
    <p class="login-box-msg" style="font-size: 20px; display: none;"><?= Html::encode(Yii::t('login', 'Log In Session')) ?></p>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
        <?= $form->field($model, 'username', [
            'inputOptions' => ['placeholder' => Html::encode(Yii::t('login', 'Email'))],
            'template' => "<div class=\"form-group has-feedback\">{input}\n<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>\n{error}</div>"
            ,]) ?>
        <?= $form->field($model, 'password', [
            'inputOptions' => ['placeholder' => Html::encode(Yii::t('login', 'Password'))],
            'template' => "<div class=\"form-group has-feedback\">{input}\n<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{error}</div>"
            ,])->passwordInput() ?>

   <div class="row">
       <div class="col-xs-8">
            <a href="<?= Yii::$app->urlManager->createUrl(["site/register"])?>" class="text-center"><?= Html::encode(Yii::t('login', 'Create Account')) ?></a><br/>
            <a href="<?= Yii::$app->urlManager->createUrl(["site/forgotpass"])?>"><?= Html::encode(Yii::t('login', 'I forgot my password')) ?></a><br>
       </div><!-- /.col -->
       <div class="col-xs-4">
           <?= Html::submitButton(Html::encode(Yii::t('login', 'Sign In'))."&nbsp;<i class='fa fa-arrow-circle-right'></i>", ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button', 'style' => 'margin-top: 4px;']) ?>
       </div><!-- /.col -->
   </div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    .checkbox {
        margin-top: 0px !important;
    }
    .checkbox label {
        padding-left: 0px !important;
    }
</style>
