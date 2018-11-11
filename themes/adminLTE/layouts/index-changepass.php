<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('register', 'User Register');
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
        'id' => 'changepass-form',
    ]); ?>
        <?= $form->field($model, 'password', [
            'inputOptions' => ['placeholder' => Html::encode(Yii::t('login', 'Password'))],
            'template' => "<div class=\"form-group has-feedback\">{input}\n<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{error}</div>"
            ,])->passwordInput() ?>
        <?= $form->field($model, 'password_repeat', [
            'inputOptions' => ['placeholder' => Html::encode(Yii::t('login', 'Confirm Password'))],
            'template' => "<div class=\"form-group has-feedback\">{input}\n<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{error}</div>"
            ,])->passwordInput() ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'options' => ['placeholder' => Yii::t('register','Write a text'), 'class' => 'form-control'],
            'imageOptions' => ['data' => ['toggle' => 'tooltip', 'placement' => 'top', 'trigger' => 'hover'], 'title' => Yii::t('register', 'Clic over imagen to update')],
            'template' => '<div class="row"><div class="col-xs-5">{image}</div><div class="col-xs-7">{input}</div></div>',
            ]) ?>
   <div class="row">
       <div class="col-xs-4">
           <a href="<?= Yii::$app->urlManager->createUrl(["site/login"])?>" class="btn btn-primary btn-block btn-flat" style="margin-top: 4px;"><?= Html::encode(Yii::t('register', 'Back'))."&nbsp;<i class='fa fa-arrow-circle-left'></i>" ?></a>
       </div><!-- /.col -->
       <div class="col-xs-4"></div>
       <div class="col-xs-4">
           <?= Html::submitButton(Html::encode(Yii::t('register', 'Send'))."&nbsp;<i class='fa fa-arrow-circle-right'></i>", ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button', 'style' => 'margin-top: 4px;']) ?>
       </div><!-- /.col -->
   </div>
    <?php ActiveForm::end(); ?>
</div>
