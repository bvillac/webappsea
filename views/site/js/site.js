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
    objDat.usu_password = $('#txt_usu_password').val();
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


function hacerPedidos(accion) {
    var usuID = (accion == "Update") ? $('#txth_usu_id').val() : 0;
    var perID = (accion == "Update") ? $('#txth_per_id').val() : 0;
    var link = $('#txth_base').val() + "/site/save";
    var arrParams = new Object();
    arrParams.CAB_DATA = listaCabPedido(usuID,perID);
    arrParams.DET_DATA = listaDetPedido();
    arrParams.ACCION = accion;
    //var validation = validateForm();
    //if (!validation) {
        requestHttpAjax(link, arrParams, function (response) {
            var message = response.message;
            if (response.status == "OK") {
                showAlert(response.status, response.type, {"wtmessage": message.info, "title": response.label});
                $('#registroModal').modal('hide');
                //$('#registroModal').modal({show:true});
                limpiarDatosPedido();
                var renderurl = $('#txth_base').val() + "/site/index";
                window.location = renderurl;
            } else {
                showAlert(response.status, response.type, {"wtmessage": message.info, "title": response.label});
            }
        }, true);
    //}
    //showAlert('NO_OK', 'error', {"wtmessage": 'Debe Aceptar los términos de la Declaración Jurada', "title":'Información'});
}

function limpiarDatosPedido() {
    $('#txt_per_nombre').val("");
    $('#txt_per_apellido').val("");
    $('#txt_per_correo').val("");
    $('#txt_dper_direccion').val("");
    $('#txt_dper_telefono').val("");
    $('#lbl_total').text("0.00");
    sessionStorage.removeItem('dataPersona');
    sessionStorage.removeItem('dts_carrito');
       
}

function listaCabPedido(usuID,perID) {
    var datArray = new Array();
    var objDat = new Object();
    objDat.usu_id = usuID;//Genero Automatico
    objDat.per_id = perID;
    //objDat.per_ced_ruc = "";//$('#txt_per_ced_ruc').val();
    objDat.per_nombre = $('#txt_per_nombre').val();
    objDat.per_apellido = $('#txt_per_apellido').val();
    objDat.per_correo = $('#txt_per_correo').val();
    objDat.dper_direccion = $('#txt_dper_direccion').val();
    objDat.dper_telefono = $('#txt_dper_telefono').val();
    //objDat.dper_celular =$('#txt_dper_celular').val();
    objDat.dper_est_log = 1;
    
    objDat.tip_doc = "PD";
    objDat.num_doc = "0";//$('#lbl_total').text(redondea(total, Ndecimal))
    objDat.val_bru = "0";
    objDat.val_net = $('#lbl_total').text();
    datArray[0] = objDat;
    //sessionStorage.dataPersona = JSON.stringify(datArray);
    return datArray;
}

function listaDetPedido() {    
    var arrayList = new Array();
    var c=0;    
    //Usa los datos del Session Stores
    if (sessionStorage.dts_carrito) {
        var Grid = JSON.parse(sessionStorage.dts_carrito);
        if (Grid.length > 0) {
            for (var i = 0; i < Grid.length; i++) {                
                if(parseFloat(Grid[i]['can_des'])>0){//$('#txt_cat_'.Grid[c]['ARTIE_ID']).val()
                    var rowGrid = new Object();
                    rowGrid.ids_pro = Grid[i]['ids_pro'];
                    rowGrid.cod_art = Grid[i]['cod_art'];
                    rowGrid.tip_doc = "PD";//Grid[i]['tip_doc'];
                    rowGrid.num_doc = "0";//Grid[i]['num_doc'];
                    rowGrid.cli_id = "1";//Grid[i]['cli_id'];
                    rowGrid.p_venta = Grid[i]['p_venta'];
                    rowGrid.can_des = Grid[i]['can_des'];
                    rowGrid.t_venta = redondea(Grid[i]['t_venta'], Ndecimal);
                    rowGrid.por_des = Grid[i]['por_des'];
                    rowGrid.val_des = Grid[i]['val_des'];
                    rowGrid.i_m_iva = Grid[i]['i_m_iva'];
                    rowGrid.val_iva = Grid[i]['val_iva'];
                    rowGrid.est_ped = "PD";//Grid[i]['can_des'];
                    rowGrid.est_log = "1";               
                    arrayList[c] = rowGrid;
                    c += 1;
                }
            }    
        }
    }
    //return JSON.stringify(arrayList);
    return arrayList;
}

function confirmaPedidos() { 
    var estado=false;
    if (sessionStorage.dts_carrito) {
        var Grid = JSON.parse(sessionStorage.dts_carrito);
        if (Grid.length > 0) {//Se puede proceder            
            estado=$('#txth_activo').val();
            if(estado){
                //alert('entro'+estado);
                var renderurl = $('#txth_base').val() + "/site/confirmarpedido";
                window.location = renderurl;  
            }else{
                //alert('no entro'+estado);
                $('#loginModal').modal({show:true});
            }
            
                      
        }else{
            showAlert('NO_OK', 'error', {"wtmessage": 'No Existen Items a pedir', "title":'Información'});
        }        
    }else{
        showAlert('NO_OK', 'error', {"wtmessage": 'No Existen Items a pedir', "title":'Información'});
    }
    
    
}