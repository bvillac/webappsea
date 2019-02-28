<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_Base
 *
 * @author root
 * Revisar Bloc para Utiliar Caracteres Especiales
 * http://xaviesteve.com/354/acentos-y-enes-aparecen-mal-a%C2%B1-en-php-con-mysql-utf-8-iso-8859-1/
 */
class cls_Base {
    var $BdAppweb="db_no_existe"; 
    var $BdIntermedio="db_edoc";
   
    //SERVIDOR REMOTO WEBAPP
    public function conexionIntermedio() {
        //Configuracion Local
        $bd_host = "localhost";
        $bd_usuario = 'uteg';
        $bd_password ='Utegadmin2016*';
        $bd_base = $this->BdIntermedio;
        $con = new mysqli($bd_host,$bd_usuario,$bd_password,$bd_base);
        $con->set_charset('utf8');//Convierte todo lo que esté codificado de latin1 a UTF-8 Errore de Ñ o Caractes especiales 
        if($con->connect_error){
            die("Error en la conexion : ".$con->connect_errno."-".$con->connect_error);
        }
        return $con;
    }
    public function getIntermedio() {
        return $this->BdIntermedio;
    }
    //SERVIDOR REMOTO WEBAPP
    public function conexionAppWeb() {
        //Configuracion Local
        $bd_host = "localhost";
        $bd_usuario = "uteg";
        $bd_password = "Utegadmin2016*";
        $bd_base = $this->BdAppweb;
        $con = new mysqli($bd_host,$bd_usuario,$bd_password,$bd_base);
        $con->set_charset('utf8');//Convierte todo lo que esté codificado de latin1 a UTF-8 Errore de Ñ o Caractes especiales 
        if($con->connect_error){
            die("Error en la conexion : ".$con->connect_errno."-".$con->connect_error);
        }
        return $con;
    }
    public function getBdAppweb() {
        return $this->BdAppweb;
    }
    

}
