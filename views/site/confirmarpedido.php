<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<div class="col-sm-9 padding-right">
    <?= $this->render('_confirmar-datos.php', ['directoryAsset' => $directoryAsset, 'model' => $model]) ?>  			
</div>

<div class="col-sm-3 padding-right">
    <div class="col-md-12 col-sm-6 col-xs-8 box-int-third-info" style="margin: auto">
        <h5>Información de tu pedido</h5>
        <div class="scp_right_info_block">
            <strong class="delivery">Información de envío</strong>
            <ul>
                <li><strong>Los pedidos recibidos antes de las 14h se preparan el mismo día</strong></li>

                <li>
                    <strong>Tu pedido será entregado en 1-2 dias</strong>
                </li>

                <li>Los envíos se realizan de lunes a viernes no festivos</li>
            </ul>
        </div>
        <!--    <div class="scp_right_info_block">
                <strong class="returns">Devoluciones</strong>
                <ul>
                    <li>Nuestra Garantía Total  de devoluciones te permite devolver tu pedido sin que tengas que darnos ningún tipo de explicación durante los primeros 14 dias.</li>
                </ul>
            </div>-->
        <div class="scp_right_info_block">
            <strong class="order_state">Estado de tu pedido</strong>
            <ul>
                <li>Entrando en "Mi Cuenta" podrás consultar la información actualizada sobre el estado de tu pedido. Si has solicitado factura, podrás descargarla en esta sección a las 24h de haber realizado tu pedido.</li>
            </ul>
        </div>
        <div class="scp_right_info_block">
            <p class="customers">¿Alguna duda? ¡Llámanos!<br><strong>(593) 3-810300</strong><br>L-V - De 9:00 a 18:00, excepto festivos</p>
        </div>
    </div>

</div>

