/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*  Funcion Retorna "retornarIndLista"
 *  Recibe: Lista Json, Propieda o Campo,Valor Comparacion, Campo del Valor a Retornar
 **/
function retornarIndLista(array,property,value,ids){
    var index=-1;
    for(var i=0; i<array.length; i++){
        if(array[i][property]==value){
            index=array[i][ids];
            return index;
        }
    }
    //Retorna  -1 si no esta en ls lista
    return index;
}

function buscarDataIndex(control,op){ 
    control=(control=='')?'txt_PER_CEDULA':control;
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_DOCUMENTO').PbGridView('applyFilterData', { "CONT_BUSCAR": controlBuscarIndex(control, op)});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function controlBuscarIndex(control, op) {
    var buscarArray = new Array();
    var buscarIndex = new Object();
    if (sessionStorage.src_buscIndex) {
        var arrayList = JSON.parse(sessionStorage.src_buscIndex);
        buscarIndex.CEDULA = retornarIndLista(arrayList, 'RazonSocialComprador', $('#' + control).val(), 'IdentificacionComprador');
    } else {
        buscarIndex.CEDULA = '';
    }
    buscarIndex.OP = op;
    buscarIndex.TIPO_APR = $('#cmb_tipoApr option:selected').val();
    buscarIndex.RAZONSOCIAL = $('#' + control).val(),

    buscarIndex.F_INI = $('#dtp_fec_ini').val();
    buscarIndex.F_FIN = $('#dtp_fec_fin').val();
    buscarArray[0] = buscarIndex;
    //return buscarArray[0];
    return JSON.stringify(buscarArray);
}

function autocompletarBuscarPersona(requestq, responseq, control, op) {
    var link = $('#txth_base').val() + "/fe_edoc/nubeguiaremision/index";
    var arrParams = new Object();
    arrParams.valor = $('#' + control).val();
    arrParams.op = op;
    requestHttpAjax(link, arrParams, function (response) {
        //showAlert(response.status, response.label, response.message);
        //if (response.status == 'OK') {
            var arrayList = new Array;
            var count = response.length;
            for (var i = 0; i < count; i++) {
                row = new Object();
                row.IdentificacionSujetoRetenido = response[i]['IdentificacionDestinatario'];
                row.RazonSocialSujetoRetenido = response[i]['RazonSocialDestinatario'];

                // Campos Importandes relacionados con el  CJuiAutoComplete
                row.id = response[i]['IdentificacionDestinatario'];
                row.label = response[i]['RazonSocialDestinatario'] + ' - ' + response[i]['IdentificacionDestinatario'];//+' - '+data[i]['SEGURO_SOCIAL'];//Lo sugerido
                //row.value=response[i]['IdentificacionSujetoRetenido'];//lo que se almacena en en la caja de texto
                row.value = response[i]['RazonSocialDestinatario'];//lo que se almacena en en la caja de texto
                arrayList[i] = row;
            }
            sessionStorage.src_buscIndex = JSON.stringify(arrayList);//dss=>DataSessionStore
            responseq(arrayList);
        //}
    }, true);
}

function verificaAcciones(){
    var ids = String($('#TbG_DOCUMENTO').PbGridView('getSelectedRows'));
    var count=ids.split(",");
    if(count.length>0 && ids!=""){
        $("#btn_enviar").removeClass("disabled");
        //verificaAutorizado('TbG_DOCUMENTO');
    }else{
        $("#btn_enviar").addClass("disabled");
    }
}

function verificaAutorizado(TbGtable) {
    $('#' + TbGtable + ' tr').each(function () {
        var estado = $(this).find("td").eq(3).html();//Columna Estado
        //Verifica que este CHeck la Primera COlumna
        if ($(this).children(':first-child').children(':first-child').is(':checked')){
            //alert(estado);
            if (estado == 'Autorizado') {//Si es Igual Autorizado no lo deja Check
                
            }
        }
    });
}

function fun_EnviarDocumento(){
    var ids = String($('#TbG_DOCUMENTO').PbGridView('getSelectedRows'));
    var count=ids.split(",");
    if(count.length>0 && ids!=""){
        if(!confirm(mgEnvDocum)) return false;
        var link = $('#txth_base').val() + "/fe_edoc/nubeguiaremision/EnviarDocumento";
        var encodedIds = base64_encode(ids);  //Verificar cofificacion Base
        $("#TbG_DOCUMENTO").addClass("loading");
        var arrParams = new Object();
        arrParams.ids = encodedIds;
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == 'OK') {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
                //actualizarTbG_DOCUMENTO();
                buscarDataIndex('', '');
            } else {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
            }
            $("#TbG_DOCUMENTO").removeClass("loading");
        }, true);
    }else{
        $("#messageInfo").html(selecDoc+buttonAlert); 
        alerMessage();
    }
    return true;
}

function actualizarTbG_DOCUMENTO(){
    $('#TbG_DOCUMENTO').PbGridView('getSelectedRows');
    /*var link=$('#txth_controlador').val()+"/Index";
    $.fn.yiiGridView.update('TbG_COMPANIA', {
        type: 'POST',
        url:link,
        data:{
            //"CONT_BUSCAR": controlBuscarIndex(control,op)
        }
    }); */
}

/*
 * ADMINISTRADOR DE TAREAS WEBSEA
 */

function fun_EnviarCorreccion(){
    var ids = String($('#TbG_DOCUMENTO').PbGridView('getSelectedRows'));
    var count=ids.split(",");
    if(count.length>0 && ids!=""){
        if(!confirm(mgEnvDocumAnu)) return false;
        var link = $('#txth_base').val() + "/fe_edoc/nubeguiaremision/EnviarCorreccion";
        var encodedIds = base64_encode(ids);  //Verificar cofificacion Base
        $("#TbG_DOCUMENTO").addClass("loading");
        var arrParams = new Object();
        arrParams.ids = encodedIds;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
                //actualizarTbG_DOCUMENTO();
                buscarDataIndex('', '');
            } else {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
            }
        }, true);
        $("#TbG_DOCUMENTO").removeClass("loading");
    }else{
        $("#messageInfo").html(selecDocAnu+buttonAlert); 
        alerMessage();
    }
    return true;
}

function fun_EnviarAnular(){
    var ids = String($('#TbG_DOCUMENTO').PbGridView('getSelectedRows'));
    var count=ids.split(",");
    if(count.length>0 && ids!=""){
        if(!confirm(mgEnvDocumAnu)) return false;
        var link = $('#txth_base').val() +"/fe_edoc/nubeguiaremision/EnviarAnular";
        var encodedIds = base64_encode(ids);  //Verificar cofificacion Base
        $("#TbG_DOCUMENTO").addClass("loading");
        var arrParams = new Object();
        arrParams.ids = encodedIds;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
                //actualizarTbG_DOCUMENTO();
                buscarDataIndex('', '');
            } else {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
            }
        }, true);
        $("#TbG_DOCUMENTO").removeClass("loading");
    }else{
        $("#messageInfo").html(selecDocAnu+buttonAlert); 
        alerMessage();
    }
    return true;
}

function fun_EnviarCorreo(){
    var ids = String($('#TbG_DOCUMENTO').PbGridView('getSelectedRows'));
    var count=ids.split(",");
    if(count.length>0 && ids!=""){
        if(!confirm(mgEnvDocum)) return false;
        var link = $('#txth_base').val() +"/fe_edoc/nubeguiaremision/EnviarCorreo";
        var encodedIds = base64_encode(ids);  //Verificar cofificacion Base
        $("#TbG_DOCUMENTO").addClass("loading");
        var arrParams = new Object();
        arrParams.ids = encodedIds;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
                //actualizarTbG_DOCUMENTO();
                buscarDataIndex('', '');
            } else {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
            }
        }, true);
        $("#TbG_DOCUMENTO").removeClass("loading");
    }else{
        $("#messageInfo").html(selecDocMail+buttonAlert); 
        alerMessage();
    }
    return true;
}

/*
 * Modificar MAIL
 */
function fun_UpdateMail(){
    var link="";
    var id = String($('#TbG_DOCUMENTO').PbGridView('getSelectedRows'));
    var count=id.split(",");
    if(count.length==1 && id!=""){
        //id = base64_encode(ids);
        link = $('#txth_base').val() +"/fe_edoc/nubeguiaremision/updatemail?";
        $('#btn_Update').attr("href", link+"id="+id); 
    }
}

function fun_CambiaMail() {
    var ids = $('#txth_usu_mail').val();
    var correo = $('#txt_correo').val();
    if ($('#txt_correo').val()!='' && ids!=0) {
        //pass = base64_encode(pass);
        var link = $('#txth_base').val() +"/fe_edoc/nubeguiaremision/Savemail";
        var arrParams = new Object();
        arrParams.DATA = correo;
        arrParams.ID = ids;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
            } else {
                $("#messageInfo").html(response.message + buttonAlert);
                alerMessage();
            }
        }, true);
    }else{
        alert('Los Datos de correo no son correctos.');
    }

}



