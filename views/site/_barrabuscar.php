<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\jui\AutoComplete;
use yii\web\JsExpression;
?>
<div class="row">
    <div class="col-sm-8"></div>        
    <div class="col-sm-4">
        <!--                <div class="search_box pull-right">-->

        <?=
        AutoComplete::widget([
            'name' => 'txt_buscarData',
            'id' => 'txt_buscarData',
            'clientOptions' => [
                'autoFill' => true,
                'minLength' => '3',
                'source' => new JsExpression("function( request, response ) {
                                            autocompletarBuscarProducto(request, response,'txt_buscarData','COD-NOM');
                                            }"),
                'select' => new JsExpression("function( event, ui ) {
                                                    //alert(ui.item.id);
                                                    verProducto(ui.item.id,0);
                                                    //actualizaBuscarPersona(ui.item.PER_ID); 
                                                    //$('#txth_ids').val(ui.item.nombre);
                                                    //actualizarGrid();
                                             }")
            ],
            'options' => [
                'class' => 'form-control',
                'onkeydown' => 'buscarEnterProducto(isEnter(event),this)',
                //'Onkeyup' => 'clearGrid()',
                'placeholder' => Yii::t("formulario", "Buscar productos")
            ],
        ]);
        ?>
    </div>

</div>
