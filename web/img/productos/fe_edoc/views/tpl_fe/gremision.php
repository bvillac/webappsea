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
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "DNI (Haulier)") ?>:</div>
                <div class="tcolr_cen"><?php echo $cabDoc['IdentificacionTransportista']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Business Name / Names and Lastnames") ?>:</div>
                <div class="tcolr_cen"><?php echo $cabDoc['RazonSocialTransportista']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Starting Point") ?>:</div>
                <div class="tcolr_cen"><?php echo $cabDoc['DireccionPartida']; ?></div>
            </div>
        </div>
        <div class="div_modInfoDet1 modCab">
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Start Date Transport") ?>:</div>
                <div class="tcolr_cen"><?php echo date("Y-m-d", strtotime($cabDoc['FechaInicioTransporte'])); ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Fin Date Transport") ?>:</div>
                <div class="tcolr_cen"><?php echo date("Y-m-d", strtotime($cabDoc['FechaFinTransporte'])); ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Plaque") ?>:</div>
                <div class="tcolr_cen"><?php echo $cabDoc['Placa']; ?></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <br />
    <div class="bordeDivDet">
        <div class="div_modInfoDet modCab">
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Proof of Purchase") ?>:</div>
                <div class="tcolr_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "INVOICE") . "  " . $destDoc[0]['NumDocSustento']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Authorization Number") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['NumAutDocSustento']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Reason Transfer") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['MotivoTraslado']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Destination (Point of Arrival)") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['DirDestinatario']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "DNI (Recipient)") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['IdentificacionDestinatario']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold" ><?php echo app\modules\fe_edoc\Module::t("fe", "Business Name / Names and Lastnames") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['RazonSocialDestinatario']; ?></div>
            </div>
        </div>
        <div class="div_modInfoDet1 modCab">
            <div> 
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Date of Issue") ?>:</div>
                <div class="tcolr_cen"><?php echo (($destDoc[0]['FechaEmisionDocSustento'] <> '0000-00-00') ? date("Y-m-d", strtotime($destDoc[0]['FechaEmisionDocSustento'])) : ''); ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Customs Document") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['DocAduaneroUnico']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Set Destination Code") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['CodEstabDestino']; ?></div>
            </div>
            <div>
                <div class="tcoll_cen bold"><?php echo app\modules\fe_edoc\Module::t("fe", "Ruta") ?>:</div>
                <div class="tcolr_cen"><?php echo $destDoc[0]['Ruta']; ?></div>
            </div>
        </div>
        <br/>
        <div class="clear"></div>
        <div class="div_modInfoVal">
            <table>    
                <tr>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Amount'); ?></td>
                    <td class="thcol" style="width: 60%;"><?php echo app\modules\fe_edoc\Module::t("fe", 'Description'); ?></td>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Code Principal'); ?></td>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Code Auxiliary'); ?></td>
                </tr>
                <?php \app\models\Utilities::putMessageLogFile($destDoc);
                for ($i = 0; $i < sizeof($destDoc); $i++) {
                    foreach ($destDoc[$i]["GuiaDet"] as $key => $value){
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . intval($value['Cantidad']) . "</td>";
                        echo "<td style='text-align: left;'>" . $value['Descripcion'] . "</td>";
                        echo "<td style='text-align: center;'>" . $value['CodigoInterno'] . "</td>";
                        echo "<td style='text-align: center;'>" . $value['CodigoAdicional'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <div class="divDetalles">
        <div class="divDetalleAd ">
            <div class="bordeDivDet modCab div_modInfoAd <?php if (!isset($adiDoc)) { ?>divDetaVacio<?php } ?>">
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