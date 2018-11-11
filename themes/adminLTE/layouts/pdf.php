<?php
$session = Yii::$app->session;
$isUser = FALSE;
if ($session->isActive){
    $isUser = $session->get('PB_isuser', FALSE);
}
if (isset($_GET['popup']) || isset($_POST['popup'])) {
    $popup = isset($_GET['popup']) ? $_GET['popup'] : $_POST['popup'];
} else
    $popup = "";
if ($popup == "content" && $isUser) {
    echo $this->render('popup');
} else if ($isUser) {
    ?>
    <?php $this->beginPage() ?>
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
                        width: 100%;/*732px;*/
                        height: auto;
                        margin: 0px;
                        padding: 0px;
                    }
                    table tr:nth-child(odd){ background-color:#dcdce1; }
                    table tr:nth-child(even){ background-color:#ffffff; }
                    table td{
                        vertical-align: middle;
                        text-align: left;
                        padding: 7px;
                        font-size: 10px;
                        font-family: Arial;
                        /*font-weight:normal;*/
                        /*color:#000000;*/
                    }
                    table tr:last-child td{
                        border-width: 0px 1px 0px 0px;
                    }
                    table tr td:last-child{
                        border-width: 0px 0px 1px 0px;
                    }
                    table tr:last-child td:last-child{
                        border-width: 0px 0px 0px 0px;
                    }
                    table tr:first-child td, .thcol{
                        background-color: #9b9b9c;
                        text-align: left;
                        font-size: 12px;
                        font-family: Arial;
                        font-weight: bold;
                        color: #ffffff;
                        height: 20px;
                        text-transform: uppercase;
                    }
                    table tr:first-child td:first-child{
                        border-width:0px 0px 1px 0px;
                    }
                    table tr:first-child td:last-child{
                        border-width:0px 0px 1px 1px;
                    }
                    /* ---Css para las tablas--- */
                    #main{
                        font-family: Arial, sans-serif;
                        margin: 30px auto auto 30px;
                        padding: 0;
                        width: 763px;
                        height: 1122px;
                    }
                    .footer{
                        font-family: Arial, sans-serif;
                    }
                    #container{
                        height: 100%;
                        position: relative;
                    }
                    #logo{
                        height: 85px;
                        float: left;
                        width: 70%;
                    }
                    #title{
                        height: auto;
                        margin: 5px 0;
                    }
                    #title p{
                        color: #999999;
                        font-size: 22px;
                        font-weight: 600;
                    }
                    #infoCuenta{
                        width: 30%;
                        float: left;
                    }
                    #info{
                        margin-bottom: 20px;
                        width: 100%;
                    }
                    #info p{
                        color: #1F1F2D;
                        font-size: 10px;
                        line-height: 17px;
                        text-transform: uppercase;
                    }
                    #info .bold, .bold{
                        font-weight: bold;
                    }
                    .clear{
                        clear: both;
                    }
                    .tcoll, .tcolrc {
                        width: 60%;
                        color: #1F1F2D;
                        float: left;
                        font-size: 10px;
                        line-height: 16px;
                        text-align: left;
                    }
                    .tcolr {
                        width: 40%;
                        color: #1F1F2D;
                        float: left;
                        font-size: 10px;
                        line-height: 16px;
                        text-align: right;
                    }
                    .posright{
                        text-align: right;
                    }			
                </style>
        </head>
        <?php $this->beginBody() ?>
        <body>
            <div id="main">
                <div id="container">
                    <div id="logo">
                        <img src="<?= Yii::$app->basePath; ?>/themes/<?= Yii::$app->view->theme->themeName; ?>/assets/img/logos/logoh_md_<?= Yii::$app->language;?>.png">
                    </div>
                    <div id="infoCuenta">
                        <div id="title">
                            <p><?= $this->title; ?></p>
                        </div>
                        <div id="info">
                            <div class="div-tablew">
                                <div class="troww">
                                    <div class="tcoll"><?= Yii::t("reporte", "Broadcast document") ?>:</div>
                                    <div class="tcolr posright"><?= date(Yii::$app->params['dateByDefault']) ?></div>
                                </div>
                                <?php if (Yii::$app->controller->freportini != "") { ?>
                                    <div class="troww">
                                        <div class="tcoll"><?= Yii::t("reporte", "From") ?>:</div>
                                        <div class="tcolr posright"><?= Yii::$app->controller->freportini; ?></div>
                                    </div>
                                <?php
                                }
                                if (Yii::$app->controller->freportend != "") {
                                    ?>
                                    <div class="troww">
                                        <div class="tcoll"><?= Yii::t("reporte", "To") ?>:</div>
                                        <div class="tcolr posright"><?= Yii::$app->controller->freportend; ?></div>
                                    </div>
                                <?php } ?>
                                <div class="troww">
                                    <div class="tcoll"><?= Yii::t("reporte", "Produced by") ?>:</div>
                                    <div class="tcolr posright"><?= $session->get('PB_nombres'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="clear"></div>
                    <?= $content ?>
                    <div class="clear"></div>
                </div>
            </div>
        </body>
        <?php $this->endBody() ?>
    </html>
    <?php $this->endPage() ?>
    <?php
} else {
    echo $this->render(
        'login',
        ['content' => $content]
    );
}
?>


