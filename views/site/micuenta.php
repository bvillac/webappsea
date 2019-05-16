<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use kartik\date\DatePicker;
use yii\helpers\Html;
//echo $Data;
?>

<div class="col-sm-3 padding-right">
    <?= $this->render('_micuenta-menu.php') ?>  			
</div>

<div class="col-sm-9 padding-right">
    <div class="panel panel-default">
        <div class="panel-heading">Mis Datos</div>
        <div class="panel-body">
            <p>A continuación se muestran tus datos personales. Si quieres modificarlos, cambia los campos que quieras y presiona el botón "Guardar cambios".</p>
            <form class="form-horizontal">

<!--                <div class="form-group">
                    <label for="txt_usu_password" class="col-sm-3 control-label">Contraseña</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="txt_usu_password" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_usu_password2" class="col-sm-3 control-label">Confirmar Contraseña</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="txt_usu_password2" >
                    </div>
                </div>-->
                <div class="form-group">
                    <label for="txt_per_correo" class="col-sm-3 control-label">Correo Electrónico</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txt_per_correo" value="<?= $Data[0]["Correo"]?>" disabled="true" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_per_nombre" class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txt_per_nombre" value="<?= $Data[0]["Nombre"]?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_per_apellido" class="col-sm-3 control-label">Apellido</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txt_per_apellido" value="<?= $Data[0]["Apellido"]?>" >
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="txt_dper_telefono" class="col-sm-3 control-label">Teléfono</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txt_dper_telefono" value="<?= $Data[0]["Telefono"]?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_dper_direccion" class="col-sm-3 control-label">Dirección</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txt_dper_direccion" value="<?= $Data[0]["Direccion"]?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_fec_naci" class="col-sm-3 control-label">Fecha Nacimiento</label>
                    <div class="col-sm-9">
                        <?=
                        DatePicker::widget([
                            'id' => 'txt_fec_naci',
                            'name' => 'txt_fec_naci',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            //'value' => '23-Feb-1982',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => Yii::$app->params["datePickerDefault"]
                            ],
                            'options' => [
                                'class' => 'form-control',
                                //'Onchange' => 'actualizarGrid()',
                                //'readonly' => 'readonly',
                                'placeholder' => Yii::t("perfil", "Fecha Nacimiento")//'Enter birth date ...'
                            ]
                        ]);
                        ?>
                    </div>
                </div>


            </form>
            <div class="form-group">
                <div class="col-sm-3" ></div>
                <div class="col-sm-9" >
                    <?= Html::a('Guardar Cambios', ['site/confirmarpedido'], ['class' => 'btn btn-primary']); ?>
                </div>

            </div>
            

        </div>
    </div>

</div>


