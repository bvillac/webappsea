<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>

<div class="alert alert-success" role="alert">
    Si tienes cuenta de usuario <a href="javascript: void(0);" title="Accede" onclick="javascript: _data();"> accede y ¡compra más rápido!</a>
</div>

<form>
    <div class="form-group row">
        <label for="txt_per_nombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_nombre">
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_per_apellido" class="col-sm-2 col-form-label">Apellido</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_apellido">
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_per_correo" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_correo">
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_dper_telefono" class="col-sm-2 col-form-label">Teléfono movil</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_dper_telefono">
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            Sólo te lo pedimos por si hay algún problema con la entrega
        </div>

    </div>
    <div class="form-group row">
        <label for="txt_dper_direccion" class="col-sm-2 col-form-label">Dirección de Envio</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_apellido">
        </div>
    </div>



</form>
<div class="alert alert-success" role="alert">
    Crea tu contraseña para realizar el seguimiento de tus pedidos (Opcional)  
</div>

<form>
    <div class="form-group row">
        <div class="col-sm-10">
            Si no quieres crear ahora tu contraseña, te generamos una aleatoria. La recibirás por email y la podrás modificar cuando quieras 
        </div>
    </div>

    <div class="form-group row">
        <label for="txt_password" class="col-sm-2 col-form-label">Contraseña</label>
        <div class="col-sm-10">
            <input type="password" id="txt_password" class="form-control" />
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_password" class="col-sm-2 col-form-label">Repetir Contraseña</label>
        <div class="col-sm-10">
            <input type="password" id="txt_password" class="form-control" />
        </div>
    </div>
</form>
<div class="alert alert-success" role="alert">
    Método de Pago 
</div>
<form>
    <div class="scp_user_data scp_paytype">       
        
        <div >
            <h2>Total a pagar: $ <span id="lbl_total">0.00</span></h2>
        </div>
        
        <div class="scp_submit_pay">
            <?= Html::a('Pedir y Finalizar', ['site/confirmarpedido'],['class' => 'btn btn-primary check_out']); ?>
        </div>
        <div><br>Al pulsar el botón "Pagar y Finalizar" confirmo que he leído y acepto las <a href="https://www.utimpor.com/condiciones-de-uso.php" target="_blank" title="Leer condiciones generales de venta">condiciones generales de venta</a> y la <a href="https://www.utimpor.com/politica-de-privacidad.php" title="Leer política de privacidad" target="_blank">política de privacidad</a></div>
    </div>
</form>
<br>
<div class="alert alert-success" role="alert">
    Por motivos de seguridad guardaremos su IP actual, SU IP (<?= yii::$app->request->userIP?>) ha sido guardada en nuestra base de datos. 
</div>
<br>
