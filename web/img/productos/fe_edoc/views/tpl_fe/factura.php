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
    .bold{
        font-weight: bold;
    }
</style>
<div class="panelUserInfo">
    <div class="bordeDivDet">
        <div class="div_modInfoDet modCab">
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Business Name / Names and Lastnames") ?>:</div>
                <div class="tcolr_cen"><?php echo $cabFact['RazonSocialComprador'] ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Date Issue") ?>:</div>
                <div class="tcolr_cen"><?php echo date("Y-m-d", strtotime($cabFact['FechaEmision'])); ?></div>
            </div>
        </div>
        <div class="div_modInfoDet1 modCab">
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "DNI") ?>:</div>
                <div class="tcolr_cen">
                    <?php echo $cabFact['IdentificacionComprador']; ?>
                </div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Referral Guide") ?>:</div>
                <div class="tcolr_cen"><?php echo "" ?></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <br/>
    <div class="div_modInfoVal">
        <div>
            <table>    
                <tr>
                    <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Code Principal.'); ?></td>
                    <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Amount.'); ?></td>
                    <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Description'); ?></td>
                    <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Unit Price'); ?></td>
                    <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Descount'); ?></td>
                    <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Total Price'); ?></td>
                </tr>
                <?php
                for ($i = 0; $i < sizeof($detFact); $i++)  {
                    $codPrincipal = isset($detFact[$i]['CodigoPrincipal']) ? trim($detFact[$i]['CodigoPrincipal']) : "";
                    $cantidad = isset($detFact[$i]['Cantidad']) ? trim(intval($detFact[$i]['Cantidad'])) : "";
                    $descripcion = isset($detFact[$i]['Descripcion']) ? trim($detFact[$i]['Descripcion']) : "";
                    $precioUnitario = isset($detFact[$i]['PrecioUnitario']) ? trim($detFact[$i]['PrecioUnitario']) : "";
                    $descuento = isset($detFact[$i]['Descuento']) ? trim(Yii::$app->formatter->format($detFact[$i]['Descuento'], ["decimal", 2])) : "";
                    $precioTotal = isset($detFact[$i]['PrecioTotalSinImpuesto']) ? trim(Yii::$app->formatter->format($detFact[$i]['PrecioTotalSinImpuesto'], ["decimal", 2])) : "";
                    
                    echo "<tr>";
                    echo "<td style='text-align: center;'>" . $codPrincipal . "</td>";
                    echo "<td style='text-align: right;'>" . $cantidad . "</td>";
                    echo "<td style='text-align: left;'>" . $descripcion . "</td>";
                    echo "<td style='text-align: right;'>" . $precioUnitario . "</td>";
                    echo "<td style='text-align: right;'>" . $descuento . "</td>";
                    echo "<td style='text-align: right;'>" . $precioTotal . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div class="clear"></div>
    <div class="divDetalles">
        <div class="divDetalleAd ">
            <div class="bordeDivDet modCab div_modInfoAd <?php if (!isset($adiFact)) { ?>divDetaVacio<?php } ?>">
                <div>
                    <div class="tcoll bold" style="width: 90%; alignment-adjust: center"><?php echo app\modules\fe_edoc\Module::t("fe", "Additional Information") ?></div>
                </div><br />
                <?php
                if (isset($adiFact)) {
                    for ($i = 0; $i < sizeof($adiFact); $i++) {
                        if ($adiFact[$i]['Descripcion'] <> ''){
                ?>
                            <div>
                                <div class="tcoll_ad bold"><?php echo $adiFact[$i]['Nombre'] ?>:</div>
                                <div class="tcolr_ad"><?php echo $adiFact[$i]['Descripcion'] ?></div>
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
            <div class="modCab div_modInfoAd">
                <div>
                    <table>    
                        <tr>
                            <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Type Payment'); ?></td>
                            <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Total'); ?></td>
                            <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Term'); ?></td>
                            <td class="thcol bold"><?php echo app\modules\fe_edoc\Module::t("fe", 'Time'); ?></td>
                        </tr>
                        <?php
                        for ($i = 0; $i < sizeof($pagFact); $i++) {
                            if($pagFact[$i]['FormaPago']<>''){
                            ?>
                            <tr>
                                <td style='text-align: left;'><?php echo $pagFact[$i]['FormaPago'] ?></td>
                                <td style='text-align: center;'><?php echo Yii::$app->formatter->format($pagFact[$i]['Total'], ["decimal", 2]) ?></td>
                                <td style='text-align: center;'><?php echo $pagFact[$i]['Plazo'] ?></td>
                                <td style='text-align: center;'><?php echo $pagFact[$i]['UnidadTiempo'] ?></td>
                            </tr>
                        <?php } }?>
                    </table>
                </div>
            </div>
        </div>
        <?php
        $IRBPNR = "0.00";
        $ICE = "0.00";
        $BASEIVA0 = "0.00";
        $NOOBJIVA = "0.00";
        $EXENTOIVA = "0.00";

        for ($i = 0; $i < sizeof($impFact); $i++) {
            if ($impFact[$i]['Codigo'] == '2') {//Valores de IVA
                switch ($impFact[$i]['CodigoPorcentaje']) {
                    case 0:
                        $BASEIVA0 = $impFact[$i]['BaseImponible'];
                        break;
                    case 2:
                        $BASEIVA12 = $impFact[$i]['BaseImponible'];
                        $VALORIVA12 = $impFact[$i]['Valor'];
                        break;
                    case 3:
                        $BASEIVA12 = $impFact[$i]['BaseImponible'];
                        $VALORIVA12 = $impFact[$i]['Valor'];
                //VSValidador::putMessageLogFile($VALORIVA12);
                        break;
                    case 6://No objeto Iva
                        $NOOBJIVA = $impFact[$i]['BaseImponible'];
                        break;
                    case 7://Excento de Iva
                        $EXENTOIVA = $impFact[$i]['BaseImponible'];
                        break;
                    default:
                }
            }
        }
        ?>
        <div class="divDetalleTot">
            <table>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'SUBTOTAL 12%'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($BASEIVA12, ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'SUBTOTAL 0%'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($BASEIVA0, ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'SUBTOTAL not liable to IVA'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($NOOBJIVA, ["decimal", 2]) ?></td>
                </tr>
                <!--<tr>
                    <td><?php //echo app\modules\fe_edoc\Module::t("fe", 'SUBTOTAL TAX FREE'); ?></td>
                    <td align="right"><?php //echo Yii::$app->formatter->format($EXENTOIVA, ["decimal", 2]) ?></td>
                </tr>-->
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'SUBTOTAL exempt IVA'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($EXENTOIVA, ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'DESCUENTO'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($cabFact['TotalDescuento'], ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'ICE'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($ICE, ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'IVA  12%'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($VALORIVA12, ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'IRBPNR'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($IRBPNR, ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'TIP'); ?></td>
                    <td align="right"><?php echo Yii::$app->formatter->format($cabFact['Propina'], ["decimal", 2]) ?></td>
                </tr>
                <tr>
                    <td><?php echo app\modules\fe_edoc\Module::t("fe", 'TOTAL VALUE'); ?></td>
                    <td style="text-align: right"><?php echo Yii::$app->formatter->format($cabFact['ImporteTotal'], ["decimal", 2]) ?></td>
                </tr>
            </table>
        </div>    
    </div>
</div>