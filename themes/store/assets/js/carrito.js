/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*CREATE TABLE `cab_listapedidos_temp` (
  `ids_clis` bigint(20) NOT NULL AUTO_INCREMENT,
  `cli_id` bigint(20) NOT NULL,
  `cod_cli` varchar(10) DEFAULT NULL,
  `atiende` varchar(10) DEFAULT NULL,
  `tip_doc` varchar(2) NOT NULL,
  `num_doc` varchar(10) NOT NULL,
  `ids_lre` bigint(20) NOT NULL,
  `nom_clis` varchar(200) DEFAULT NULL,
  `dir_entrega` varchar(150) DEFAULT NULL,
  `val_bru` decimal(12,4) DEFAULT NULL,
  `por_des` decimal(5,2) DEFAULT NULL,
  `val_des` decimal(12,4) DEFAULT NULL,
  `val_fle` decimal(12,4) DEFAULT NULL,
  `bas_iva` decimal(12,4) DEFAULT NULL,
  `bas_iv0` decimal(12,4) DEFAULT NULL,
  `por_iva` decimal(5,2) DEFAULT NULL,
  `val_iva` decimal(12,4) DEFAULT NULL,
  `val_net` decimal(12,4) DEFAULT NULL,
  `est_ped` varchar(2) DEFAULT NULL,
  `est_log` varchar(1) DEFAULT NULL,
  `fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fec_mod` timestamp NULL DEFAULT NULL,
  `usuario` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ids_clis`,`cli_id`,`tip_doc`,`num_doc`),
  KEY `fk_cab_listapedidos_temp_lista_recurrentes1_idx` (`ids_lre`),
  CONSTRAINT `fk_cab_listapedidos_temp_lista_recurrentes1` FOREIGN KEY (`ids_lre`) REFERENCES `lista_recurrentes` (`ids_lre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `db_tienda`.`det_listapedidos_temp`
(`ids_dlis`,
`ids_clis`,
`ids_pre`,
`ids_pro`,
`cod_art`,
`tip_doc`,
`num_doc`,
`cli_id`,
`p_venta`,
`can_des`,
`t_venta`,
`por_des`,
`val_des`,
`i_m_iva`,
`val_iva`,
`est_ped`,
`est_log`,
`fec_cre`,
`fec_mod`,
`usuario`)
VALUES
(<{ids_dlis: }>,
<{ids_clis: }>,
<{ids_pre: }>,
<{ids_pro: }>,
<{cod_art: }>,
<{tip_doc: }>,
<{num_doc: }>,
<{cli_id: }>,
<{p_venta: }>,
<{can_des: }>,
<{t_venta: }>,
<{por_des: }>,
<{val_des: }>,
<{i_m_iva: }>,
<{val_iva: }>,
<{est_ped: }>,
<{est_log: }>,
<{fec_cre: CURRENT_TIMESTAMP}>,
<{fec_mod: }>,
<{usuario: }>);
*/

$(document).ready(function () {
    //aquí el código que deseas ejecutar
    recargarGridProductoCar();
});

function addCarrito(Ids,CodIds,Nombre,Pvta){
    //alert(Ids);

    var arr_carrito = new Array();
    if (sessionStorage.dts_carrito) {
        /*Agrego a la Sesion*/
        arr_carrito = JSON.parse(sessionStorage.dts_carrito);
        var size = arr_carrito.length;
        if (size > 0) {
            //Varios Items
            if (codigoExiste(CodIds, 'cod_art', sessionStorage.dts_carrito)) {//Verifico si el Codigo Existe  para no Dejar ingresar Repetidos
                arr_carrito[size] = objProductoCar(size,Ids,CodIds,Nombre,Pvta);
                sessionStorage.dts_carrito = JSON.stringify(arr_carrito);
                //addVariosItemProducto(tGrid, arr_carrito, -1);
                //limpiarDetalle();
            } else {
                menssajeModal("OK", "error", "Item ya existe en su lista", "Información", "", "", "1");
            }
        } else {
            /*Agrego a la Sesion*/
            //Primer Items                   
            sessionStorage.dts_carrito = JSON.stringify(arr_carrito);
            //addPrimerItemProducto(tGrid, arr_carrito, 0);
            //limpiarDetalle();
        }
    } else {
        //No existe la Session
        //Primer Items
        arr_carrito[0] = objProductoCar(0,Ids,CodIds,Nombre,Pvta);
        sessionStorage.dts_carrito = JSON.stringify(arr_carrito);
        //addPrimerItemProducto(tGrid, arr_carrito, 0);
        //limpiarDetalle();
    }
    
}

function objProductoCar(indice,Ids,CodIds,Nombre,Pvta) {
    var rowGrid = new Object();
    rowGrid.ids_pos = indice;
    rowGrid.ids_pro = Ids;
    rowGrid.cod_art =CodIds;
    rowGrid.des_com =Nombre;
    rowGrid.p_venta =Pvta;
    rowGrid.can_des =1;
    rowGrid.accion = "new";
    return rowGrid;
}

function recargarGridProductoCar() {
    //alert('ingreso');
    var tGrid = 'TbG_ProductosCar';
    if (sessionStorage.dts_carrito) {
        var arr_Grid = JSON.parse(sessionStorage.dts_carrito);
        if (arr_Grid.length > 0) {
            $('#' + tGrid + ' > tbody').html("");
            for (var i = 0; i < arr_Grid.length; i++) {
                $('#' + tGrid + ' > tbody:last-child').append(retornaFilaProductoCar(i, arr_Grid, tGrid, true));
            }
        }
    }
}

function retornaFilaProductoCar(c, Grid, TbGtable, op) {
    //var RutaImagenAccion='ruta IMG'//$('#txth_rutaImg').val();
    var ruta=$('#txth_imgfolder').val()+ Grid[c]['cod_art']+'_G-01.jpg';
    var strFila = "";
    //var imgCol='<img class="btn-img" src="'+RutaImagenAccion+'/acciones/eliminar.png" >';
    //[{"ids_pos":0,"ids_pro":"4","cod_art":"A0004","des_com":"ALMOHADILLA KORES (BENE) PLASTICA MED.","p_venta":"0.9000","can_des":1,"accion":"new"},{"ids_pos":1,"ids_pro":"1","cod_art":"A0001","des_com":"AGENDA EJECUTIVA 2016 F/DORADOS VERDE","p_venta":"8.5376","can_des":1,"accion":"new"}]
    
    strFila += '<td style="display:none; border:none;">' + Grid[c]['ids_pro'] + '</td>';
    strFila += '<td class="cart_product">';
        strFila += '<a href=""><img class="imgProCarrito" src="'+ruta+'"  alt=""></a>';
    strFila += '</td>';
    strFila += '<td class="cart_description">';
        strFila += '<h4><a href="">' + Grid[c]['des_com'] + '</a></h4>';
        strFila += '<p>Web ID: ' + Grid[c]['cod_art'] + '</p>';
    strFila += '</td>';
    strFila += '<td class="cart_price">';
        strFila += '<p>$' + Grid[c]['p_venta'] + '</p>';
    strFila += '</td>';
    strFila += '<td class="cart_quantity">';
        strFila += '<div class="cart_quantity_button">';
            strFila += '<a class="cart_quantity_up" href=""> + </a>';
            strFila += '<input class="cart_quantity_input" type="text" name="quantity" value="1" ';
                    strFila += ' onkeydown="pedidoEnterGrid(isEnter(event),this,' + Grid[c]['ids_pro'] + ')"';
                    //strFila += ' autocomplete="off" size="2">';
                    strFila += ' autocomplete="off" size="2">';
            strFila += '<a class="cart_quantity_down" href=""> - </a>';
        strFila += '</div>';
    strFila += '</td>';
    strFila += '<td class="cart_total">';
        strFila += '<p class="cart_total_price">$8.54</p>';
    strFila += '</td>';
    strFila += '<td class="cart_delete">';
        strFila += '<a onclick="eliminarItemsCarrito(\'' + Grid[c]['ids_pro'] + '\',\'' + TbGtable + '\')" class="cart_quantity_delete" ><i class="fa fa-times"></i></a>';
    strFila += '</td>';
    
    
    
    
    /*strFila += '<td style="display:none; border:none;">' + Grid[c]['ids_reb'] + '</td>';
    strFila += '<td>' + Grid[c]['nom_ban'] + '</td>';
    strFila += '<td>' + Grid[c]['tip_cta'] + '</td>';
    strFila += '<td>' + Grid[c]['num_cta'] + '</td>';
    strFila += '<td>' + Grid[c]['cre_ban'] + '</td>';
    
    //strFila +='<td>'+ Grid[c]['pro_detalle_uso']+'</td>';
    strFila += '<td>';//¿Está seguro de eliminar este elemento?
    //strFila +='<a class="btn-img" onclick="eliminarItemsProducto('+Grid[c]['DEP_ID']+',\''+TbGtable+'\')" >'+imgCol+'</a>';
    strFila += '<a onclick="eliminarItemsBanco(\'' + Grid[c]['ids_reb'] + '\',\'' + TbGtable + '\')" ><span class="glyphicon glyphicon-trash"></span></a>';
    strFila += '</td>';*/

    if (op) {
        strFila = '<tr>' + strFila + '</tr>';
    }
    return strFila;
}

function eliminarItemsCarrito(val, TbGtable) {
    
    //alert('eliminar');
    var ids = "";
    //var count=0;
    if (sessionStorage.dts_carrito) {
        var Grid = JSON.parse(sessionStorage.dts_carrito);
        if (Grid.length > 0) {
            $('#' + TbGtable + ' tr').each(function () {
                ids = $(this).find("td").eq(0).html();
                //alert(ids);
                if (ids == val) {
                    var array = findAndRemove(Grid, 'ids_pro', ids);
                    sessionStorage.dts_carrito = JSON.stringify(array);
                    //if (count==0){sessionStorage.removeItem('detalleGrid')}
                    $(this).remove();
                }
            });
        }
    }
}

function pedidoEnterGrid(valor,control,Ids){
    if (valor) {//Si el usuario Presiono Enter= True
         control.value = redondea(control.value, Ndecimal);
         //var p_venta=parseFloat(control.value);
         var cant=control.value;
         calculaTotal(cant,Ids);
    }
}

function calculaTotal( cant,Ids) {
    var precio = 0;
    var valor=0;
    var total=0;
    var vtot=0;
    var TbGtable = 'TbG_ProductosCar';
    $('#' + TbGtable + ' tr').each(function () {
        var idstable = $(this).find("td").eq(0).html();
        if (idstable==Ids) {
            precio = $(this).find("td").eq(5).html();
            valor=redondea(precio * cant, Ndecimal);
            $(this).find("td").eq(6).html(valor);
        }
        if (idstable!='') {
            vtot=parseFloat($(this).find("td").eq(6).html());
            total+=(vtot>0)?vtot:0;
        }
    });
    $('#lbl_total').text(redondea(total, Ndecimal))
}


/* INFORMACION DE BANCOS REFERENCIA*/


function addPrimerItemProducto(TbGtable, lista, i) {
    /*Remuevo la Primera fila*/
    $('#' + TbGtable + ' >table >tbody').html("");
    /*Agrego a la Tabla de Detalle*/
    $('#' + TbGtable + ' tr:last').after(retornaFilaProducto(i, lista, TbGtable, true));
}

function addVariosItemProducto(TbGtable, lista, i) {
    //i=(i==-1)?($('#'+TbGtable+' tr').length)-1:i;
    i = ($('#' + TbGtable + ' tr').length) - 1;
    //$('#'+TbGtable+' >table >tbody').append(retornaFilaProducto(i,lista,TbGtable,true));
    $('#' + TbGtable + ' tr:last').after(retornaFilaProducto(i, lista, TbGtable, true));
}

function retornaFilaProducto(c, Grid, TbGtable, op) {
    //var RutaImagenAccion='ruta IMG'//$('#txth_rutaImg').val();
    var strFila = "";
    //var imgCol='<img class="btn-img" src="'+RutaImagenAccion+'/acciones/eliminar.png" >';
    strFila += '<td style="display:none; border:none;">' + Grid[c]['ids_reb'] + '</td>';
    strFila += '<td>' + Grid[c]['nom_ban'] + '</td>';
    strFila += '<td>' + Grid[c]['tip_cta'] + '</td>';
    strFila += '<td>' + Grid[c]['num_cta'] + '</td>';
    strFila += '<td>' + Grid[c]['cre_ban'] + '</td>';
    
    //strFila +='<td>'+ Grid[c]['pro_detalle_uso']+'</td>';
    strFila += '<td>';//¿Está seguro de eliminar este elemento?
    //strFila +='<a class="btn-img" onclick="eliminarItemsProducto('+Grid[c]['DEP_ID']+',\''+TbGtable+'\')" >'+imgCol+'</a>';
    strFila += '<a onclick="eliminarItemsBanco(\'' + Grid[c]['ids_reb'] + '\',\'' + TbGtable + '\')" ><span class="glyphicon glyphicon-trash"></span></a>';
    strFila += '</td>';

    if (op) {
        strFila = '<tr>' + strFila + '</tr>';
    }
    return strFila;
}

// Recarga la Grid de Productos si Existe
function recargarGridProducto() {
    var tGrid = 'TbG_Productos';
    if (sessionStorage.dts_refeBancos) {
        var arr_Grid = JSON.parse(sessionStorage.dts_refeBancos);
        if (arr_Grid.length > 0) {
            $('#' + tGrid + ' > tbody').html("");
            for (var i = 0; i < arr_Grid.length; i++) {
                $('#' + tGrid + ' > tbody:last-child').append(retornaFilaProducto(i, arr_Grid, tGrid, true));
            }
        }
    }
}

function eliminarItemsBanco(val, TbGtable) {
    var ids = "";
    //var count=0;
    if (sessionStorage.dts_refeBancos) {
        var Grid = JSON.parse(sessionStorage.dts_refeBancos);
        if (Grid.length > 0) {
            $('#' + TbGtable + ' tr').each(function () {
                ids = $(this).find("td").eq(0).html();
                //alert(ids);
                if (ids == val) {
                    var array = findAndRemove(Grid, 'ids_reb', ids);
                    sessionStorage.dts_refeBancos = JSON.stringify(array);
                    //if (count==0){sessionStorage.removeItem('detalleGrid')}
                    $(this).remove();
                }
            });
        }
    }
}


function agregarItemsBanco(opAccion) {
    var tGrid = 'TbG_Productos';
    var nombre = $('#txt_num_cta').val();
    //Verifica que tenga nombre producto y tenga foto
    if ($('#txt_num_cta').val() != "" &&  $('#cmb_banco option:selected').val() != 0) {
        var valor = $('#txt_num_cta').val();
        if (opAccion != "edit") {
            //*********   AGREGAR ITEMS *********
            var arr_Grid = new Array();
            if (sessionStorage.dts_refeBancos) {
                /*Agrego a la Sesion*/
                arr_Grid = JSON.parse(sessionStorage.dts_refeBancos);
                var size = arr_Grid.length;
                if (size > 0) {
                    //Varios Items
                    if (codigoExiste(nombre, 'pro_nombre', sessionStorage.dts_refeBancos)) {//Verifico si el Codigo Existe  para no Dejar ingresar Repetidos
                        arr_Grid[size] = objProducto(size); //objAntDep(retornarIndexArray(JSON.parse(sessionStorage.atc_antDeporte),'DEP_NOMBRE',valor),JSON.parse(sessionStorage.atc_antDeporte));
                        sessionStorage.dts_refeBancos = JSON.stringify(arr_Grid);
                        addVariosItemProducto(tGrid, arr_Grid, -1);
                        limpiarDetalle();
                    } else {
                        menssajeModal("OK", "error", "Item ya existe en su lista", "Información", "", "", "1");
                    }
                } else {
                    /*Agrego a la Sesion*/
                    //Primer Items                   
                    sessionStorage.dts_refeBancos = JSON.stringify(arr_Grid);
                    addPrimerItemProducto(tGrid, arr_Grid, 0);
                    limpiarDetalle();
                }
            } else {
                //No existe la Session
                //Primer Items
                arr_Grid[0] = objProducto(0);
                sessionStorage.dts_refeBancos = JSON.stringify(arr_Grid);
                addPrimerItemProducto(tGrid, arr_Grid, 0);
                limpiarDetalle();
            }
        } else {
            //data edicion
        }
    } else {
        showAlert('NO_OK', 'error', {"wtmessage": 'Debe seleccionar Información Requerida', "title":'Información'});
    }
}

function limpiarDetalle() {
    $('#txt_num_cta').val("");
    $('#cmb_banco').val(0);
    $('#cmb_tip_cta').val(0);
    //$('#chk_envase').prop('checked', false);
    //Quita los Alertas
    removeIco('#txt_num_cta');
}

function objProducto(indice) {
    var rowGrid = new Object();
    rowGrid.ids_reb = indice;
    //rowGrid.ids_reb = 0;
    rowGrid.ids_ban =$('#cmb_banco option:selected').val();
    rowGrid.nom_ban =$('#cmb_banco option:selected').text();
    rowGrid.tip_cta =$('#cmb_tip_cta option:selected').val();
    rowGrid.nom_cta =$('#cmb_tip_cta option:selected').text();
    rowGrid.num_cta = $('#txt_num_cta').val();
    //rowGrid.cre_ban = ($("#rbt_op1").prop("checked")) ? 1 : 0;
    rowGrid.cre_ban = $("input[name='rbt_op']:checked").val();
    rowGrid.accion = "new";
    return rowGrid;
}


/* FIN INFORMACION DE BANCOS REFERENCIA*/
