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


$(document).ready(function () {
    //buscarIndex();
    //buscarProductos(1,0);
    //mostrarCategoria(base64_encode('1'));
    
    /*$(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );*/
    
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );

    $("#categoria > li").click(function () {
        $("li").removeClass("active");
        $(this).addClass("active");
    });
    
    $("#subNivel > li").click(function () {
        $("li").removeClass("active");
        $(this).addClass("active");
    });
    
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
            scrollTitle: false, // Set a custom <a> title if requirSOBRE ed.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });



    $('.pagination li a').on('click', function () {
        //alert('Paginado');
        var page = $(this).attr('data');
        buscarProductos(page,0);
    });
    
    
    $('#cmd_login').click(function () {
        verificarIngreso();
    });
    
    $('#cmb_orden').change(function () {
        var page = $(this).attr('data');
        buscarProductos(page,0);
    });
    

});

function buscarIndex(){
    //alert(document.location);
    //alert('llego');
    var indexData=document.location;
    if(indexData.indexOf("index")>-1){//!=
        alert('encontro');
    }else{
        alert('no encontro');
    }
}

function buscarEnterProducto(valor,control){
    if (valor) {//Si el usuario Presiono Enter= True
         buscarProductos(0,0);
    }
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
                var renderurl = $('#txth_base').val() + "/site/index";
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

//$('.openBtn').on('click',function(){
    //alert('ingreso9');
    //$('.modal-body').load('nuevacuenta.php',function(){
        //$('#myModal').modal({show:true});
    //});
//});

function nuevaCuentaModal(){
    $('#loginModal').modal('hide');
    $('#registroModal').modal({show:true});
}
function loginModal(){    
    $('#loginModal').modal({show:true});
}


function menssajeModal(valor, tipo, body, title, accion, evento, op) {
    switch (op) {
        case '1':
            //alerta Normal
            var message = {
                "wtmessage": body,
                "title": title,
            };
            break;
        case '2':
            var message = {
                "wtmessage": body,
                "title": title,
                "acciones": [
                    {
                        "id": "btnl",
                        "class": "btn-primary clclass",
                        "value": accion,
                        "callback": evento, //guardafuncion
                    },
                ],
            };
            break;
        default:

    }
    showAlert(valor, tipo, message);
}

