<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
//echo json_encode($Data);
?>

<div class="alert alert-success" role="alert">
    Gracias por Confiar en nosotros
</div>

<form>
    <div class="form-group row">
        <label for="txt_per_nombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_nombre" value="<?= $Data[0]["Nombre"]?>" disabled="true" >
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_per_apellido" class="col-sm-2 col-form-label">Apellido</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_apellido" value="<?= $Data[0]["Apellido"]?>" disabled="true" >
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_per_correo" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_per_correo" value="<?= $Data[0]["Correo"]?>" disabled="true" >
        </div>
    </div>
    <div class="form-group row">
        <label for="txt_dper_telefono" class="col-sm-2 col-form-label">Teléfono movil</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_dper_telefono" value="<?= $Data[0]["Telefono"]?>" >
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            Sólo te lo pedimos por si hay algún problema con la entrega
        </div>

    </div>
    <div class="form-group row">
        <label for="txt_dper_direccion" class="col-sm-2 col-form-label">Dirección de Envio</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_dper_direccion" value="<?= $Data[0]["Direccion"]?>">
        </div>
    </div>



</form>



<div class="alert alert-success" role="alert">
    Método de Pedido 
</div>
<form>
    <div class="scp_user_data scp_paytype">       
        
        <div >
            <h2>Total a pedir: $ <span id="lbl_total">0.00</span></h2>
        </div>
        
        <div class="scp_submit_pay">
<!--            <button type="button" class="btn btn-primary btn-lg">Botón grande</button>-->
            <?php //Html::a('Pedir y Finalizar', ['site/confirmarpedido'],['class' => 'btn btn-primary check_out']); ?>
            <?= Html::a('Pedir y Finalizar', Url::to('#'),['class' => 'btn btn-primary check_out','onclick'=>'javascript:hacerPedidos("Update");']); ?>
        </div>
        
        <div><br>Al pulsar el botón "Pedir y Finalizar" confirmo que he leído y acepto las <a href="https://www.utimpor.com/condiciones-de-uso.php" target="_blank" title="Leer condiciones generales de venta">condiciones generales de venta</a> y la <a href="https://www.utimpor.com/politica-de-privacidad.php" title="Leer política de privacidad" target="_blank">política de privacidad</a></div>
    </div>
</form>
<br>
<div class="alert alert-success" role="alert">
    Por motivos de seguridad guardaremos su IP actual, SU IP (<?= yii::$app->request->userIP?>) ha sido guardada en nuestra base de datos. 
</div>
<br>
