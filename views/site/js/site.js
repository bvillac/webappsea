/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//alert('hola');
$(document).ready(function () {
    
    
    
    $('#btn_saveCuenta').click(function () {
        guardarDatos('Create');
    });

});

function divComentario(data) {
    //$("#countMensaje").html(data.length);
    var option_arr = '';
    option_arr += '<div style="overflow-y: scroll;height:200px;">';
    for (var i = 0; i < data.length; i++) {
        option_arr += '<div class="post clearfix">';
            option_arr += '<div class="user-block">';
                option_arr += '<span>';
                    option_arr += '<a href="#">'+(data[i]["Nombres"]).toUpperCase()+'</a>';
                    //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                option_arr += '</span><br>';
                option_arr += '<span>'+(data[i]["fecha"]).toUpperCase()+'</span>';
            option_arr += '</div>';
            option_arr += '<p>'+(data[i]["Mensaje"]).toUpperCase()+'</p>';
        option_arr += '</div>';
    }
    option_arr += '</div>';
    showAlert("OK", "info", {"wtmessage": option_arr, "title": "Correcciones"});
}

function guardarDatos(accion) {
    var usuID = (accion == "Update") ? $('#txth_usu_id').val() : 0;
    var perID = (accion == "Update") ? $('#txth_per_id').val() : 0;
    var link = $('#txth_base').val() + "/usuario/save";
    var arrParams = new Object();
    arrParams.DATA = dataPersona(usuID,perID);
    arrParams.ACCION = accion;
    //var validation = validateForm();
    //if (!validation) {
        requestHttpAjax(link, arrParams, function (response) {
            var message = response.message;
            if (response.status == "OK") {
                showAlert(response.status, response.type, {"wtmessage": message.info, "title": response.label});
                $('#registroModal').modal('hide');
                //$('#registroModal').modal({show:true});
                //limpiarDatos();
                //var renderurl = $('#txth_base').val() + "/mceformulariotemp/index";
                //window.location = renderurl;
            } else {
                showAlert(response.status, response.type, {"wtmessage": message.info, "title": response.label});
            }
        }, true);
    //}
    //showAlert('NO_OK', 'error', {"wtmessage": 'Debe Aceptar los términos de la Declaración Jurada', "title":'Información'});
}

function dataPersona(usuID,perID) {
    var datArray = new Array();
    var objDat = new Object();
    objDat.usu_id = usuID;//Genero Automatico
    objDat.per_id = perID;
    objDat.per_ced_ruc = "";//$('#txt_per_ced_ruc').val();
    objDat.per_nombre = $('#txt_per_nombre').val();
    objDat.per_apellido = $('#txt_per_apellido').val();
    objDat.per_genero = "";//$('#cmb_per_genero option:selected').val();
    objDat.per_fecha_nacimiento = "";//$('#dtp_per_fecha_nacimiento').val();
    objDat.per_estado_civil = "";//$('#cmb_per_estado_civil option:selected').val();
    objDat.per_correo = $('#txt_per_correo').val();
    //objDat.per_factor_rh = 
    objDat.per_tipo_sangre = "";//$('#cmb_per_tipo_sangre option:selected').val();
    objDat.per_foto = '';
    //objDat.dper_id=
    objDat.pai_id = 56;
    //objDat.prov_id = $('#cmb_provincia option:selected').val();
    //objDat.can_id = $('#cmb_ciudad option:selected').val();
    //objDat.dper_descripcion=
    objDat.dper_direccion = "";//$('#txt_dper_direccion').val();
    objDat.dper_telefono = "";//$('#txt_dper_telefono').val();
    objDat.dper_celular =$('#txt_dper_celular').val();
    objDat.dper_contacto = $('#txt_dper_contacto').val();
    objDat.dper_est_log = 1;

    datArray[0] = objDat;
    sessionStorage.dataPersona = JSON.stringify(datArray);
    return datArray;
}