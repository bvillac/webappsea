<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = Yii::$app->params['title']; //'My Yii Application';
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger">
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="login-form"><!--login form-->  
                        <h2><?= Yii::t("app", "Login to your account") ?></h2>
                        <form action="#">
<!--                            <input type="text" id="txt_name" placeholder="<?= Yii::t("app", "Name") ?>" />-->
                            <input type="email" id="txt_email" placeholder="<?= Yii::t("app", "Email Address") ?>" />
                            <input type="password" id="txt_password" placeholder="<?= Yii::t("login", "Password") ?>"/>
                            <span>
                                <input type="checkbox" class="checkbox"> 
                                <?= Yii::t("login", "Remember Me") ?>
                            </span>
                            <button id="cmd_login" type="submit" class="btn btn-default"><?= Yii::t("login", "Login") ?></button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or"><?= Yii::t("login", "OR") ?></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
<!--                        <h2><?= Yii::t("app", "New User Signup!") ?></h2>-->
                        <h2>Nuevo Usuario? <br>Crear Cuenta</h2>
                        <form action="#">
                            <input type="text" placeholder="<?= Yii::t("app", "Name") ?>"/>
                            <input type="email" placeholder="<?= Yii::t("app", "Email Address") ?>"/>
                            <input type="password" placeholder="<?= Yii::t("login", "Password") ?>"/>
                            <button type="submit" class="btn btn-default"><?= Yii::t("login", "Sign In") ?></button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

    <!--<div class="col-lg-offset-1" style="color:#999;">
            You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
            To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>-->
</div>
