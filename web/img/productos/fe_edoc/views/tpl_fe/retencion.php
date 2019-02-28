<style>
    .modCab{
        color: #000000;        
        line-height: 16px;
    }
    .panelUserInfo{
        /*margin: 10px 0px 18px;*/
        margin: 5px 0px 0px;
    }    
    .tcoll_cen {
        width: 50%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_cen {
        width: 50%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcoll_cen2 {
        width: 40%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_cen2 {
        width: 60%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcoll_ad {
        width: 30%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_ad {
        width: 70%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .divDetalles{
        float: left;
        width: 100%;
        position: absolute;      
        left: 0;
        margin-top: 10px;
    }
    .divDetalleAd{
        float: left;
        width: 65%;
        position: absolute;      
        left: 0;
    }
    .divDetalleTot{  
        width: 35%;
        position: absolute;      
        right: 0;
    }
    .div_modInfoAd{
        float: left;
        width: 70%;
    }
    .div_modInfoVal{
        float: left;
        width: 100%;       
    }
    .div_modInfoDet{
        float: left;
        width: 60%;
    }
    .div_modInfoDet2{
        float: left;
        width: 75%;
    }
    .div_modInfoDet1{
        float: left;
        width: 40%;
    }    
    .bordeDivDet{ 
        border: 1px solid #000000;       
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        padding: 10px;
    }    
    .valorAlign{ 
        text-align: right !important;
    }
    .divDetaVacio{
        height: 100px;
    }
</style>
<div class="panelUserInfo">
    <div class="bordeDivDet">
        <div class="div_modInfoDet modCab">
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Business Name / Names and Lastnames") ?>:</div>
                <div class="tcolr_cen"><?php echo $cabDoc['RazonSocialSujetoRetenido'] ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Date Issue") ?>:</div>
                <div class="tcolr_cen"><?php echo date("Y-m-d", strtotime($cabDoc['FechaEmision'])); ?></div>
            </div>
        </div>
        <div class="div_modInfoDet1 modCab">
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "DNI") ?>:</div>
                <div class="tcolr_cen">
                    <?php echo $cabDoc['IdentificacionSujetoRetenido']; ?>
                </div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo "" ?></div>
                <div class="tcolr_cen"><?php echo "" ?></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <br />
    <div class="div_modInfoVal">
        <table>    
            <tr>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Voucher'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Number'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Date Issue'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Fiscal Year'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'The Withholding Tax Base'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'TAX'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Percentage Retention'); ?></td>
                <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Retained Value'); ?></td>
            </tr>
            <?php
            for ($i = 0; $i < sizeof($detDoc); $i++) {
                echo "<tr>";
                echo "<td style='text-align: center;'>" . (($detDoc[$i]['CodDocRetener'] == '01') ? \app\modules\fe_edoc\Module::t("fe", 'INVOICE') : '') . "</td>";
                echo "<td style='text-align: center;'>" . $detDoc[$i]['NumDocRetener'] . "</td>";
                echo "<td style='text-align: center;'>" . date(Yii::$app->params["dateByDefault"], strtotime($detDoc[$i]['FechaEmisionDocRetener'])) . "</td>";
                echo "<td style='text-align: center;'>" . $cabDoc['PeriodoFiscal'] . "</td>";
                echo "<td style='text-align: right;'>" . Yii::$app->formatter->format($detDoc[$i]['BaseImponible'], ["decimal", 2]) . "</td>";
                echo "<td style='text-align: center;'>" . (($detDoc[$i]['Codigo'] == '1') ? 'RENTA' : (($detDoc[$i]['Codigo'] == '2') ? 'IVA' : 'ISD')) . "</td>";
                echo "<td style='text-align: right;'>" . Yii::$app->formatter->format($detDoc[$i]['PorcentajeRetener'], ["decimal", 2]) . "</td>";
                echo "<td style='text-align: right;'>" . Yii::$app->formatter->format($detDoc[$i]['ValorRetenido'], ["decimal", 2]) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="divDetalles">
        <div class="divDetalleAd ">
            <div class="bordeDivDet modCab div_modInfoAd <?php if (!isset($adiDoc)) { ?>divDetaVacio<?php  } ?>">
                <div>
                    <div class="tcoll bold" style="width: 90%; alignment-adjust: center"><?php echo app\modules\fe_edoc\Module::t("fe", "Additional Information") ?></div>
                </div><br />
                <?php
                if (isset($adiDoc)) {
                    for ($i = 0; $i < sizeof($adiDoc); $i++) {
                        if ($adiDoc[$i]['Descripcion'] <> '') {
                            ?>
                            <div>
                                <div class="tcoll_ad bold"><?php echo $adiDoc[$i]['Nombre'] ?>:</div>
                                <div class="tcolr_ad"><?php echo $adiDoc[$i]['Descripcion'] ?></div>
                            </div> 
                <?php
                        }
                    }
                }
                ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <br />
        </div>
    </div>
</div>