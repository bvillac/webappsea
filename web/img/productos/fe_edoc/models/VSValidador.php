<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\fe_edoc\models;

use Yii;
use app\modules\fe_edoc\Module as fe_edoc;

class VSValidador {
    
    public function tipoIdent($cedula){
        $valor='07';//Consumidor Final por Defecto
        IF(strlen($cedula)>10) {
            IF(strlen($cedula)==13){
                $valor='04';//VENTA CON RUC
            }ELSEIF(strlen($cedula)>13){
                $valor='06';//VENTA CON PASAPORTE
            }
        }ELSE{
            IF($cedula==Yii::$app->params['consumidorfinal']){//Esta vericacion depende de la empresa
                $valor='07';//VENTA A CONSUMIDOR FINAL*  SON 13 DIGITOS
            }ELSE{
                $valor='05';//VENTA CON CEDULA
            }
        }
        return $valor;

    }
    public function ajusteNumDoc($numDoc,$num){
        $result='';
        IF(strlen($numDoc)<$num){
            $result=$this->add_ceros($numDoc,$num);//Ajusta los 9
        }ELSE{
            $result=substr($numDoc, -($num));//Extrae Solo 9
        }
        return $result;
    }
    public function add_ceros($numero, $ceros) {
        /* Ejemplos para usar.
          $numero="123";
          echo add_ceros($numero,8) */
        $order_diez = explode(".", $numero);
        $dif_diez = $ceros - strlen($order_diez[0]);
        for ($m = 0; $m < $dif_diez; $m++) {
            @$insertar_ceros .= 0;
        }
        return $insertar_ceros .= $numero;
    }
    
    /* Valida y Reemplaza Caracteres Especiales EN XML que no son aceptados 
     * http://ascii.cl/es/codigos-html.htm
     * Si existe problemas con UTF-8 -> ñ -> con su caracter especial
     * http://php.net/manual/es/function.htmlspecialchars.php
     */
    function limpioCaracteresXML($cadena) {
        //$cadena = preg_replace("[\n|\r|\n\r|\t|\0|\x0B]"," ",$cadena);// Valida Enter en texto con Expresiones Regulares
        $search = array("<", ">", "&", "'");
        $replace = array("&lt;", "&gt;", "&amp;", "&apos;");
        $final = str_replace($search, $replace, $cadena);
        //$final = htmlentities($cadena, ENT_QUOTES | ENT_XML1,'UTF-8');
        //$final = htmlspecialchars($final, ENT_XML1,'UTF-8');
        return $final;
    }
    
    public function paginado($control){
        //Manipulando el Paginado del Select
        $page = isset($control[0]['PAGE']) ? $control[0]['PAGE'] : 0;
        $pageSize = fe_edoc::params('limitRowSQL');//Yii::$app->params['limitRowSQL'];
        $inicio = $page;//($page != 0) ? ($page - 1) * $pageSize : 0;
        $max = $pageSize;//$pageSize * $page;
        $limitrowsql = ($page != 0) ? " LIMIT $inicio,$max " : " LIMIT $pageSize";
        return $limitrowsql;
        //Fin Paginado
    }
    
    public static function putMessageLogFile($message) {
        if (is_array($message))
            $message = json_encode($message);
        $message = date("Y-m-d H:i:s") . " " . $message . "\n";
        if (!is_dir(dirname(Yii::$app->params["logfile"]))) {
            mkdir(dirname(Yii::$app->params["logfile"]), 0777, true);
            chmod(dirname(Yii::$app->params["logfile"]), 0777);
            touch(Yii::$app->params["logfile"]);
        }
        //se escribe en el fichero
        file_put_contents(Yii::$app->params["logfile"], $message, FILE_APPEND | LOCK_EX);
    }
    
    public function concatenarUserERP($str) {
        $UERPId="";
        $rawData = explode(",", $str);
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $UERPId .= ($i == 0)?$rawData[$i]:"','".$rawData[$i];
        }
        return $UERPId;
    }
    
    /**
     * funcion para convertir un numero a decimal con X digitos
     * @param String $number
     * @param Int $digitos cantidad de digitos a mostrar
     * @return Float
     */
    public static function truncateFloat($number, $digitos) {
        $raiz = 10;
        $multiplicador = pow($raiz, $digitos);
        $resultado = ((int) ($number * $multiplicador)) / $multiplicador;
        return number_format($resultado, $digitos);
    }
    
    public static function tipoEmision() {
        return [
            '1' => Yii::t('formulario', 'Normal'),
            '2' => Yii::t('formulario', 'Indisponibilidad del Sistema'),
        ];
    }
    public static function tipoAmbiente() {
        return [
            '1' => Yii::t('formulario', 'Pruebas'),
            '2' => Yii::t('formulario', 'Producción'),
        ];
    }
    public static function tipoEstado() {
        return [
            'SI' => Yii::t('formulario', 'SI'),
            'NO' => Yii::t('formulario', 'NO'),
        ];
    }

}
