/*
 * The PenBlu framework is free software. It is released under the terms of
 * the following BSD License.
 *
 * Copyright (C) 2015 by PenBlu Software (http://www.penblu.com)
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *  - Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 *  - Neither the name of PenBlu Software nor the names of its
 *    contributors may be used to endorse or promote products derived
 *    from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * PenBlu is based on code by
 * Yii Software LLC (http://www.yiisoft.com) Copyright © 2008
 */

$(document).ready(function () {
    $("body").on("keyup", ".keyupmce", function (event) {
        cadena = $(this).val().toUpperCase();
        $(this).val(cadena);
    });
    $('.btnAccion').click(function () {
        this.blur()
    });
    $('.skinSet').click(function () {
        var skin = $(this).attr("data-skin");
        change_skin(skin);
    });
    $('.pbpopup').magnificPopup({
        type: 'iframe',
        preloader: true,
    });
});
var pageValues = [];
var my_skins = [
    "skin-blue",
    "skin-black",
    "skin-red",
    "skin-yellow",
    "skin-purple",
    "skin-green",
    "skin-blue-light",
    "skin-black-light",
    "skin-red-light",
    "skin-yellow-light",
    "skin-purple-light",
    "skin-green-light"
];

/**
 * Replaces the old skin with the new skin
 * @param {string} cls the new skin class
 * @return {bool} false to prevent link's default action
 */
function change_skin(cls) {
    $.each(my_skins, function (i) {
        $("body").removeClass(my_skins[i]);
    });
    $("body").addClass(cls);
    return false;
}

/**
 Funcion para mostrar una notificacion Toastr
 @function createToastrNotification
 @author Eduardo Cueva <ecueva@penblu.com>
 @param {string} title              - Title Notification
 @param {string} message            - Message Notification
 @param {int}    type               - Type Notification. Example: success, info, warning, error. Default: success
 @param {bool}   closeButton        - Show close button. Default: true
 @param {bool}   newestOnTop        - Show new notification on top. Default: true
 @param {bool}   progressBar        - Show ProgressBar. Default: true
 @param {string} positionClass      - Show position of notificatios. Example: toast-top-right, toast-bottom-right, toast-bottom-left, toast-top-left, toast-top-full-width, toast-bottom-full-width, toast-top-center, toast-bottom-center. Default: toast-top-right.
 @param {string} preventDuplicates  - Prevent duplicates messages. Default: true.
 @param {string} onclick            - Function to execute with onclick event. Default: null
 @param {string} showDuration       - Default: 300.
 @param {string} hideDuration       - Default: 1000.
 @param {string} timeOut            - Default: 5000.
 @param {string} extendedTimeOut    - Default: 1000.
 @param {string} showEasing         - Default: "swing".
 @param {string} hideEasing         - Default: "linear".
 @param {string} showMethod         - Default: "fadeIn".
 @param {string} hideMethod         - Default: "fadeOut".
 **/
function createToastrNotification(
        title,
        message,
        type,
        closeButton,
        newestOnTop,
        progressBar,
        positionClass,
        preventDuplicates,
        onclick,
        showDuration,
        hideDuration,
        timeOut,
        extendedTimeOut,
        showEasing,
        hideEasing,
        showMethod,
        hideMethod)
{
    type = type || "success";
    closeButton = closeButton || true;
    newestOnTop = newestOnTop || true;
    progressBar = progressBar || true;
    positionClass = positionClass || "toast-top-right";
    preventDuplicates = preventDuplicates || true;
    onclick = onclick || null;
    showDuration = showDuration || "300";
    hideDuration = hideDuration || "1000";
    timeOut = timeOut || "5000";
    extendedTimeOut = extendedTimeOut || "1000";
    showEasing = showEasing || "swing";
    hideEasing = hideEasing || "linear";
    showMethod = showMethod || "fadeIn";
    hideMethod = hideMethod || "fadeOut";

    toastr.options = {
        closeButton: closeButton,
        newestOnTop: newestOnTop,
        progressBar: progressBar,
        positionClass: positionClass,
        preventDuplicates: preventDuplicates,
        showDuration: showDuration,
        hideDuration: hideDuration,
        timeOut: timeOut,
        extendedTimeOut: extendedTimeOut,
        showEasing: showEasing,
        hideEasing: hideEasing,
        showMethod: showMethod,
        hideMethod: hideMethod
    };
    if (onclick != undefined) {
        toastr.options.onclick = function () {
            eval(onclick + '()');
        };
    }
    toastr[type](message, title);
}

/**
 Funcion realizada para combo anidados
 @function setComboData
 @author Eduardo Cueva
 @param {object}  arr_data   - Arreglo de objetos de tipo clave => valor
 @param {integer} element_id - Elemento en donde se va a agregar el contenido del arreglo
 **/
function setComboData(arr_data, element_id) {
    var option_arr = "";
    //option_arr += "<option value='0'> Seleccionar</option>";
    for (var i = 0; i < arr_data.length; i++) {
        var id = arr_data[i].id;
        var value = arr_data[i].name;

        option_arr += "<option value='" + id + "'>" + value + "</option>";
    }
    $("#" + element_id).html(option_arr);
}
/**
 Funcion para mostrar popup de carga de la información
 @function showLoadingPopup
 @author Eduardo Cueva
 @param  {string} str_message - Mensaje que de muestra en el popup de carga de información
 @param  {string} ref - referencia de elemento. Ejemplo: .element o #element
 **/
function showLoadingPopup(str_message, ref) {
    if (!str_message) {
        //str_message = "<div class='growlUI'></div>";
        str_message =
                "<div>" +
                "<div id='circularG'>" +
                "<div id='circularG_1' class='circularG'></div>" +
                "<div id='circularG_2' class='circularG'></div>" +
                "<div id='circularG_3' class='circularG'></div>" +
                "<div id='circularG_4' class='circularG'></div>" +
                "<div id='circularG_5' class='circularG'></div>" +
                "<div id='circularG_6' class='circularG'></div>" +
                "<div id='circularG_7' class='circularG'></div>" +
                "<div id='circularG_8' class='circularG'></div>" +
                "</div>" +
                "</div>";
        str_message2 = "<div><img src='" + $("#txth_base").val() + "/img/bg/loadingSite.gif'></div>";
        str_message3 =
                '<div id="circleG">' +
                '<div id="circleG_1" class="circleG"></div>' +
                '<div id="circleG_2" class="circleG"></div>' +
                '<div id="circleG_3" class="circleG"></div>' +
                '</div>';
    }
    if (ref) {
        $(ref).block({
            message: str_message2,
            css: {
                border: 'none',
                backgroundColor: 'none',
                color: '#fff'
            },
            // styles for the overlay
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.2,
                cursor: 'wait'
            },
        });
    } else {
        $.blockUI({
            message: str_message, //'<div class="growlUI"><h1>Growl Notification</h1><h2>Have a nice day!</h2></div>',//$('div.growlUI'),
            //fadeIn: 700,
            //fadeOut: 700,
            //timeout: 2000,
            showOverlay: false,
            centerY: false,
            css: {
                width: '200px',
                margin: '-42px 0px 0px -100px', //agregado
                /*height: '84px',*/ //agregado
                top: '50%', //'10px',
                left: '50%', //'',
                //right: '10px',
                border: 'none',
                padding: '5px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .6,
                color: '#fff'
            }
        });
    }
}
/**
 Funcion para mostrar popup con un progressBar
 @function showLoadingProgressBar
 @author Eduardo Cueva
 @param  {string} reference  - Referencia de Elemento ID. Default: progressBar
 @param  {string} htmlData   - Data Adicional como cabecera de mensaje
 @param  {int}    width      - Width del popup. Default: 400
 @param  {int}    height     - Height del Popup. Default: 84
 @param  {int}    opacity    - Atributo Opacity css. Default: 0.6
 @param  {string} style      - Clase o estilo del progressBar, valores que se pueden elegir: PG_default, PB_big-green, PB_jquery-ui-like, PB_round-pink, PB_tiny-green
 @param  {string} head_title - Titulo de la ventana que aparece como progressBar.
 **/
function showLoadingProgressBar(reference, htmlData, width, height, opacity, head_title, style) {
    reference = reference || "progressBar";
    htmlData = htmlData || "";
    head_title = head_title || objLang.Sending_File;
    width = width || 400;
    height = height || 84;
    opacity = opacity || 0.6;
    var marginX = width / 2;
    var marginY = height / 2;
    style = style || "PB_default"; // PG_default, PB_big-green, PB_jquery-ui-like, PB_round-pink, PB_tiny-green
    var str_message = "<h4>" + head_title + "</h4>";
    str_message += htmlData;
    str_message += "<div id='" + reference + "' class='" + style + "'><div></div></div>";
    $.blockUI({
        message: str_message, //'<div class="growlUI"><h1>Growl Notification</h1><h2>Have a nice day!</h2></div>',//$('div.growlUI'),
        //fadeIn: 700,
        //fadeOut: 700,
        //timeout: 2000,
        showOverlay: false,
        centerY: false,
        css: {
            width: width + 'px',
            margin: '-' + marginY + 'px 0px 0px -' + marginX + 'px', //agregado
            height: height + 'px', //agregado
            top: '50%', //'10px',
            left: '50%', //'',
            //right: '10px',
            border: 'none',
            padding: '5px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: opacity,
            //color: '#fff' //Si el background es blanco entonces el color de la fuente deber ser el default (Negro)
        }
    });
}
/**
 Funcion para ocultar popup de carga de la información
 @function showLoadingPopup
 @author Eduardo Cueva
 @param  {string} ref - referencia de elemento. Ejemplo: .element o #element
 **/
function hideLoadingPopup(ref) {
    if (ref) {
        $(ref).unblock();
    } else {
        $.unblockUI();
    }
}
/**
 * ProgressBar for jQuery
 *
 * @version 1 (29. Dec 2012)
 * @author Ivan Lazarevic
 * @requires jQuery
 * @see http://workshop.rs
 *
 * @param  {Number} percent  percent of loading.
 * @param  {Number} $element progressBar DOM element.
 * @param  {Number} time     number determining how long the animation will run.
 */
function progressBar(percent, $element, time) {
    time = time | 0;
    var progressBarWidth = percent * $element.width() / 100;
    $element.find('div').animate({
        width: progressBarWidth
    }, time).html(percent + "%&nbsp;");
}

var current_setTimeout = null;
/**
 Funcion para atender peticiones ajax de manera asincronica con timer en el servidor
 @function requestHttpAjax
 @author Eduardo Cueva
 @param  {string} link         - Url del sitio a pedir informacion
 @param  {string} arrParams    - Arreglo de parametros que iran como parte de la peticion cuyo formatodebe ser: { dato1: 'value1', dato2: 'value2' } o un Objeto
 @param  {string} callback     - Funcion callback que se ejecuta luego de recibir correctamente la informacion de el servidor. Default = null
 @param  {string} recursive    - Si es true entonces permite que el ajax espere siempre por una respuesta del servidor es decir que sea recursivo. Default = null
 @param  {bool}   isUploadFile - Si es true entonces se puede enviar como parte de los datos un archivo adjunto por ajax.
 @param  {string} dataTypeRxst - El tipo de formatos a recibir en el ajax. Default = json.
 @param  {string} typeRxst     - Tipo de Peticion: Default = POST
 @param  {string} asyncRxst    - Si ajax es asincrono o sincrono. Default = true
 @param  {bool}   loading      - Muestra el LoadingPopup. Default = true
 @param  {string} usernameRxst - Usuario si se utiliza credenciales de autenticacion en el servidor.
 @param  {string} passwordRxst - Password si se utiliza credenciales de autenticacion en el servidor.
 **/
function requestHttpAjax(link, arrParams, callback, loading, isUploadFile, dataTypeRxst, typeRxst, recursive, asyncRxst, usernameRxst, passwordRxst)
{
    callback = callback || null;
    recursive = recursive || null;
    asyncRxst = asyncRxst || true;
    //loading  = loading || false;
    typeRxst = typeRxst || 'POST';
    dataTypeRxst = dataTypeRxst || 'json';
    usernameRxst = usernameRxst || null;
    passwordRxst = passwordRxst || null;
    isUploadFile = isUploadFile || false;

    arrParams.rqsClient = BrowserDetect.browser;
    arrParams.rqsVersion = BrowserDetect.version;
    arrParams.rqsOS = BrowserDetect.OS;
    arrParams.getDataGM = pageValues;

    var jsonpRxst = false;
    var crossDomain = false;
    var contentType = 'application/x-www-form-urlencoded';
    var processData = true;

    if (dataTypeRxst == "jsonp") {
        jsonpRxst = true;
        crossDomain = true;
    }
    if (!recursive) {
        if (loading) {
            showLoadingPopup(null);
        }
    }
    if (isUploadFile) {
        contentType = false;
        processData = false;
    }
    // Comienza peticion por ajax
    //if (typeof jQuery.sessionTimeout == 'function') {
    //    jQuery.sessionTimeout.clearSessionTimeOut(); // Se resetea la session
    //}
    $.ajax({
        async: asyncRxst,
        cache: false,
        type: typeRxst, //POST, GET, PUT y DELETE
        dataType: dataTypeRxst, //text, xml, json, script, html o jsonp si se quiere utilizar cross-domain
        url: link,
        processData: processData,
        crossDomain: crossDomain, // es true solo si dataType = jsonp
        jsonp: jsonpRxst, // si dataType es jsonp
        jsonpCallback: 'onGMJSONPLoad', // si dataType es jsonp
        contentType: contentType, //'application/json; charset=utf-8', multipart/form-data // se setea el content type
        username: usernameRxst, //si existe autenticacion de tipo XMLHttpRequest para http
        password: passwordRxst, //si existe autenticacion de tipo XMLHttpRequest para http
        data: arrParams,
        success: function (dataResponse) {
            var stop_recursive = false;
            if (callback) {
                stop_recursive = callback(dataResponse); // como feature poder agregar parametros a funcion callback -- si se retorna false => se sigue con la recursividad si es true finaliza la recursividad
            } else {
                if (recursive)
                    stop_recursive = true;
            }
            if (dataResponse) {
                if (recursive && !stop_recursive) {
                    current_setTimeout = setTimeout(
                            function () {
                                requestHttpAjax(link, arrParams, callback, loading, dataTypeRxst, typeRxst, recursive, asyncRxst, usernameRxst, passwordRxst)
                            }, 200);   //la funcion espera 200ms para ejecutarse,pero la funcion actual si se termina de ejecutar,creando un hilo.
                }
            } else {
                console.log(objLang.Problem_with_objHttpRequest);
            }
            if (!recursive)
                hideLoadingPopup();
        },
        beforeSend: function () {
        },
        error: function (objXMLHttpRequest) {
            var msg = objLang.Problem_with_request_or_your_session_has_ended;
            console.log(msg + ': ' + objXMLHttpRequest);
            if (!recursive)
                hideLoadingPopup();
            if (objXMLHttpRequest.status == 200 && objXMLHttpRequest.readyState == 4)
                resetSession(msg, objLang.Error, "error", "goHome");
        },
        statusCode: {
            301: function () {
                var msg = objLang.Page_moved_permanently;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            302: function () {
                var msg = objLang.Page_moved_temporarily;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            400: function () {
                var msg = objLang.Bad_Request;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            401: function () {
                var msg = objLang.You_must_be_authorized_to_view_this_page;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            402: function () {
                var msg = objLang.Payment_required;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            403: function () {
                var msg = objLang.Forbidden;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            404: function () {
                var msg = objLang.Page_not_found;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            405: function () {
                var msg = objLang.Method_not_allowed;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            406: function () {
                var msg = objLang.Not_acceptable;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            500: function () {
                var msg = objLang.The_server_encountered_an_error_processing_your_request;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            501: function () {
                var msg = objLang.The_requested_method_is_not_implemented;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            502: function () {
                var msg = objLang.Bad_Gateway;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            503: function () {
                var msg = objLang.Service_not_available;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            504: function () {
                var msg = objLang.Timeout_exhausted_gateway;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            505: function () {
                var msg = objLang.HTTP_version_unsupported;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            506: function () {
                var msg = objLang.Variant_also_negotiates;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            507: function () {
                var msg = objLang.Insufficient_Storage;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            },
            509: function () {
                var msg = objLang.Bandwidth_Limit_Exceeded;
                console.log(msg + ': ' + link);
                if (!recursive)
                    hideLoadingPopup();
            }
        }
    });
}

function existsRequestRecursive()
{
    return (current_setTimeout) ? true : false;
}

function clearResquestRecursive()
{
    clearTimeout(current_setTimeout);
}

function showResponse(type, status, label, message) {
    switch (type) {
        case "alert":
            showAlert(status, label, message);
            break;
    }
}
/* example from controller message
 $message = array(
 "wtmessage" => "Message from controller",
 "title" => "Message alert title",
 "acciones" => array( // buttons
 array(
 "id" => "btnid",
 "class" => "btn-primary clclass",
 "value" => "prueba",
 "callback" => "example",
 "paramCallback" => array("var1","var2")
 ),
 array(
 "id" => "btnid2",
 "class" => "clclass",
 "value" => "prueba2",
 "callback" => "example"
 ),
 array(
 "id" => "btnid3",
 "class" => "praclose",
 "value" => "Close",
 "callback" => "example"
 ),
 ),
 "htmloptions" => array(
 "class" => "modal",
 "id" => "modalid",
 "style" => array("width" => "390px"),
 ),
 );
 */
function showAlert(status, label, message) {
    var idModal = "#myModalPB";
    var wtmessage = message.wtmessage;
    var titlemsg = message.title;
    var btnAcciones = message.acciones;
    var btnCloseDef = message.closeaction;
    var callback = "";
    var callbackfn = "";
    var cont = 0;

    // se rellena el contenido del alert
    $(idModal + ">div>div>div.modal-body").html("");
    $(idModal + ">div>div>div.modal-body").html(wtmessage);

    // se rellena el contenido del titulo
    $(idModal + ">div>div>div.modal-header>h4").html("");
    $(idModal + ">div>div>div.modal-header>h4").html(titlemsg);

    // se realiza la funcionalidad del boton close por defecto
    $(idModal + ">div>div>div.modal-footer>button:first-child").text(objLang.Cancel);
    $(idModal + ">div>div>div.modal-footer>button:first-child").removeAttr("onclick");
    if (btnCloseDef) {
        for (i = 0; i < btnCloseDef.length; i++) {
            var objCl = btnCloseDef[i];
            if (objCl['callback'] != "") {
                var arrCbcl = new Object();
                arrCbcl = objCl['paramCallback'];
                if (arrCbcl) {
                    var paraml = "";
                    for (j = 0; j < arrCbcl.length; j++) {
                        if (j == 0)
                            paraml += arrCbcl[j];
                        else
                            paraml += ", " + arrCbcl[j];
                    }
                    callbackfn = btnCloseDef[i].callback + "(" + paraml + ")";
                } else
                    callbackfn = btnCloseDef[i].callback + "()";
            }
        }
        $(idModal + ">div>div>div.modal-footer>button:first-child").attr("onclick", callbackfn);
    }
    // se eliminar los demas botones
    $(idModal + ">div>div>div.modal-footer>button").each(function () {
        if (cont != 0) {
            $(this).remove();
        }
        cont++;
    });
    // se realiza la funcionalidad de los botones adicionales
    if (btnAcciones) {
        var botones = "";
        for (i = 0; i < btnAcciones.length; i++) {
            var objAcc = btnAcciones[i];
            callback = "";
            if (objAcc['callback'] != "" && objAcc['callback']) {
                var arrCbck = new Object();
                arrCbck = objAcc['paramCallback'];
                if (arrCbck) {
                    var param = "";
                    for (j = 0; j < arrCbck.length; j++) {
                        if (j == 0)
                            param += arrCbck[j];
                        else
                            param += ", " + arrCbck[j];
                    }
                    callback = " onclick='" + btnAcciones[i].callback + "(" + param + ")' ";
                } else
                    callback = " onclick='" + btnAcciones[i].callback + "()' ";
            }
            botones += "<button type='button' id=" + btnAcciones[i].id + " class='btn btn-primary " + btnAcciones[i].class + "' data-dismiss='modal'  " + callback + ">" + btnAcciones[i].value + "</button>";
        }
        $(idModal + ">div>div>div.modal-footer").append(botones);
    } else {
        // no hay botones
        $(idModal + ">div>div>div.modal-footer>button:first-child").text(objLang.Accept);
    }
    // colocando el tipo de alerta
    var evalabel = label.toLowerCase();
    if (status == "OK") {
        if (evalabel == "success" || objLang.Success == label) {
            evalabel = "success";
        } else {
            evalabel = "info";
        }
    } else {
        if (evalabel == "error" || objLang.Error == label) {
            evalabel = "error";
        } else {
            evalabel = "warning";
        }
    }
    $(idModal + ">div.modal-dialog>div.modal-content>div.modal-header>span#img-modal").attr("class", evalabel + "-modalPB");

    //execute modal
    $(idModal).modal();
}

function showClockTime() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];
    if (!document.layers && !document.all && !document.getElementById)
        return;

    var Digital = new Date();
    var hours = Digital.getHours();
    var minutes = Digital.getMinutes();
    var seconds = Digital.getSeconds();
    var month = monthNames[Digital.getMonth()];//objLang[monthNames[Digital.getMonth()]];
    var day = Digital.getDate();
    var year = Digital.getFullYear();
    var dn = "PM";
    if (hours < 12)
        dn = "AM";
    if (hours > 12)
        hours = hours - 12;
    if (hours == 0)
        hours = 12;
    if (minutes <= 9)
        minutes = "0" + minutes;
    if (seconds <= 9)
        seconds = "0" + seconds;
    if (day <= 9)
        day = "0" + day;

    $(".pbtimebox>a>span>span:nth-child(1)").text(hours);
    $(".pbtimebox>a>span>span:nth-child(2)").text(":");
    $(".pbtimebox>a>span>span:nth-child(3)").text(minutes);
    $(".pbtimebox>a>span>span:nth-child(4)").text(dn);
    $(".pbtimebox>a>span>span:nth-child(5)").text(day + " " + month + " " + year);
    setTimeout("showClockTime()", 1000);
}


function searchIdByObject(obj, key) {
    for (var i = 0; i < obj.length; i++) {
        var item = obj[i];
        if (item.search(key) != -1) {
            item = item.replace(key, "");
            return item;
        }
    }
    return 0;
}

function reloadPage() {
    location.reload();
}

function generatePassword() {
    var ramdonPass = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!¡@#$&/()=?¿-+*^{}[]";
    var newpass = "";
    for (var i = 0; i < 10; i++)
        newpass += ramdonPass.charAt(Math.floor(Math.random() * ramdonPass.length));
    return newpass;
}

//storagedata
//storagedata.elementId
//storagedata.elementId.data = array index 0,1,2,3,... value array index 0,1,2,3,...
//storagedata.elementId.label = array index 0,1,2,3,... value array index column0,column2,column2,column3,...
//storagedata.elementId.btnactions = array index 0,1,2,3,... value is object {id, href, onclick, title, class, tipo_accion} 
//storagedata.elementId.trmessage
function addItemGridContent(elementId) {
    var storage = sessionStorage.getItem(elementId);
    var arr_data = JSON.parse(storage);
    var size_arr = arr_data.data.length;
    var size_btn = arr_data.btnactions.length;
    var arr_btn = arr_data.btnactions;
    var sizeCol = getSizeColumnsGrid(elementId);
    var trs = "";
    if (size_arr > 0) {
        $('#' + elementId + ' >table >tbody').html(""); // seteando todo el tbody a vacio
        for (var i = 0; i < size_arr; i++) {
            trs += "<tr data-key='" + arr_data.label[i][0] + "'>";
            for (var j = 0; j < sizeCol - 1; j++) {
                if (j != 0)
                    trs += "<td>" + arr_data.label[i][j] + "</td>";
                else
                    trs += "<td>" + (i + 1) + "</td>";
            }
            if (size_btn > 0) {
                trs += "<td style='text-align: center;'>";
                for (var j = 0; j < arr_btn[i].length; j++) {//size_btn[i][j]
                    var onclick = ((arr_btn[i][j].onclick).trim() != "") ? arr_btn[i][j].onclick : "javascript:";
                    var href = ((arr_btn[i][j].href).trim() != "") ? arr_btn[i][j].href : "javascript:";
                    var cclass = getIcon(arr_btn[i][j].tipo_accion) + " " + arr_btn[i][j].class;
                    var title = arr_btn[i][j].title;
                    var id = arr_btn[i][j].id + "_" + j;
                    trs += "<a id='" + id + "' href='" + href + "' data-toggle='tooltip' data-original-title='" + title + "' ><span class='" + cclass + "'></span></a>";
                }
                trs += "</td>";
            } else {
                trs += "<td></td>";
            }
            trs += "</tr>";
        }
        $('#' + elementId + ' >table >tbody').html(trs);
    } else { // se llena el tbody con la variable sessionStorage trmessage que contiene el mensaje que indica que no hay datos en el grid
        if (storage.trmessage != "")
            $('#' + elementId + ' >table >tbody').html(storage.trmessage);
        else {
            var trmessage = "<tr>";
            var colspan = $('#' + elementId + ' >table >thead > tr > td').length;
            trmessage += "<td colspan='" + colspan + "'>" + objLang.No_data_found + "</td></tr>";
        }
    }
}

function getSizeColumnsGrid(elementId) {
    var size = 0;
    $('#' + elementId + ' >table >thead >tr >th').each(function () {
        size++;
    });
    return size;
}

function getIcon(icon) {
    var iconCss = "";
    switch (icon) {
        case 'delete':
            iconCss = 'glyphicon glyphicon-remove';
            break;
        case 'view':
            iconCss = 'glyphicon glyphicon-eye-open';
            break;
        case 'edit':
            iconCss = 'glyphicon glyphicon-pencil';
            break;
        default:
            iconCss = 'glyphicon glyphicon-tasks';
            break;
    }
    return iconCss;
}

function createActionGrid(id, href, title, className, type) {
    var actionHtml = '<a id="' + id + '" href="' + href + '" title="" data-toggle="tooltip" data-original-title="' + title + '">';
    actionHtml += '<span class="' + getIcon(type) + '"></span></a>';
}

function removeItemGridContent(elementId, indice, callback) {
    callback = callback || null;
    var storage = sessionStorage.getItem(elementId);
    var arr_data = JSON.parse(storage);
    var size_arr = arr_data.data.length;
    var newarr_data = new Array();
    var j = 0;
    for (var i = 0; i < size_arr; i++) {
        if (arr_data.data[i][0] != indice) {
            arr_data.data[i][0] = elementId + "_" + j;
            newarr_data[j] = arr_data.data[i];
            j++;
        }
    }
    arr_data.data = newarr_data;
    sessionStorage[elementId] = JSON.stringify(arr_data);
    addItemGridContent(elementId);
    callback();
}

function loadSessionCampos(elementId, data, btnactions) {
    sessionStorage.removeItem(elementId);
    var arrData = new Object();
    arrData.data = data;
    arrData.btnactions = btnactions;
    sessionStorage[elementId] = JSON.stringify(arrData);
    var sizetheadtb = $('#' + elementId + ' >table >thead >tr >th').length;
    var sizetbodytb = $('#' + elementId + ' >table >tbody >tr >td').length;
    if (sizetheadtb > sizetbodytb) { // si las columnas de las cabecera son mayores que las columnas del cuerpo entonces se debe guardar el primer tr que contiene el mensaje que la tabla esta vacia
        var trmessage = $('#' + elementId + ' >table >tbody').html();
        arrData.trmessage = trmessage;
        sessionStorage[elementId] = JSON.stringify(arrData);
    }
}

/**
 Funcion para mostrar un mensaje de alerta cuando hay un error
 @function resetSession
 @author Eduardo Cueva
 @param  {string} message   - Url del sitio a pedir informacion
 @param  {string} label     - Es la etiqueta de la imagen en la alerta. Esta puede ser {error, info, success, warning}
 @param  {string} status    - Status de la accion. Los valores pueden ser {error, info, warning, ok}
 @param  {string} callback  - Funcion a ejecutar
 @param  {string} lblAccept - Nombre del boton que se va a mostrar
 @param  {object} style     - Objecto con las varibles estilo que se desean que esten en el alert. Ejemplo: messageGM.htmloptions.style.width
 */
function resetSession(message, label, status, callback, lblAccept, style) {
    var messagePB = new Object();
    messagePB.wtmessage = message;
    messagePB.title = label;
    var objAcciones = new Object();
    objAcciones.id = "btnid2alert";
    objAcciones.class = "btn-primary clclass praclose";
    lblAccept = lblAccept || null;
    if (lblAccept)
        objAcciones.value = lblAccept;
    else
        objAcciones.value = objLang.Accept;
    callback = callback || null;
    if (callback)
        objAcciones.callback = callback;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAcciones;
    style = style || null
    if (style) {
        messagePB.htmloptions = new Object();
        messagePB.htmloptions.style = style;
    }
    showAlert(status, label, messagePB);
}

function searchIdByObject(obj, key) {
    for (var i = 0; i < obj.length; i++) {
        var item = obj[i];
        if (item.search(key) != -1) {
            item = item.replace(key, "");
            return item;
        }
    }
    return 0;
}

function confirmDelete(callback, params, message, title) {
    params = params || null;
    var messagePB = new Object();
    messagePB.wtmessage = message || objLang.Are_you_sure_you_want_to_delete_this_record_;
    messagePB.title = title || objLang.Delete;
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-danger clclass praclose";
    objAccept.value = title || objLang.Delete;
    objAccept.callback = callback;
    if(params){
        objAccept.paramCallback = params;
    }
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert('OK', 'info', messagePB);
}

function goHome() {
    window.location = $('#txth_base').val();
}

window.onload = showClockTime;
