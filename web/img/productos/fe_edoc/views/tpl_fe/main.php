 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <style>
                    html, body, div, span, applet, object, iframe,
                    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
                    a, abbr, acronym, address, big, cite, code,
                    del, dfn, em, img, ins, kbd, q, s, samp,
                    small, strike, strong, sub, sup, tt, var,
                    b, u, i, center,
                    dl, dt, dd, ol, ul, li,
                    fieldset, form, label, legend,
                    table, caption, tbody, tfoot, thead, tr, th, td,
                    article, aside, canvas, details, embed, 
                    figure, figcaption, footer, header, hgroup, 
                    menu, nav, output, ruby, section, summary,
                    time, mark, audio, video {
                        margin: 0;
                        padding: 0;
                        border: 0;
                        font-size: 100%;
                        font: inherit;
                        vertical-align: baseline;
                    }
                    article, aside, details, figcaption, figure, 
                    footer, header, hgroup, menu, nav, section {
                        display: block;
                    }
                    body {
                        line-height: 1;
                    }
                    ol, ul {
                        list-style: none;
                    }
                    blockquote, q {
                        quotes: none;
                    }
                    blockquote:before, blockquote:after,
                    q:before, q:after {
                        content: '';
                        content: none;
                    }
                    table {
                        border-collapse: collapse;
                        border-spacing: 0;
                    }
                    /* Css para las tablas */
                    table{
                        border-collapse: collapse;
                        width: 100%;
                        height:auto;
                        margin:0px;padding:0px;
                        border:1px solid #000000;
                    }
                    table tr:nth-child(odd){
                        border:1px solid #000000;
                    }
                    table tr:nth-child(even){
                        border:1px solid #000000;
                    }
                    table td{
                        border:1px solid #000000;
                        vertical-align:middle;
                        text-align:left;
                        padding:3px;
                        font-size:10px;
                        font-family:Arial;
                        font-weight:normal;
                        color:#000000;
                    }
                    table tr:last-child td{
                        border-width:1px;
                    }
                    table tr td:last-child{
                        border-width:1px;
                    }
                    table tr:last-child td:last-child{
                        border-width:1px;
                    }
                    table tr:first-child td, .thcol{
                        background-color:#FFFFFF;
                        border:1px solid #000000;
                        text-align:left;
                        font-size:11px;
                        font-family:Arial;
                        font-weight:bold;
                        color:#000000;
                        height: 20px;
                        text-transform: uppercase;
                    }
                    table tr:first-child td:first-child{
                        border-width:1px;
                    }
                    /* ---Css para las tablas--- */
                    #main{
                        font-family: Arial, sans-serif;
                        margin:30px auto auto 30px;
                        padding:0;   
                        
                    }
                    #container{
                        height:100%;
                        position:relative;
                    }
                    .bold{
                        font-weight: bold;
                    }
                    .clear{
                        clear: both;
                    }
                    .tcoll_address {
                        width: 30%;                       
                        color: #000000;
                        float: left;
                        font-size: 11px;
                        text-align: left;
                    }
                    .tcolr_address {
                        width: 68%;
                        color: #000000;
                        float: left;
                        font-size: 11px;                        
                        text-align: left;
                    }
                    .tcoll, .tcolrc {
                        width: 58%;                       
                        color: #000000;
                        float: left;
                        font-size: 11px;
                        text-align: left;
                    }
                    .tcolr {
                        width: 40%;
                        color: #000000;
                        float: left;
                        font-size: 11px;                        
                        text-align: left;
                    }
                    .div_modInfo{
                        float: left;
                        width: 50%;
                    }
                    .div_modInfo1{
                        float: left;
                        width: 50%;
                    }
                    #nameLbl{
                        text-transform: uppercase;
                    }
                    .bordeDiv{ 
                        border: 1px solid #000000;
                        border-radius: 7px; 
                        -moz-border-radius: 7px;
                        -webkit-border-radius: 7px;
                        padding: 10px;                       
                    }
                    .heightDivDeta{ 
                        height: 280px !important;
                        margin-left: 5px;
                    }
                    .heightDivDeta2{
                        height: 140px !important;
                        margin-right: 5px;
                    }
                    .tituloLabel{                    
                        font-size: 16px;
                    }
                    #codigo_barra{                       
                        margin-top: 5px;
                    }
                    .logo_cab{
                        margin: 30px 0px 30px 0px;
                        width: 260px;
                    }
                    .tcolr_num_aut {
                        width: 100%;                      
                        color: #000000;
                        float: left;
                        font-size: 10.5px;                   
                        text-align: left;
                    }                   
                </style>
        </head>
        <body>
            <div id="main">
                <div id="container">
                    <div>
                        <div class="div_modInfo">                            
                            <div class="heightDivDeta2">
                                <div> 
                                    <?php echo yii\helpers\Html::img(Yii::$app->basePath . "/themes/" . Yii::$app->view->theme->themeName . "/assets/img/logos/logo_" . Yii::$app->session->get('PB_idempresa') . ".png", array("class" => "logo_cab", "alt" => Yii::$app->params["copyright"])); ?>
                                </div>
                            </div>
                            <div class="bordeDiv heightDivDeta2">
                                <div>
                                    <div class="tituloLabel">
                                        <div id="nameLbl" class="bold"><?php echo Yii::$app->controller->pdf_nom_empresa; ?></div>   
                                    </div>
                                    <br/>
                                    <div>
                                        <div class="tcoll_address bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Address Matriz") ?>:</div>
                                        <div class="tcolr_address"><?php echo Yii::$app->controller->pdf_dir_matriz; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcoll_address bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Address Branch") ?>:</div>
                                        <div class="tcolr_address"><?php echo Yii::$app->controller->pdf_dir_sucursal; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <?php if(Yii::$app->controller->pdf_num_contribuyente != ""): ?>
                                    <div>
                                        <div class="tcoll bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Taxpayer Special Issue") ?>:</div>
                                        <div class="tcolr"><?php echo Yii::$app->controller->pdf_num_contribuyente; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <?php endif; ?>
                                    <div>
                                        <div class="tcoll bold" style="width: 75%;"><?php echo app\modules\fe_edoc\Module::t("fe", "BOUND TO TAKE ACCOUNTING") ?>:</div>
                                        <div class="tcolr" style="width: 20%;"><?php echo Yii::$app->controller->pdf_contabilidad; ?></div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="div_modInfo1">
                            <div class="bordeDiv heightDivDeta">
                                <div>
                                    <div>
                                        <div class="tcoll bold"><?php echo app\modules\fe_edoc\Module::t("fe", "R.U.C") ?>:</div>
                                        <div class="tcolr"><?php echo Yii::$app->controller->pdf_ruc; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>                               
                                    <div class="tituloLabel">
                                        <div id="nameLbl" class="bold"><?php echo Yii::$app->controller->pdf_tipo_documento; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcolrc bold"><?php echo app\modules\fe_edoc\Module::t("fe", "No.") ?>:</div>
                                        <div class="tcolr"><?php echo Yii::$app->controller->pdf_numero; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>                                    
                                    <div>
                                        <div class="tcolrc bold"><?php echo app\modules\fe_edoc\Module::t("fe", "AUTHORIZATION NUMBER") ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcolr_num_aut"><?php echo Yii::$app->controller->pdf_numeroaut; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcolrc bold"><?php echo app\modules\fe_edoc\Module::t("fe", "DATE AND TIME AUTHORIZATION") ?></div>
                                        <div class="tcolr"><?php echo Yii::$app->controller->pdf_fec_autorizacion; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcolrc bold"><?php echo app\modules\fe_edoc\Module::t("fe", "ENVIRONMENT") ?>:</div>
                                        <div class="tcolr"><?php echo Yii::$app->controller->pdf_ambiente; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcolrc bold"><?php echo app\modules\fe_edoc\Module::t("fe", "ISSUE") ?>:</div>
                                        <div class="tcolr"><?php echo Yii::$app->controller->pdf_emision; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                    <div>
                                        <div class="tcolrc bold"><?php echo app\modules\fe_edoc\Module::t("fe", "PASSWORD") ?></div>                                  
                                    </div>
                                    <div class="clear"></div>
                                    <div>                                    
                                        <!--<div class="posright" id="codigo_barra"><img src="<?php echo Yii::$app->controller->pdf_cod_barra; ?>" alt="<?php echo Yii::$app->controller->pdf_cla_acceso; ?>" /></div>-->
                                        <div class="posright" id="codigo_barra">
                                            <?= \barcode\barcode\GeneratedCodebar::widget([
                                                "message" => Yii::$app->controller->pdf_cla_acceso,
                                                "base64" => true,
                                                "font_size" => 35
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php echo $content; ?>                  
                </div>
            </div>
        </body>
    </html>