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
    datArray[0] = objDat;
    //sessionStorage.dataPersona = JSON.stringify(datArray);
    return datArray;
}

function listaDetPedido() {    
    var arrayList = new Array;
    var c=0;    
    //Usa los datos del Session Stores
    if (sessionStorage.dts_carrito) {
        var Grid = JSON.parse(sessionStorage.dts_carrito);
        if (Grid.length > 0) {
            for (var i = 0; i < Grid.length; i++) { 
                
                /*SELECT `det_listapedidos_temp`.`ids_dlis`,
                    `det_listapedidos_temp`.`ids_clis`,
                    `det_listapedidos_temp`.`ids_pre`,
                    `det_listapedidos_temp`.`ids_pro`,
                    `det_listapedidos_temp`.`cod_art`,
                    `det_listapedidos_temp`.`tip_doc`,
                    `det_listapedidos_temp`.`num_doc`,
                    `det_listapedidos_temp`.`cli_id`,
                    `det_listapedidos_temp`.`p_venta`,
                    `det_listapedidos_temp`.`can_des`,
                    `det_listapedidos_temp`.`t_venta`,
                    `det_listapedidos_temp`.`por_des`,
                    `det_listapedidos_temp`.`val_des`,
                    `det_listapedidos_temp`.`i_m_iva`,
                    `det_listapedidos_temp`.`val_iva`,
                    `det_listapedidos_temp`.`est_ped`,
                    `det_listapedidos_temp`.`est_log`,
                    `det_listapedidos_temp`.`fec_cre`,
                    `det_listapedidos_temp`.`fec_mod`,
                    `det_listapedidos_temp`.`usuario`
                FROM `db_tienda`.`det_listapedidos_temp`;*/

                
                //[{"ids_pos":0,"ids_pro":"260","cod_art":"B0137","des_com":"BLOCK EJECUTIVO CUADRO","p_venta":"0.6795","can_des":"1","por_des":0,"val_des":0,"i_m_iva":1,"val_iva":"8.15","t_venta":"8.83","accion":"new"},
                // {"ids_pos":1,"ids_pro":"1073","cod_art":"E0003","des_com":"ENGRAP.ARTESCO M.727 NEGRA P/30H","p_venta":"4.6369","can_des":1,"por_des":0,"val_des":0,"i_m_iva":1,"val_iva":"55.64","t_venta":"60.28","accion":"new"},
                // {"ids_pos":2,"ids_pro":"984","cod_art":"C0696","des_com":"CINTA EMBALAJE 2PX80Y KOBOL 740 TRANSP.45MIC IND.","p_venta":"0.8756","can_des":"10","por_des":0,"val_des":0,"i_m_iva":1,"val_iva":"10.51","t_venta":8.756,"accion":"new"}]
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
    return JSON.stringify(arrayList);
}