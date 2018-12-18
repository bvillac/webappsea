/*price range*/

$('#sl2').slider();

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};
		
/*scroll to top*/

function retornarIndexArray(array, property, value) {
    var index = -1;
    for (var i = 0; i < array.length; i++) {
        //alert(array[i][property]+'-'+value)
        if (array[i][property] == value) {
            index = i;
            return index;
        }
    }
    return index;
}

function codigoExiste(value, property, lista) {
    if (lista) {
        var array = JSON.parse(lista);
        for (var i = 0; i < array.length; i++) {
            if (array[i][property] == value) {
                return false;
            }
        }
    }
    return true;
}

function findAndRemove(array, property, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][property] == value) {
            array.splice(i, 1);
        }
    }
    return array;
}


$(document).ready(function () {
    buscarProductos(1,0);
    mostrarCategoria(base64_encode('1'));
    
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });



    $('.pagination li a').on('click', function () {
        var page = $(this).attr('data');
        buscarProductos(page,0);
    });
    
    
    $('#cmd_login').click(function () {
        verificarIngreso();
    });
    
    

});




function buscarProductos(page,idsCat) {
    //$('.items').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/><br/>Un momento por favor...</div>');
    var strData = "";
    var link = $('#txth_base').val() + "/site/index";
    var arrParams = new Object();
    arrParams.page = (page!=0)?page:1;
    arrParams.idsCat = (idsCat!=0)?idsCat:0;
    arrParams.op = 'productos';
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            var data = response.message;
            var n=0;
            var fil=0;
            for (var i = 0; i < data.length; i++) {
                //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                n=0;
                strData+='<div class="row">';
                while (n < 3) {
                    if(typeof(data[fil]) != "undefined"){
                        strData += llenarItems(data[fil]);
                    } 
                    fil++;
                    n ++;  
                }
                strData+='</div>';
                i=i+n;
            }
            $("#listaPedidos").empty();
            // $("#listaPedidos").append(strData);
            $("#listaPedidos").html(strData);

            //console.log(data);
            //$('.items').fadeIn(2000).html(data);
            $('.pagination li').removeClass('active');
            $('.pagination li a[data="' + page + '"]').parent().addClass('active');
        }
    }, true);
    return false;

}

function llenarItems(data){
    //var ruta=$('#txth_imgfolder').val()+'img1.jpg';
    var ruta=$('#txth_imgfolder').val()+ data['cod_art']+'_G-01.jpg';
    var strData = "";//data[i]['p_venta']
    strData += '<div class="col-sm-4">';
        strData += '<div class="product-image-wrapper">';
            strData += '<div class="single-products">';
                strData += '<div class="productinfo text-center">';
                    //strData += '<img src="img/productos/img1.jpg" alt="" />';
                    strData += '<img onclick="verProducto(\'' + data['ids_pro'] + '\')" src="'+ruta+'" alt="" />';
                    strData += '<h2>$' + redondea(data['p_venta'],2) + '</h2>';
                    strData += '<p>' + data['des_com'] + '</p>';
                    strData += '<a onclick="addCarrito(\'' + data['ids_pro'] + '\',\'' + data['cod_art'] + '\',\'' + data['des_com'] + '\',\'' + data['p_venta'] + '\')" href="javascript:void(0)" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar a Carrito</a>';
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
                    strData += '<li><a href="#"><i class="fa fa-plus-square"></i>Comparacion</a></li>';
                strData += '</ul>';
            strData += '</div>';
        strData += '</div>';
    strData += '</div>';
    return strData;
}

function mostrarCategoria(ids) {
    var strData = "";
    var link = $('#txth_base').val() + "/site/index";
    var arrParams = new Object();
    arrParams.ids = base64_decode(ids);
    arrParams.op='categoria';
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            var data = response.message;
            for (var i = 0; i < data.length; i++) {
                //alert(data[i]['nom_cat']);
                //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                strData += llenarCategorias(data[i]);
            }
            $("#listaCategorias").html(strData);
        }
    }, true);
    return false;
}

function llenarCategorias(data){
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
                        strData += '<ul>';
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

function verProducto(ids){
    var link = $('#txth_base').val() + "/site/productodetalle";
    parent.window.location.href = link + "?codigo="+ids;
}

/*OPCIONES DE LOGIN*/
function verificarIngreso() {
    var link = $('#txth_base').val() + "/site/login";
    var arrParams = new Object();
    arrParams.USER = base64_encode($('#txt_email').val());
    arrParams.PASS = base64_encode($('#txt_password').val());
    //arrParams.ACCION = accion;
    //var validation = validateForm();
    //if (!validation) {
        requestHttpAjax(link, arrParams, function (response) {
            var message = response.message;
            if (response.status == "OK") {
                showAlert(response.status, response.type, {"wtmessage": message.info, "title":response.label});
                //limpiarDatos();
                var renderurl = $('#txth_base').val() + "/mceformulariotemp/index";
                window.location = renderurl;
            } else {
                var renderurl = $('#txth_base').val() + "/site/login";
                window.location = renderurl;
                //showAlert(response.status, response.type, {"wtmessage": message.info, "title":response.label});
            }
        }, true);
    //}
    //showAlert('NO_OK', 'error', {"wtmessage": 'Debe Aceptar los términos de la Declaración Jurada', "title":'Información'});
}

function dataUser() {
    var datArray = new Array();
    var objDat = new Object();
    objDat.user = $('#txt_email').val();
    objDat.pass = $('#txt_password').val();
    datArray[0] = objDat;
    //sessionStorage.dataPersona = JSON.stringify(datArray);
    return datArray;
}


/*FIN OPCIONES DE LOGIN*/


