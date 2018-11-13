<?php

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
 *
 * Authors:
 *
 * Eduardo Cueva <ecueva@penblu.com>
 * 
 */

namespace app\models;

use Yii;

class Menu {
    
    
    /**
     * This function return a tags scripts and css
     * @author Eduardo Cueva <ecueva@penblu.com>
     * @param mixed  $view         Vista del objeto
     * @param string $controller   The path controller/action
     * @param string $module       Nombre del modulo
     */
    public static function getScripts($view, $controller, $module = NULL) {
        $link = Yii::$app->basePath;
        $ctr = "/views/$controller";
        $arr_files = array();
        if(isset($module) && ($module != Yii::$app->id)) {
            $ctr = "/modules/$module/views/$controller";
        }

        $cssfile = $link . $ctr . "/css";
        $jsfile  = $link . $ctr . "/js";
        
        if (is_dir($cssfile)) { // existe el directorio css
            $assetsPathCss = Yii::$app->getAssetManager()->publish($cssfile);
            $arr_css = self::obtainFilesScripts($cssfile, "css");
            if ($arr_css != false && count($arr_css) > 0) {
                for ($i = 0; $i < count($arr_css); $i++) {
                    $view->registerCssFile($assetsPathCss[1] . "/" . $arr_css[$i]);
                }
            }
        }
        
        if (is_dir($jsfile)) {  // existe el directorio js
            $assetsPathJs  = Yii::$app->getAssetManager()->publish($jsfile);
            $arr_js = self::obtainFilesScripts($jsfile, "js");
            if ($arr_js != false && count($arr_js) > 0) {
                for ($i = 0; $i < count($arr_js); $i++) {
                    $view->registerJsFile($assetsPathJs[1] . "/" . $arr_js[$i],['depends' => [\yii\web\JqueryAsset::className()]]);
                }
            }
        }
    }


    /**
     * This function Obtain all name files into of a directory where $type is the extension of the file
     *   Example:
     *       $array = obtainFiles('/var/www/html/modules/calendar/themes/default/js/','js');
     *
     * @author  Eduardo Cueva
     * @email   ecueva@penblu.com
     * 
     * @param   string   $dir   Directory of scripts
     * @param   string   $type  Type of file to search
     * @return  array    $names List of scripts
     */
    public static function obtainFilesScripts($dir, $type) {
        $files = glob($dir . "/{*.$type}", GLOB_BRACE);
        $names = array();
        foreach ($files as $ima)
            $names[] = array_pop(explode("/", $ima));
        return $names;
    }
    
    public static function additionalsLangs(){
        $_SESSION['JSLANG']['Are you sure you want to delete this record?'] = Yii::t("notificaciones",'Are you sure you want to delete this record?');
        $_SESSION['JSLANG']['Delete'] = Yii::t("accion",'Delete');
    }
    
     /**
     * This function print a var in javascript with a language file in PHP
     * @author  Eduardo Cueva <ecueva@penblu.com>
     * 
     * @param   string   $dir_lang_files    Path of Lang File
     * @param   string   $lang              Language prefix
     * @param   string   $fileMessage       Type of file to search
     * @param   string   $varName           Name of var in Javascript
     * @return  string   $scriptTags        Script in Javascript
     */
    public static function generateJSLang($dir_lang_files, $lang = "es", $fileMessage = "jslang", $varName = "objLang"){
        $scriptTags = "<script type='text/Javascript'>";
        // se lee el captura el archivo de lenguajes 
        $arrVars = "";
        $link = Yii::$app->basePath . "/messages/$lang/$fileMessage.php";
        if($dir_lang_files != "")
            $link = Yii::$app->basePath . "/$dir_lang_files/$lang/$fileMessage" . ".php";
        if(is_file($link)){
            $arr_lang = require($link);
            $arr_no_allowed = array(" ",".","{","}","[","]","(",")","?","¿","/","#","|","$","*","-","+","@",",",";",":");
            if(is_array($arr_lang)){
                foreach($arr_lang as $key => $value){          
                    $arrVars .= $varName.".".self::replaceCharByArray($key,$arr_no_allowed,"_")."='".$value."';\n";
                }        
            }
            if(isset($_SESSION['JSLANG'])){
                self::additionalsLangs();
                foreach($_SESSION['JSLANG'] as $key => $value)
                    $arrVars .= $varName.".".self::replaceCharByArray($key,$arr_no_allowed,"_")."='".$value."';\n";
            }
            $_SESSION['JSLANG'] = array(); // seteamos a vacio esa variable nuevamente.
        }else{
            $arrVars = "/*** error al acceder a archivo $lang/$fileMessage.php ****/";
            Yii::trace($arrVars.". link: $link");
        }
        $script = <<<EOF
var $varName = new Object();
$arrVars
EOF;
        $scriptTags .= $script . "</script>";
        echo $scriptTags;
    }
    
    /**
     * Function to replace characters no allowed in Javascript in Object vars 
     * @author  Eduardo Cueva <ecueva@penblu.com>
     * 
     * @param   string   $strToReplace    String to do a replace
     * @param   string   $arr_no_allowed  Array of characters not allowed or chars to replace with {$charToReplace}
     * @param   string   $charToReplace   Character to replace in with all elements of {$arr_no_allowed}
     * @return  string   $strToReplace    New string without any character in {$arr_no_allowed}
     */
    public static function replaceCharByArray($strToReplace, $arr_no_allowed, $charToReplace){
        for($i=0; $i<count($arr_no_allowed); $i++)
            $strToReplace = str_replace($arr_no_allowed[$i], $charToReplace, $strToReplace);
        return $strToReplace;
    }
    
    /**
     * Funcion para obtener un arreglo de Modulos 
     * @author  Eduardo Cueva <ecueva@penblu.com>
     * 
     * @return  mixed   $res    New array with Menu Modules
     */
    public static function getMenuModulos(){
        $model = new Modulo();
        $res = $model->getModulos();
        return $res;
    }
    
    /**
     * Function to get array Object Modules 
     * @author  Eduardo Cueva <ecueva@penblu.com>
     * 
     * @param   string  $mod_id     Module Id    
     * @return  mixed   $res        New array with Object Modules
     */
    public static function getObjetoModulo($mod_id){
        $model = new ObjetoModulo();
        $res = $model->getObjetoModulosXModulo($mod_id);
        return $res;
    }

}