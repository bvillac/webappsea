<?php
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Rol;
?>
<div class="col-lg-4 form-group">
    <?=
    AutoComplete::widget([
        'name' => 'txt_PER_CEDULA',
        'id' => 'txt_PER_CEDULA',
        'options' => array(
            'placeholder' => Yii::t('fe_edoc', 'Social reason o Ruc'),
            'class' => 'ui-autocomplete-input form-control',
        ),
        'clientOptions' => [
            'source' => new JsExpression(
                "function(request, response){ 
                  autocompletarBuscarPersona(request, response,'txt_PER_CEDULA','COD-NOM');
                }"
            ),
            'minLength' => '2',
            //'autoFill' => true,
            'select' => new JsExpression("function( event, ui ) {
                    //actualizaBuscarPersona(ui.item.PER_ID); 
			        //$('#memberssearch-family_name_id').val(ui.item.id);//#memberssearch-family_name_id is the id of hiddenInput.
			     }")
        ],
    ]);
    ?>
</div>
<div class="col-lg-2 form-group">
    <?php
    echo Html::dropDownList(
        'cmb_tipoApr',
        '0',
        array('0' => Yii::t('fe_edoc', 'All')) + $tipoApr,
        array('class' => 'form-control', 'id' => 'cmb_tipoApr')
    );
    ?>
</div>
<div class="col-lg-2 form-group">
    <?=
    DatePicker::widget([
        'name' => 'dtp_fec_ini',
        'value' => '',
        'type' => DatePicker::TYPE_INPUT,
        'options' => ["class" => "form-control", "id" => "dtp_fec_ini", "placeholder" => Yii::t("formulario", "Start date")],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => Yii::$app->params["dateByDatePicker"],
        ]
    ]);
    ?>
</div>
<div class="col-lg-2 form-group">
    <?=
    DatePicker::widget([
        'name' => 'dtp_fec_fin',
        'value' => '',
        'type' => DatePicker::TYPE_INPUT,
        'options' => ["class" => "form-control", "id" => "dtp_fec_fin", "placeholder" => Yii::t("formulario", "End date")],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => Yii::$app->params["dateByDatePicker"],
        ]
    ]);
    ?>
</div>
<div class="col-lg-2 form-group">
    <?php echo Html::button(Yii::t('fe_edoc', 'Search'), array('id' => 'btn_buscar', 'name' => 'btn_buscar', 'class' => 'btn btn-success', 'onclick' => 'buscarDataIndex("","")')); ?>
</div>
<div class="col-lg-12 form-group">
    <?php //echo Html::button(Yii::t('CONTROL_ACCIONES', 'Authorizing document'), array('id' => 'btn_enviar', 'name' => 'btn_enviar', 'class' => 'btn btn-success', 'onclick' => 'fun_EnviarDocumento()')); ?>
    <?php
    //Yii::$app->session->get('user_name', FALSE); CONTROLA POR USUARIO
    $model_rol = new Rol();
    $rol = $model_rol->getMainRol(Yii::$app->session->get('PB_username', false));
    if ($rol['id'] == 1 || $rol['id'] == 2 || $rol['id'] == 3) { //CONTROLA POR ROL ADMIN
        echo Html::button(Yii::t('fe_edoc', 'To correct'), array('id' => 'btn_corregir', 'name' => 'btn_corregir', 'class' => 'btn btn-danger', 'onclick' => 'fun_EnviarCorreccion()'));
        echo Html::button(Yii::t('fe_edoc', 'Cancel'), array('id' => 'btn_cancel', 'name' => 'btn_cancel', 'class' => 'btn btn-danger', 'onclick' => 'fun_EnviarAnular()'));
    }
    ?>
    <?php echo Html::a(Yii::t('fe_edoc', 'Edit mail'), array('nubenotacredito/updatemail'), array('id' => 'btn_Update', 'name' => 'btn_Update', 'title' => Yii::t('CONTROL_ACCIONES', 'Edit mail'), 'class' => 'btn btn-primary', 'onclick' => 'fun_UpdateMail()')); ?>
    <?php echo Html::button(Yii::t('fe_edoc', 'Forward mail'), array('id' => 'btn_reenviar', 'name' => 'btn_reenviar', 'class' => 'btn btn-primary', 'onclick' => 'fun_EnviarCorreo()')); ?> 
</div>