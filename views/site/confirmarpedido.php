<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<div class="col-sm-9 padding-right">
    <?= $this->render('_confirmar-datos.php', ['directoryAsset' => $directoryAsset,'model' => $model]) ?>  			
</div>
<div class="col-sm-3">

            <div class="col-md-12 col-sm-6 col-xs-8 box-int-third-info" style="margin: auto">
                <div>
                    <i class="info-detail-icon col-xs-3 col-md-3" style="background: url(/Content/siglo/pay.png) no-repeat;">
                    </i>
                    <div class="info-detail-rigth">
                        <strong>Formas de pago</strong>
                        <ul>
                            <li>Crédito directo</li>
                            <li>Pago en oficina</li>
                        </ul>
                    </div>
                </div>

                <div>
                    <i class="info-detail-icon col-xs-3 col-md-3" style="background: url(/Content/siglo/shippingtime.png) no-repeat;"></i>
                    <div class="info-detail-rigth">
                        <strong>¿Cuándo llega mi compra?</strong>
                        <ul>
                            <li>24 horas ciudades principales</li>
                            <li>48 horas demás provincias</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <i class="info-detail-icon col-xs-3 col-md-3" style="background: url(/Content/siglo/delivery.png) no-repeat;"></i>
                    <div class="info-detail-rigth">
                        <strong>Opciones de entrega</strong>
                        <ul>
                            <li>Retiro en local</li>
                            <li>Entrega a domicilio</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <i class="info-detail-icon col-xs-3 col-md-3" style="background: url(/Content/siglo/help.png) no-repeat;"></i>
                    <div class="info-detail-rigth">
                        <strong>Ayuda</strong>
                        <ul>
                            <li>Comunícate con ventas@utimpor.com o llama al PBX 3-810300  </li>
                        </ul>
                    </div>
                </div>

            </div>
</div>

