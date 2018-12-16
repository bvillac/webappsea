/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//alert('hola');

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
