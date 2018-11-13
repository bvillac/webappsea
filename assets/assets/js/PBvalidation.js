/* 
 Libreria que permite el proceso de validación de formularios 
 @author Eduardo Cueva ecueva@penblu.com 
 test: http://www.regexpal.com/ https://www.addedbytes.com/download/?file=regular-expressions-cheat-sheet-v2/png/
 */
/* variable globales Upload */
var FileIdioma = "es";
var FileExtensions = ['jpg', 'png', 'pdf'];
var browseLabel = " Examinar..";
var FileSize = 1024;
var nsegundos = 3000;//3000ms = 3s
/* variable globales */
var ico = new Object();
ico.hidden = {
    'background-position': '113%'
};
ico.visible = {
    'background-position': '98%'
};

/*  VALIDA LA CLASE EN PBvalidation CADA EVENTO DEL CONTROL data-type  */
$(function () {
    $("body").on("keyup", ".PBvalidation", function (event) {
        if ($(this).attr('data-required') != undefined || $(this).attr('data-required') != "true") {
            if (($(this).attr('data-keydown') != undefined) && ($(this).attr('data-keydown') == "true")) {
                var result = new Object();
                result = validateType($(this).attr('data-type'), $(this).val(), this);
                var message = result.errorMessage;
                setInitPositionIco(this, ico);
                setIconValidator(this, result.response, result.errorMessage, true);
                if (!result.response) {
                    var type = "wtalert";
                    var label = "error";
                    var status = "OK";
                    var messagew = {
                        "wtmessage": message,
                        "acciones": [{
                                "id": "btnalert",
                                "class": "btn-primary clclass praclose",
                                "value": objLang.Accept
                            }]
                    };
                    //showResponse(type, status, label, messagew);
                }
            } else {
                hideIcons($(this));
            }
        }
    });

    $('body').on("keyup", ".PBvalidationField", function (event) {
        if ($(this).attr('data-required') != undefined || $(this).attr('data-required') != "true") {
            if ($(this).attr('data-type') != undefined) {
                var isNumber = true;
                if (($(this).attr('data-type') != "number") || ($(this).attr('data-type') != "fecha"))
                    isNumber = false;
                patronDate = $(this).attr('data-patron');
                var objData = getPatron(patronDate);
                mascara(this, objData.separador, objData.patron, isNumber);
            }
        }
    });

});

/*
 * Valida la Entrada del Enter
 */
function isEnter(e) {
    //retornar verdadereo si presiona Enter
    var key;
    if (window.event) // IE
    {
        key = e.keyCode;
        if (key == 13 || key == 9) {
            return true;
        }
    } else if (e.which) { // Netscape/Firefox/Opera
        key = e.which;
        // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
        //var key = nav4 ? evt.which : evt.keyCode;	
        if (key == 13 || key == 9) {
            return true;
        }
    }
    return false;
}

/*
 Tipos de parametros:
 TIPO			DEFAULT			DESCRIPCION
 data-type     		alfanumerico		identifica el tipo de validacion
 data-keydown  		false			si es true => se ejecuta evento keydown
 data-lengthMax    	10			es el numero de caracteres Máximo
 data-lengthMin    	0			es el numero de caracteres Mínimo
 data-required	        true			si el campo es requerido o no
 data-patron		"Y-m-d"			El patron que se debe utilizar para la validacion
 
 Faltan implementar la solucion con elementos de tipo "select", "radio", "check"
 
 */
function validateType(type, valor, ref) {
    var result = new Object();
    var result2 = new Object();
    result.response = false;
    result.errorMessage = "";
    var sizeMax = false;
    var sizeMin = false;
    var fecha_recepta = valor;
            var fecha_actual = new Date();
            var dd = fecha_actual.getDate();
            var mm = fecha_actual.getMonth() + 1; //hoy es 0!
            var yyyy = fecha_actual.getFullYear();

            if (dd < 10) {
                dd = '0' + dd
            }

            if (mm < 10) {
                mm = '0' + mm
            }
            fecha_actual = yyyy+'-'+mm+'-'+dd; 
    if ($(ref).attr('data-required') == "false") {
        if ($(ref).val() == "") {
            removeIco(ref);
            return;
        }
    }

    if ($(ref).attr('data-lengthMax') != undefined) {
        var tmpMax = $(ref).attr('data-lengthMax');
        if (tmpMax.match(new RegExp(/\d+$/)))
            sizeMax = $(ref).attr('data-lengthMax');
        else
            sizeMax = 10;
    }

    if ($(ref).attr('data-lengthMin') != undefined) {
        var tmpMin = $(ref).attr('data-lengthMin');
        if (tmpMin.match(new RegExp(/\d+$/)))
            sizeMin = $(ref).attr('data-lengthMin');
        else
            sizeMin = 1;
    }
    if (valor == "" && type != "") {
        result.response = false;
        result.errorMessage = objLang.The_field_must_not_be_empty_;
        return result;
    }
    switch (type) {
        case 'number'://solo numeros
            result.response = validarExpresion(/^(?:\+|-)?\d+$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Only_allow_numbers_;
            }
            break;
        case 'alfa'://solo letras
            result.response = validarExpresion(/^([a-zA-ZáéíóúÁÉÍÓÚÑñ '])+$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Only_allowed_to_enter_letters_;
            }
            break;
        case 'alfanumerico':
            result.response = validarExpresion(/^([a-zA-Z áéíóúÁÉÍÓÚÑñ0-9])+$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Only_allowed_to_enter_letters_and_numbers_;
            }
            break;
        case 'direccion':
            result.response = validarExpresion(/^([a-zA-Z áéíóúÁÉÍÓÚÑñ0-9 ./-])+$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Only_allowed_to_enter_letters_and_numbers_;
            }
            break;
        case 'cedula':
            result.response = validarDocumento(valor);
            if (!result.response) {
                result.errorMessage = objLang.The_dni_is_incorrect;
            }
            break;
        case 'email'://email        
            result.response = validarExpresion(/^[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}$/, valor); // /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            if (!result.response) {
                result.errorMessage = objLang.The_email_field_does_not_have_a_correct_format_;
            }
            break;
        case 'telefono':
            result.response = validarExpresion(/^(((\d{6,9}[ ]?\/[ ]?)(\d{6,9}[ ]?\/[ ]?)*\d{6,9})|(\d{6,9}))$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;
        case 'telefono_sin':
            result.response = validarExpresion(/^((\d{7}))$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;
        case 'celular':
            result.response = validarExpresion(/^(((\d{9,13}[ ]?\/[ ]?)(\d{9,10}[ ]?\/[ ]?)*\d{9,13})|(\d{9,13}))$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;
        case 'celular_sin':
            result.response = validarExpresion(/^((\d{10}))$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;

        case 'dinero':
            result.response = validarExpresion(/^((\d{1,9})(\.\d{1,2})?)$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Only_numbers_and_decimal_point_for_;
            }
            break;
        case 'fecha':
            result.response = validarExpresion(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/, valor); // Eduardo Cueva. Cambiar mas adelante 
            if (!result.response) {
                result.errorMessage = objLang.Not_valid__the_format_is_yyyy_mm_dd__for_example_2012_12_24_;
            }
            break;
        case 'graduacion':
            result.response = validarExpresion(/^(19|20)\d\d$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;
        case 'numeracion_mi':
            result.response = validarExpresion(/^((\d{1,2}))$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;
        case 'numeracion':
            result.response = validarExpresion(/^((\d{1,5}))$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_phone_number_;
            }
            break;
        case 'tiempo':
            result.response = validarExpresion(/^(0[1-9]|1\d|2[0-3]):([0-5]\d)$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_time;
            }
            break;
        case 'fecha_rec':                      
            if (fecha_recepta <= fecha_actual)
            {
                result.response = validarExpresion(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/, valor);
            }
            if (!result.response) {
                result.errorMessage = objLang.The_reception_date_can_not_be_after_the_today + fecha_actual;
            }
            break;
        case 'fecha_aten':
            var fecha_atiende = valor;
            if (fecha_atiende >= $('#txt_fecha_recepcion').val())
            {
                result.response = validarExpresion(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/, valor);
            }
            if (!result.response) {
                result.errorMessage = objLang.The_attention_date_can_not_be_before_the_reception_date_or_today;
            }
            break;
        case 'fecha_pro':
            var fecha_proxima = valor;
            if (fecha_proxima >= $('#txt_fecha_atencion').val())
            {
                result.response = validarExpresion(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/, valor);
            }
            if (!result.response) {
                result.errorMessage = objLang.The_next_date_can_not_be_before_the_attention_date;
            }
            break;
        case 'url':
            result.response = validarExpresion(/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/, valor);
            if (!result.response) {
                result.errorMessage = objLang.Invalid_url_;
            }
            break;
        default:// all
            result.response = validarExpresion(/^(.|\n)+$/, valor);
            if (!result.response) {
                result.errorMessage = objLang.The_field_must_not_be_empty_;
            }
            break;
    }
    result2 = validateSize(sizeMax, sizeMin, valor);
    if (!result2.response) {
        result.response = result2.response;
        result.errorMessage += " " + result2.errorMessage;
    }
    return result;
}

function validarExpresion(cadena, valor) {
    var expresion = new RegExp(cadena);
    if (valor.match(expresion)) {
        return true;
    } else {
        return false;
    }
}

function validateSize(sizeMax, sizeMin, valor) {
    var result = new Object();
    result.response = true;
    result.errorMessage = "";
    var message = "";
    if (sizeMax && sizeMin) {
        if (valor.length > sizeMax || valor.length < sizeMin) {
            result.response = false;
            if (sizeMin == sizeMax) {
                message = objLang.You_must_enter_only__sizeMin__characters_;
                console.log(message);
                message = message.replace(/\{sizeMin\}/g, sizeMin);
            } else {
                message = objLang.The_character_range_is_between__sizeMin__and__sizeMax__;
                message = message.replace(/\{sizeMin\}/g, sizeMin);
                message = message.replace(/\{sizeMax\}/g, sizeMax);
            }
        }
    } else {
        if (sizeMax) {
            if (valor.length > sizeMax) {
                result.response = false;
                message = objLang.Maximum__sizeMax__characters_;
                message = message.replace(/\{sizeMax\}/g, sizeMax);
            }
        } else {
            if (sizeMin)
                if (valor.length < sizeMin) {
                    result.response = false;
                    message = objLang.At_least__sizeMin__characters_;
                    message = message.replace(/\{sizeMin\}/g, sizeMin);
                }
        }
    }
    result.errorMessage = message;
    return result;
}

function validateForm(widthAlert) {
    var message = "";
    var stresponse = false;
    widthAlert = widthAlert || null;
    $(".PBvalidation").each(function () {
        var result = new Object();
        noVal:
                if ($(this).attr('data-required') == "false" && $(this).val() == "") {
            if ($(this).val() == "") {
                removeIco(this);
                break noVal;
            }
        } else {
            if (($(this).attr('data-required') != undefined) || $(this).attr('data-required') != 'true') {
                removeIco(this);
                if ($(this).attr('data-callback') != undefined)
                    result = executeCallback($(this), $(this).attr('data-callback'));
                else {
                    if ($(this).attr('data-type') == undefined) {
                        result = validateType("all", $(this).val(), this); // valor por defecto alfa
                    } else
                        result = validateType($(this).attr('data-type'), $(this).val(), this);
                }
                setIconValidator(this, result.response, result.errorMessage, false);
                if (!result.response) { // si devuelve false puede ser que no pasa etapa de validacion o no hay nada que validar
                    stresponse = true;
                    var fieldId = $(this).attr("id");
                    var labeltxt = $("label[for='" + fieldId + "']").text();
                    message += "<b>" + labeltxt + ":</b> " + result.errorMessage + "<br />";
                }
            }
        }
    });
    if (stresponse) {
        var type = "alert";
        var label = "error";
        var status = "NO_OK";
        var messagew = {};
        if (widthAlert) {
            messagew = {
                "wtmessage": message,
                "title": objLang.Error,
                "acciones": [{
                        "id": "btnalert",
                        "class": "btn-primary clclass praclose",
                        "value": objLang.Accept
                    }],
                "htmloptions": {
                    "style": {
                        "width": widthAlert
                    },
                },
            };
        } else {
            messagew = {
                "wtmessage": message,
                "title": objLang.Error,
                "acciones": [{
                        "id": "btnalert",
                        "class": "btn-primary clclass praclose",
                        "value": objLang.Accept
                    }],
            };
        }
        showResponse(type, status, label, messagew);
    }
    return stresponse;
}

// funcion que invoca el callback a llamar
function executeCallback(element, callback) {
    callback(element);
}

/**************************************************************
 Máscara de entrada. Script creado por Tunait! (21/12/2004)
 http://javascript.tunait.com/
 tunait@yahoo.com 
 ****************************************************************/
//var patron = new Array(2,2,4); //  dd/mm/aaaa
//var patron1 = new Array(4,2,2); //  aaaa/mm/dd
//var patron2 = new Array(2,3,2,2); //  34-206-21-22
//var patron3 = new Array(1,9); //  11-524585214

// d => element "this"
// sep => separador "-", "/"
// pat => patron "patron1"
// nums => true si es numerico o false si es cualquier caracter
function mascara(d, sep, pat, nums) {
    if (d.valant != d.value) {
        val = d.value;
        largo = val.length;
        val = val.split(sep);
        val2 = '';
        for (r = 0; r < val.length; r++) {
            val2 += val[r];
        }
        if (nums) {
            for (z = 0; z < val2.length; z++) {
                if (isNaN(val2.charAt(z))) {
                    letra = new RegExp(val2.charAt(z), "g");
                    val2 = val2.replace(letra, "");
                }
            }
        }
        val = '';
        val3 = new Array();
        for (s = 0; s < pat.length; s++) {
            val3[s] = val2.substring(0, pat[s]);
            val2 = val2.substr(pat[s]);
        }
        for (q = 0; q < val3.length; q++) {
            if (q == 0)
                val = val3[q];
            else {
                if (val3[q] != "")
                    val += sep + val3[q];
            }
        }
        d.value = val;
        d.valant = val;
    }
}

function getPatron(patronDate) {
    var objPatron = new Object;
    objPatron.patron = new Array(4, 2, 2);
    objPatron.separador = "-";
    //objPatron.objRexGe = /^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/;
    switch (patronDate) {
        case "Y-m-d":
            objPatron.patron = new Array(4, 2, 2);
            objPatron.separador = "-";
            //objPatron.objRexGe = /^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/;
            break;
        case "Y/m/d":
            objPatron.patron = new Array(4, 2, 2);
            objPatron.separador = "/";
            break;
        case "d-m-Y":
            objPatron.patron = new Array(2, 2, 4);
            objPatron.separador = "-";
            break;
        case "d/m/Y":
            objPatron.patron = new Array(2, 2, 4);
            objPatron.separador = "/";
            break;
        case "Y-M-d":
            objPatron.patron = new Array(4, 3, 2);
            objPatron.separador = "-";
            break;
        case "Y/M/d":
            objPatron.patron = new Array(4, 3, 2);
            objPatron.separador = "/";
            break;
        case "d-M-Y":
            objPatron.patron = new Array(2, 3, 4);
            objPatron.separador = "-";
            break;
        case "d/M/Y":
            objPatron.patron = new Array(2, 3, 4);
            objPatron.separador = "/";
            break;
        case "Y-m-d H:i:s":
            objPatron.patron = new Array(4, 2, 2, 2, 2, 2);
            break;
        case "Y/m/d H:i:s":
            objPatron.patron = new Array(4, 2, 2, 2, 2, 2);
            break;
        case "Y-M-d H:i:s":
            objPatron.patron = new Array(4, 2, 2, 2, 2, 2);
            break;
        case "Y/M/d H:i:s":
            objPatron.patron = new Array(4, 2, 2, 2, 2, 2);
            break;
        default:
            objPatron.patron = Array(4, 2, 2);
            break;
    }
    return objPatron;
}

function setIconValidator(element, noError, msgError, forceValid) {
    if (!noError) { // hay error
        if (!$(element).hasClass("spacingIcon"))
            $(element).addClass("spacingIcon");
        if ($(element).hasClass("ico-valid")) {
            $(element).stop().animate(ico.hidden, 150, function () {
                switchIco(element, 'ico-invalid', ico);
            });
        } else
            switchIco(element, 'ico-invalid', ico);
    } else { // ocultar iconos de error y mostrar icono de correcto
        if (forceValid) {
            if (!$(element).hasClass("spacingIcon"))
                $(element).addClass("spacingIcon");
            if ($(element).hasClass("ico-invalid")) {
                $(element).stop().animate(ico.hidden, 150, function () {
                    switchIco(element, 'ico-valid', ico);
                });
            } else
                switchIco(element, 'ico-valid', ico);
        } else {
            removeIco(element);
        }
    }
}
function switchIco(e, css, ico) {
    $(e).removeClass('ico-valid').removeClass('ico-invalid').addClass(css).stop().animate(ico.visible, 150);
}
function removeIco(e) {
    if (!$(e).hasClass("spacingIcon"))
        $(e).removeClass("spacingIcon");
    $(e).removeClass('ico-valid').removeClass('ico-invalid');
    $(e).css('background-position', '');
}
function removeIcos() {
    $(".PBvalidation").each(function () {
        id = "#" + $(this).attr("id");
        removeIco(id);
    });
}
function setInitPositionIco(e, ico) {
    if ($(e).css('background-position') != null) {
        if ($(e).css('background-position') != "98% 50%")
            $(e).css(ico.hidden);
    }
}
function hideIcons(e) {
    $(e).stop().animate(ico.hidden, 150, function () {
        removeIco(e);
    });
}