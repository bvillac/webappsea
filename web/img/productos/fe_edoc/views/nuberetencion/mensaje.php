<style>
    .titleLabel{
        /*font-size:7pt;*/
        /*color:#000;*/
        font-weight: bold ;
    }
</style>

<div id="div-table">
        <div class="trow">
            <p><label class="titleLabel">Estimad@:<br> 
            <?php echo $DatVen["Alias"] ?>, Ha Solicitado la Anulación de un Documentos Electrónico
            </p>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Summary') ?> : </label>
            </div>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Password Sri') ?> : </label>
                <span><?php echo $CabPed["ClaveAcceso"] ?></span>
            </div>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Authorization number SRI') ?> : </label>
                <span><?php echo $CabPed["AutorizacionSRI"] ?></span>
            </div>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Authorization date') ?> : </label>
                <span><?php echo $CabPed["FechaAutorizacion"] ?></span>
            </div>
        </div>        
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Dni') ?> : </label>
                <span><?php echo $CabPed["Identificacion"] ?></span>
            </div>
        </div>        
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Company name') ?> : </label>
                <span><?php echo $CabPed["RazonSocial"] ?></span>
            </div>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Mail') ?> : </label>
                <span><?php echo $CabPed["Correo"] ?></span>
            </div>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <label class="titleLabel"><?php echo Yii::t('COMPANIA', 'Document') ?> : </label>
                <span><?php echo $CabPed["NombreDocumento"] ?></span>
            </div>
        </div>
        <div class="trow">
            <div class="tcol-td form-group">
                <p>
                    <br><br>
                    <label class="titleLabel">Utimpor S.A.</label>
                </p>
            </div>
        </div>        
    </div>