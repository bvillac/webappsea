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
    
    $('#rbt_tipo_per1').click(function () {
        verNatural(true);
        verJuridico(false);
    });
    $('#rbt_tipo_per2').click(function () {
        verJuridico(true);
        verNatural(false);
    });
    

});

function verNatural(valor) {
    if(valor){
       $('#txt_per_nombre').show(); 
       $('#txt_per_apellido').show();
       $('#txt_per_ced_ruc_n').show();
    }else{
       $('#txt_per_nombre').hide();
       $('#txt_per_apellido').hide();
       $('#txt_per_ced_ruc_n').hide();
    }
}
function verJuridico(valor) {
    if(valor){
       $('#txt_per_empresa').show(); 
       $('#txt_per_ced_ruc_j').show();
       $('#txt_per_nombre_j').show(); 
       $('#txt_per_apellido_j').show();
    }else{
       $('#txt_per_empresa').hide();
       $('#txt_per_ced_ruc_j').hide();
       $('#txt_per_nombre_j').hide(); 
       $('#txt_per_apellido_j').hide();
    }
}

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
    var tipPer='';
    //var tipPer = ($("#rbt_tipo_per1").prop("checked", true))?'N':'J';
    if ($("#rbt_tipo_per1").is(':checked')) {
        tipPer = 'N';
    } else {
        tipPer = 'J';
    }  
    objDat.per_tipo_persona =tipPer;
    objDat.usu_id = usuID;//Genero Automatico
    objDat.per_id = perID;
    objDat.usu_password = $('#txt_usu_password').val();
    objDat.per_ced_ruc = (tipPer=='N')?$('#txt_per_ced_ruc_n').val():$('#txt_per_ced_ruc_j').val();
    objDat.per_nombre = (tipPer=='N')?$('#txt_per_nombre').val():$('#txt_per_nombre_j').val();
    //alert($('#txt_per_apellido_j').val());
    objDat.per_apellido = (tipPer=='N')?$('#txt_per_apellido').val():$('#txt_per_apellido_j').val();
    objDat.per_empresa = (tipPer=='J')?$('#txt_per_empresa').val():'';
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
    objDat.usu_estado_activo=0;

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


// MOSTRAR MENU CATEGORIAS 

function mostrarCategoria(ids,nombre) {
    //alert(ids);
    menuSelected('nivel_0',nombre);
    var strData = "";
    var link = $('#txth_base').val() + "/site/index";
    var arrParams = new Object();
    arrParams.ids = base64_decode(ids);
    arrParams.op = 'categoria';
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            var data = response.message;
            for (var i = 0; i < data.length; i++) {
                //alert(data[i]['nom_cat']);
                //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                //strData += llenarCategoriasXXX(data[i]);
                strData += llenarCategorias(data[i]);
            }
            $("#listaCategorias").html(strData);
            //menuSelected();
        }
    }, true);
    return false;
}
function llenarCategorias(data){
    var strData = "";
        strData += '<ul id="nivel_1" class="nav nav-pills nav-stacked">';
            strData += '<li>';
                strData += '<a href="javascript:void(0)" onclick="mostrarSubCategoria(\'' + data['ids_cat'] + '\',\'' + data['nom_cat'] + '\')" >';
                    strData += data['nom_cat'];
                strData += '</a>';
            strData += '</li>';
        strData += '</ul>';
    return strData;
}

function llenarCategoriasXXX(data){
    var strData = "";
        var subnivel=data['subnivel'];
        //alert(subnivel.length);
        if(subnivel.length>0){
            strData += '<div class="panel panel-default">';
                strData += '<div class="panel-heading">';
                    strData += '<h4 class="panel-title">';
                        strData += '<a data-toggle="collapse" data-parent="#accordian" href="#' + data['nom_cat'] + '">';
                            strData += '<span class="badge pull-right"><i class="fa fa-plus"></i></span>';
                            strData += data['nom_cat'];
                        strData += '</a>';
                    strData += '</h4>';
                strData += '</div>';
                //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
               
                strData += '<div id="' + data['nom_cat'] + '" class="panel-collapse collapse">';
                    strData += '<div class="panel-body">';
                        strData += '<ul id="subNivel" class="nav nav-pills nav-stacked">';
                            for (var i = 0; i < subnivel.length; i++) {
                                strData += '<li>';
                                    strData += '<a href="javascript:void(0)" onclick="buscarProductos(0,\'' + subnivel[i]['ids_cat'] + '\')" >';
                                        strData += subnivel[i]['nom_cat'];
                                    strData += '</a>';
                                strData += '</li>';
                            }
                        strData += '</ul>';
                    strData += '</div>';
                strData += '</div>';
            strData += '</div>';
        }else{
            strData += '<div class="panel panel-default">';
                strData += '<div class="panel-heading">';
                    strData += '<h4 class="panel-title"><a href="javascript:void(0)" onclick="buscarProductos(0,\'' + data['ids_cat'] + '\')" >' + data['nom_cat'] + '</a></h4>';
                strData += '</div>';
            strData += '</div>';
            
        }
    return strData;
}

function mostrarSubCategoria(ids,nombre) {
    var strData = "";    
    $('#lbl_NameCat_N2').text(nombre) 
    var link = $('#txth_base').val() + "/site/index";
    var arrParams = new Object();
    arrParams.ids = base64_encode(ids);
    arrParams.op = 'subCategoria';
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            var data = response.message;
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    strData += '<ul id="nivel_2" class="nav nav-pills nav-stacked">';
                    for (var i = 0; i < data.length; i++) {
                        strData += '<li>';
                                strData += '<a href="javascript:void(0)" onclick="buscarProductos(0,\'' + data[i]['ids_cat'] + '\',\'' + data[i]['nom_cat'] + '\')" >';
                                //strData += '<a href="'+$('#txth_base').val()+'/site/productos?codigo='+base64_encode(data[i]['ids_cat'])+'"  >';
                                strData += data[i]['nom_cat'];
                            strData += '</a>';
                        strData += '</li>';
                    }
                    strData += '</ul>';
                }
            }else{
                buscarProductos(0,ids,nombre);//Busca par ver si tiene Productos en la segunda categoria
                /*strData += '<div class="col-sm-12 alert alert-warning" role="alert">';
                    strData += 'No tiene Resultados!!!';
                strData += '</div>'; */
            }            
            $("#listaSubCategorias").html(strData);
            menuSelected('nivel_1',nombre);
        }
    }, true);
    return false;
}

//Selecionar Productos
//https://www.anerbarrena.com/jquery-each-5297/
function menuSelected(idsUL,nombre){
    //Recibimos el Id del elemento y recorremos los LI y sacamos su texto,
    //le agregamos la propieda class=active para que este selecionado
    $("#"+idsUL+" li > a").each(function () {
        //alert($(this).text())
        if($(this).text()==nombre){
            //$(this).attr("class","glyphicon glyphicon-hand-right");
            //$(this).html('<h1>'+nombre+'</h1>');
            $(this).html('<h4><span class="badge badge-secondary">'+nombre+'</span></h4>');
        }else{
            //$(this).attr("class","");
            $(this).html($(this).text());
        }
    });
}


function verProducto(ids,txt_cant){
    var cant=0;
    var link = $('#txth_base').val() + "/site/productodetalle";
    if (txt_cant==0){//cuando viene por la busqueda general
        cant=1;
    }else{
        //cuando viene desd un detalle
        cant=('#'+txt_cant)?$('#'+txt_cant).val():1;//Si existe el control pasa el valor caso contrario manda el valor por defecto= 1
    }
    
    parent.window.location.href = link + "?codigo="+ids+"&cant="+cant;
}

//Buscar productos paginado
function buscarProductos(page,idsCat,nombre) {
    //alert(page+' cc '+idsCat+' cc '+nombre)
    $('#lbl_NameCat_N3').text(nombre)
    menuSelected('nivel_1',$('#lbl_NameCat_N2').text());
    menuSelected('nivel_2',nombre);
    //$('.items').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/><br/>Un momento por favor...</div>');
    
    var strData = "";
    var link = $('#txth_base').val() + "/site/productos";
    var orderBy=$('#cmb_orden option:selected').val();
    var desCom=$('#txt_buscarData').val();
    //Verifica la categoria recuperada por php y dianamico por javascript
    var idsCat=(idsCat>0)?idsCat:$('#txth_idsCat').val();
    
    var arrParams = new Object();
    arrParams.page = (page!=0)?page:1;
    arrParams.codigo = (idsCat!=0)?base64_encode(idsCat):0;//idsCat =>idscategoria
    arrParams.desCom = desCom;
    arrParams.orderBy = orderBy;
    arrParams.op = 'productos';
    requestHttpAjax(link, arrParams, function (response) {
        strData += '<div class="col-sm-12 alert alert-warning" role="alert">';
            strData += 'No tiene Resultados!!!';
        strData += '</div>';
        if (response.status == "OK") {
            //var data = JSON.parse(response.message);
            var data = response.message.data;
            //alert(JSON.stringify(data));
            //alert(JSON.parse(data));
            //alert(data.toSource());
            //alert(response.message.toSource());
            var n=0;
            var fil=0;
            if(data.length>0){
                strData='';
                for (var i = 0; i < data.length; i++) {
                    //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                    n=0;
                    strData+='<div class="row">';                
                    while (n < 3) {
                        //alert(data[fil]['cod_art']);
                        if(typeof(data[fil]) != "undefined"){
                            strData += llenarItems(data[fil]);
                        } 
                        fil++;
                        n ++;  
                    }
                    strData+='</div>';
                    i=i+n;
                }                
            }
            paginadojs(response.message.trows);
            //$('.items').fadeIn(2000).html(data);
            $('.pagination li').removeClass('active');
            $('.pagination li a[data="' + page + '"]').parent().addClass('active');
        }
        //console.log(data);
        $("#listaPedidos").empty();
        // $("#listaPedidos").append(strData);
        $("#listaPedidos").html(strData);
    }, true);
    return false;

}

function paginadojs(trows){
   var numPag=trows/9; 
 
    //var strData= '<div class="col-lg-12">';
    var strData = '<nav aria-label="Page navigation example">';
     strData += '<ul class="pagination justify-content-end">';
    for (var i = 1; i < numPag+1; i++) {        
        strData+=  '<li class="page-item "><a onclick="buscarProductos(\'' +i+ '\',0,\'\')" href="javascript:void(0)" class="page-link" data="' + i + '">' + i + '</a></li>';
    }
    strData+= '</ul>';
    strData+= '</nav>';
    //strData+= '</div>';

    $("#Paginado").empty();
    $("#Paginado").html(strData);
    
}



function llenarItems(data){
    var estado=$('#txth_activo').val();
    var link = $('#txth_base').val() + "/site/carrito";
    var ruta=$('#txth_imgfolder').val()+ data['cod_art']+'_P-01.jpg';
    if(!fileExists(ruta)){
        //sI la ruta no existe muestra la imagen no foto
        ruta=$('#txth_imgfolder').val()+ 'NO_FOTO.jpg';
    }
    
    var strData = "";//data[i]['p_venta']
    strData += '<div class="col-sm-4">';
        if(estado){
            strData += '<div class="product-image-wrapper">';
                strData += '<div class="single-products">';
                    strData += '<div class="productinfo text-center">';
                        //strData += '<img src="img/productos/img1.jpg" alt="" />';
                        strData += '<img onclick="verProducto(\'' + data['ids_pro'] + '\',1)" src="'+ruta+'" alt="" />';
                        strData += '<h2>$' + redondea(data['p_venta'],2) + '</h2>';
                        strData += '<p>' + data['des_com'] + '</p>';
                        strData += '<a onclick="addCarrito(\'' + data['ids_pro'] + '\',\'' + data['cod_art'] + '\',\'' + data['des_com'] + '\',\'' + data['p_venta'] + '\',0)" href="javascript:void(0)" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar a Carrito</a>';
                    strData += '</div>';
                    /*strData += '<div class="product-overlay">';
                        strData += '<div class="overlay-content">';
                            strData += '<h2>$' + data['p_venta'] + '</h2>';
                            strData += '<p>' + data['des_com'] + '</p>';
                            strData += '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar a Carrito</a>';
                        strData += '</div>';
                    strData += '</div>';*/
                strData += '</div>';
                strData += '<div class="choose">';
                    strData += '<ul class="nav nav-pills nav-justified">';
                        strData += '<li><a href="#"><i class="fa fa-plus-square"></i>Agregar a lista de pedidos</a></li>';
                        strData += '<li><a href="' + link + '"><i class="fa fa-plus-square"></i>Ver Carrito</a></li>';
                    strData += '</ul>';
                strData += '</div>';
            strData += '</div>';            
        }else{
            strData += '<div class="product-image-wrapper">';
                strData += '<div class="single-products">';
                    strData += '<div class="productinfo text-center">';
                        //strData += '<img src="img/productos/img1.jpg" alt="" />';
                        strData += '<img onclick="verProducto(\'' + data['ids_pro'] + '\',1)" src="'+ruta+'" alt="" />';
                        strData += '<p>' + data['des_com'] + '</p>';
                        strData += '<a id="btn_detalle" class="btn btn-primary" href="/webappsea/site/productodetalle?codigo='+data['ids_pro']+'">Ver Detalle</a>';
                        //strData += '<a onclick="addCarrito(\'' + data['ids_pro'] + '\',\'' + data['cod_art'] + '\',\'' + data['des_com'] + '\',\'' + data['p_venta'] + '\',0)" href="javascript:void(0)" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ver Detalle</a>';
                    strData += '</div>';                    
                strData += '</div>';
                
            strData += '</div>';
            
        }
        
    strData += '</div>';
    return strData;
}

