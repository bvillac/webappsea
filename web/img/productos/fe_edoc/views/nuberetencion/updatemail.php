<?php 
    echo $this->renderPartial('_include');
    echo CHtml::hiddenField('txth_usu_mail', (isset($model[0]['UsuId']))?$model[0]['UsuId']:0);
?>

<div class="col-lg-5">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo  (isset($model[0]['UsuId']))?Yii::t('GENERAL', 'Modificar Correos'):'No Existen Datos de Usuario'   ?></div>
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label>DNI :</label>
                    <label><?php echo (isset($model[0]['CedRuc']))?$model[0]['CedRuc']:''  ?></label>
                </div>
                <div class="form-group">
                    <label>Nombres :</label>
                    <label><?php echo (isset($model[0]['Nombres']))?$model[0]['Nombres']:''  ?></label>
                </div>
                <div class="form-group">
                    <label>Correos Ej: correo1@mail.com;correo2@mail.com</label>
                    <?php
                    echo CHtml::textField('txt_correo', (isset($model[0]['Correo']))?$model[0]['Correo']:'', array('size' => 20, 'maxlength' => 100,
                        'class' => 'form-control',
                            //'onchange' => 'return calcularItem()',
                            //'onkeydown' => "nextControl(isEnter(event),'txt_RUC')",
                    ))
                    ?>
                </div>
                <div class="form-group rowLine">
                    <div class="rowTd">
                        <?php echo CHtml::button(Yii::t('CONTROL_ACCIONES', 'Save'), array('id' => 'btn_save', 'name' => 'btn_save', 'class' => 'btn btn-primary btn-sm', 'onclick' => 'fun_CambiaMail()')); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
