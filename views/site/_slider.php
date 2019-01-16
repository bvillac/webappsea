<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
?>


<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>Brio</span></h1>
                                <h2>Resmas de Papel</h2>
                                <p> 
                                    <ul>
                                        <li>Papel y empaque 100% biodegradables.</li>
                                        <li>Alta blancura.</li>
                                        <li>Uso en offset, fotocopias, impresiones láser, fax.</li>
                                        <li>Certificado ISO 9001/14001, ECF Libre de Cloro Elemental, PEFC PEFC/2831-01 Programa Certificación Bosques Renovables.</li>
                                        <li>Máximo desempeño para su impresión!!.</li>
                                    </ul>
                                </p>
                                <button type="button" onclick="verProducto(3044)" class="btn btn-default get"><?=Yii::t("store", "Get it now")?></button>
                            </div>
                            <div class="col-sm-6">
                                <img src="<?=Url::base()?>/web/img/portada/slider-1.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-paper</h1>
                                <h2>Resmas de Papel</h2>
                                <p>
                                <ul>
                                    <li>TECNOLOGÍA TRUTONE: Ahorro en Consumo de Tintas y Toner</li>
                                    <li>CALIDAD ISO 9001</li>
                                </ul>
                                
                                </p>
                                <button type="button"  class="btn btn-default get"><?=Yii::t("store", "Get it now")?></button>
                            </div>
                            <div class="col-sm-6">
                                <img src="<?=Url::base()?>/web/img/portada/slider-2.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>C</span>artuchos de inyección </h1>
                                <h2> Para impresora HP y consumibles tinta. </h2>
                                <p>Disfrute las ventajas de la calidad superior de HP a bajo costo. Produzca documentos, informes y fotos en colores intensos, mientras mantiene bajos los costos de impresión, utilizando cartuchos de tinta HP originales.</p>
                                <button type="button" onclick="verProducto(4096)" class="btn btn-default get"><?=Yii::t("store", "Get it now")?></button>
                            </div>
                            <div class="col-sm-6">
                                <img src="<?=Url::base()?>/web/img/portada/slider-3.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
