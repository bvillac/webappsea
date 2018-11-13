/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 *Esto valida:
1. El Ruc
2. Cédula de identidad
3. Pasaporte.
 */

function validarDocumento (campo){
    var estado = new Object;
    campo = campo.trim();
    estado.return = false;
    estado.mensaje = objLang.The_dni_is_incorrect;
    switch(campo.length){
        case 10:
            estado = validarCedula(campo);
            break;
        case 13:
            estado = validarRuc(campo);
            break;
        default:
            break;
    }
    return estado.return;
}

function validarCedula(valor){
    var estado = new Object;
    estado.return = false;
    estado.mensaje = objLang.The_dni_is_incorrect;
    var numero = valor;
    var suma = 0;
    var residuo = 0;
    var modulo = 11;
    
    
    /* Aqui almacenamos los digitos de la cedula en variables. */
    d1 = numero.substr(0,1);
    d2 = numero.substr(1,1);
    d3 = numero.substr(2,1);
    d4 = numero.substr(3,1);
    d5 = numero.substr(4,1);
    d6 = numero.substr(5,1);
    d7 = numero.substr(6,1);
    d8 = numero.substr(7,1);
    d9 = numero.substr(8,1);
    d10 = numero.substr(9,1);
    d11 = numero.substr(10,1);
    d12 = numero.substr(11,1);
    d13 = numero.substr(12,1);
    
    /* El tercer digito es: */
    /* 9 para sociedades privadas y extranjeros */
    /* 6 para sociedades publicas */
    /* menor que 6 (0,1,2,3,4,5) para personas naturales */
    var provincia = numero.substr(0,2);
    
    if(parseInt(provincia) < 1 && parseInt(provincia) > 24){
        //estado.mensaje = "Error con digito de provincia";
        return estado;
    }
    
    if (parseInt(d3) == 6 || parseInt(d3) == 9) { // El tercer digito es: menor que 6 (0,1,2,3,4,5) para personas naturales
        //estado.mensaje = "Error es un dni para empresas publica y privada";
        return estado;
    }
    
    p1 = d1 * 2;
    if (p1 >= 10) p1 -= 9;
    p2 = d2 * 1;
    if (p2 >= 10) p2 -= 9;
    p3 = d3 * 2;
    if (p3 >= 10) p3 -= 9;
    p4 = d4 * 1;
    if (p4 >= 10) p4 -= 9;
    p5 = d5 * 2;
    if (p5 >= 10) p5 -= 9;
    p6 = d6 * 1;
    if (p6 >= 10) p6 -= 9;
    p7 = d7 * 2;
    if (p7 >= 10) p7 -= 9;
    p8 = d8 * 1;
    if (p8 >= 10) p8 -= 9;
    p9 = d9 * 2;
    if (p9 >= 10) p9 -= 9;
    modulo = 10;
    
    suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
    residuo = suma % modulo;

    /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
    digitoVerificador = residuo==0 ? 0: modulo - residuo;

    /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
    if (digitoVerificador != d10){
        return estado;
    }
    if (numero.length >10 && numero.substr(10,3) != '001' ){
        //alert('El ruc de la persona natural debe terminar con 001');
        //estado.mensaje = "El ruc de la persona natural debe terminar con 001";
        return estado;
    }
    estado.return = true;
    return estado;
    
}

function validarRuc(valor){
    var estado = new Object;
    estado.return = false;
    estado.mensaje = objLang.The_dni_is_incorrect;
    var numero = valor;
    var suma = 0;
    var residuo = 0;
    var pri = false;
    var pub = false;
    var modulo = 11;
    
    
    /* Aqui almacenamos los digitos de la cedula en variables. */
    d1 = numero.substr(0,1);
    d2 = numero.substr(1,1);
    d3 = numero.substr(2,1);
    d4 = numero.substr(3,1);
    d5 = numero.substr(4,1);
    d6 = numero.substr(5,1);
    d7 = numero.substr(6,1);
    d8 = numero.substr(7,1);
    d9 = numero.substr(8,1);
    d10 = numero.substr(9,1);
    d11 = numero.substr(10,1);
    d12 = numero.substr(11,1);
    d13 = numero.substr(12,1);
    
    /* El tercer digito es: */
    /* 9 para sociedades privadas y extranjeros */
    /* 6 para sociedades publicas */
    /* menor que 6 (0,1,2,3,4,5) para personas naturales */
    var provincia = numero.substr(0,2);
    if(parseInt(provincia) < 1 && parseInt(provincia) > 24){
        return estado;
    }
    if (parseInt(d3) != 6 && parseInt(d3) != 9) { // El tercer digito es: menor que 6 (0,1,2,3,4,5) para personas naturales
        dni = numero.substr(0,10);
        if(numero.substr(10,3) == '001')
            return validarCedula(dni);
        else
            return estado;
    }

    //El tercer digito es: 6 para sociedades publicas
    if(parseInt(d3) == 6) {/* Solo para sociedades publicas (modulo 11) */
        pub = true;
        p1 = d1 * 3;
        p2 = d2 * 2;
        p3 = d3 * 7;
        p4 = d4 * 6;
        p5 = d5 * 5;
        p6 = d6 * 4;
        p7 = d7 * 3;
        p8 = d8 * 2;
        p9 = 0;
    }else if(parseInt(d3) == 9) {/* Solo para entidades privadas (modulo 11) */
        pri = true;
        p1 = d1 * 4;
        p2 = d2 * 3;
        p3 = d3 * 2;
        p4 = d4 * 7;
        p5 = d5 * 6;
        p6 = d6 * 5;
        p7 = d7 * 4;
        p8 = d8 * 3;
        p9 = d9 * 2;
    }else{
        return false;
    }
    
    suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
    residuo = suma % modulo;

    /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
    digitoVerificador = residuo==0 ? 0: modulo - residuo;

    /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
    if (pub==true){
        if (digitoVerificador != d9){
            //estado.mensaje = "El ruc de la empresa del sector público es incorrecto.";
            return estado;
        }
        /* El ruc de las empresas del sector publico terminan con 0001*/
        if ( numero.substr(9,4) != '0001' ){
            //estado.mensaje = "El ruc de la empresa del sector público debe terminar con 0001";
            return estado;
        }
    }
    else if(pri == true){
        if (digitoVerificador != d10){
            //estado.mensaje = "El ruc de la empresa del sector privado es incorrecto";
            return estado;
        }
        if ( numero.substr(10,3) != '001' ){
            //estado.mensaje = "El ruc de la empresa del sector privado debe terminar con 001";
            return estado;
        }
    }else
        return estado;
    estado.return = true;
    return estado;
    
}