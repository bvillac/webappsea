<?php

/**
 * This is the model class "Utilities".
 *
 *
 * The followings are the available model relations:
 */

namespace app\models;

use Yii;
use yii\helpers\Url;

class Utilities {

    /**
     * Función obtener un string dada su posicion y su separador
     *
     * @access public
     * @author Eduardo Cueva
     * @param  time   $name       Cadena de texto a procesar
     * @param  string $position   Palabra que se desea obtener
     * @param  string $delimiter  Limitador entre conjunto de palabras esta debe comenzar desde cero
     * @return string | boolean   Retorna la cadena en la posicion deseada o si no existe retorna false
     */
    public static function getStringByPosition($name, $position, $delimiter = " ") {
        $arrData = explode($delimiter, $name);
        if (isset($arrData[$position]))
            return $arrData[$position];
        return false;
    }

    /**
     * Función para crear calcular edad a través de la fecha de nacimiento
     *
     * @access public
     * @author Eduardo Cueva
     * @param  time   $fecha       Fecha de Nacimiento a calcular la edad.
     * @param  string $limitador   Limitador entre numeros que definen la fecha. Ejemplo: "-", "/".1945-12-01
     * @return string $edad        Calculo de la edad dada una fecha a el dia de hoy.
     */
    public static function calcularEdad($fecha, $limitador = "-") {
        $fechaFormat = date("d" . $limitador . "m" . $limitador . "Y", strtotime($fecha));
        $dias = explode($limitador, $fechaFormat, 3);
        // formatos m-d-y = [0]-[1]-[2]
        //formt mktime:h,i,s,m,d,y
        $dias = mktime(0, 0, 0, $dias[1], $dias[0], $dias[2]);
        $edad = (int) ((time() - $dias) / 31556926 );
        return $edad;
    }

    /**
     * Función escribir en log del sistema
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string $message       Escribe variable en archivo de logs.
     */
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

    /**
     * Función que devuelve la ip del usuario en session
     *
     * @access public
     * @author Eduardo Cueva
     * @return string   $ip         Retorna la IP del cliente o usuario
     */
    public static function getClientRealIP() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $ip;
    }

    /**
     * Devuelve un Objeto XML a partir de un Arreglo
     *
     * @access public
     * @author http://darklaunch.com/2009/05/23/php-xml-encode-using-domdocument-convert-array-to-xml-json-encode
     * @param mixed $mixed  Arreglo de datos
     * @param mixed $domElement     Nodo del Documento padre o elemento
     * @param mixed $DOMDocument    Nodo del Documento principal
     * @return string   $ip         Retorna la IP del cliente o usuario
     */
    public static function xml_encode($mixed, $domElement = null, $DOMDocument = null) {
        if (is_null($DOMDocument)) {
            $DOMDocument = new \DOMDocument();
            $DOMDocument->formatOutput = true;
            self::xml_encode($mixed, $DOMDocument, $DOMDocument);
            echo $DOMDocument->saveXML();
        } else {
            if (is_array($mixed)) {
                foreach ($mixed as $index => $mixedElement) {
                    if (is_int($index)) {
                        if ($index === 0) {
                            $node = $domElement;
                        } else {
                            $node = $DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    } else {
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        if (!(rtrim($index, 's') === $index)) {
                            $singular = $DOMDocument->createElement(rtrim($index, 's'));
                            $plural->appendChild($singular);
                            $node = $singular;
                        }
                    }

                    self::xml_encode($mixedElement, $node, $DOMDocument);
                }
            } else {
                $mixed = is_bool($mixed) ? ($mixed ? 'true' : 'false') : $mixed;
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }

    /**
     * Función que verifica si un directorio existe caso contrario intenta crearlo
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string   $folder     Directorio a verificar si existe o no
     * @return bool     $bool       Retorna la IP del cliente o usuario
     */
    public static function verificarDirectorio($folder) {
        if (!file_exists($folder)) {
            if (mkdir($folder, 0755, true)) {
                chown($folder, Yii::$app->params['userWebServer']);
                return true;
            } else {
                self::putMessageLogFile("Error: System cannot create folder: $folder");
                return false;
            }
        } else
            return true;
    }

    /**
     * Función que crea desencripta un mensaje a traves de una clave utilizando AES con metodo de encriptacion
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string   $filename        Archivo a obtener el content type.
     * @return string   $contentType     Content Type del Archivo.
     */
    public static function mimeContentType($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

    /**
     * Función que valida una cadena con una expresion regular dado el parametro que indica que significa la cadena
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string   $param        String a evaluar.
     * @param  string   $type         Caracteristica de la cadena que se va a evaluar.
     * @return bool                   Si es verdadero la validacion es correcta caso contrario no.
     */
    public static function validateParameters($param, $type) {
        switch ($type) {
            case "ip":
                if (preg_match("/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/", $param)) {
                    return true;
                }
                break;
            case "email":
                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $param)) {
                    return true;
                }
                break;
            case "url":
                if (preg_match("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/", $param)) {
                    return true;
                }
                break;
            case "mac":
                if (preg_match("/^([0-9a-fA-F][0-9a-fA-F]:?){5}([0-9a-fA-F][0-9a-fA-F])$/", $param)) {
                    return true;
                }
                break;
            case "mac2":
                if (preg_match("/^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$/", $param)) {
                    return true;
                }
                break;
            case "numero":
                if (preg_match("/^(?:\+|-)?\d+$/", $param)) {
                    return true;
                }
                break;
            case "alfa":
                if (preg_match("/^([a-zA-ZáéíóúAÉÍÓÚÑñ '])+$/", $param)) {
                    return true;
                }
                break;
            case "alfanumerico":
                if (preg_match("/^([a-zA-Z áéíóúAÉÍÓÚÑñ0-9])+$/", $param)) {
                    return true;
                }
                break;
            case "texto":
                if (preg_match("/^.+$/", $param)) {
                    return true;
                }
                break;
        }
        return false;
    }

    public static function xmlToArray($xml, $options = array()) {
        $defaults = array(
            'namespaceSeparator' => ':', //you may want this to be something other than a colon
            'attributePrefix' => '@', //to distinguish between attributes and nodes with the same name
            'alwaysArray' => array(), //array of xml tag names which should always become arrays
            'autoArray' => true, //only create arrays for tags which appear more than once
            'textContent' => '$', //key used for the text content of elements
            'autoText' => true, //skip textContent key if node has no attributes or child nodes
            'keySearch' => false, //optional search and replace on tag and attribute names
            'keyReplace' => false       //replace values for above search values (as passed to str_replace())
        );
        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null; //add base (empty) namespace
        //get attributes from all namespaces
        $attributesArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch'])
                    $attributeName = str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                $attributeKey = $options['attributePrefix']
                        . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                        . $attributeName;
                $attributesArray[$attributeKey] = (string) $attribute;
            }
        }

        //get child nodes from all namespaces
        $tagsArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = self::xmlToArray($childXml, $options);
                list($childTagName, $childProperties) = each($childArray);

                //replace characters in tag name
                if ($options['keySearch'])
                    $childTagName = str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                //add namespace prefix, if any
                if ($prefix)
                    $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] = in_array($childTagName, $options['alwaysArray']) || !$options['autoArray'] ? array($childProperties) : $childProperties;
                } elseif (
                        is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName]) === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                }
            }
        }

        //get text content of node
        $textContentArray = array();
        $plainText = trim((string) $xml);
        if ($plainText !== '')
            $textContentArray[$options['textContent']] = $plainText;

        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '') ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

        //return node as array
        return array(
            $xml->getName() => $propertiesArray
        );
    }

    /**
     * Función que devuelve un arreglo con los nombres y apellidos
     *
     * @access public
     * @author Eduardo Cueva
     * @param string $name Cadena de texto con los nombres de una persona. Formato Apellido1 Apellido2 Nombre1 Nombre2
     * @return mixed       Arreglo con los nombres de la persona
     */
    public static function getNombresApellidos($name) {
        $nombres = $apellidos = "";
        $arrData = explode(" ", $name);
        switch (count($arrData)) {
            case 4:
                $nombres = self::getStringByPosition($name, 2, " ") . " " . self::getStringByPosition($name, 3, " ");
                $apellidos = self::getStringByPosition($name, 0, " ") . " " . self::getStringByPosition($name, 1, " ");
                break;
            case 3:
                $nombres = self::getStringByPosition($name, 2, " ");
                $apellidos = self::getStringByPosition($name, 0, " ") . " " . self::getStringByPosition($name, 1, " ");
                break;
            case 2:
                $nombres = self::getStringByPosition($name, 1, " ");
                $apellidos = self::getStringByPosition($name, 0, " ");
                break;
            default:
                $apellidos = self::getStringByPosition($name, 0, " ");
                break;
        }
        return array($nombres, $apellidos);
    }
    
    public static function curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public static function ajaxResponse($status, $type, $label, $error, $message, $addicionalData = array()){
        $arroout = array();
        $arroout["status"]  = $status;
        $arroout["type"]    = $type;
        $arroout["label"]   = $label;
        $arroout["error"]   = $error;
        $arroout["message"] = $message;
        if(count($addicionalData)>0){
            $arroout["data"] = $addicionalData;
        }
        return json_encode($arroout);
    }
    
    public static function sendEmail($titleMessage = "", $from = "no-responder@rdmi.com", $to = array(),
                                    $bcc = array(),
                                    $subject, $body, $files = array(),
                                    $template = "/mail/layouts/mailing",
                                    $fileRoute = "/mail/layouts/files"){
        if(function_exists('proc_open')){
            self::putMessageLogFile("Mail function exist");
        }else {
            self::putMessageLogFile("Error Mail function not exist");
        }
        $routeBase = Yii::$app->basePath;
        $socialNetwork = Yii::$app->params["socialNetworks"];
        //Pasas Parametros a la Plantilla Mailing
        $mail = Yii::$app->mailer->compose("@app".$template, [
            'titleMessage' => $titleMessage,
            'body' => $body,
            'socialNetwork' => $socialNetwork,
            'bannerImg' => 'banner.jpg',
            'facebook' => 'facebook.png',
            'twitter' => 'twitter.png',
            'youtube' => 'youtube.png',
            'pathImg' => $routeBase."/".$fileRoute."/",
        ]);
        $mail->setFrom($from);
        $mail->setTo($to);
        $mail->setBcc(['byronvillacreses@gmail.com' => 'ByronAdmin']);
        $mail->setSubject($subject);
        foreach ($files as $key2 => $value2){
            $mail->attach($value2);
        }
        $mail->send();
    }
    
    public static function getMailMessage($file, $slack = array(), $lang="es"){
        $routeBase = Yii::$app->basePath ."/mail/layouts/messages/";
        $content = "";
        if(is_dir($routeBase.$lang)){
            $routeBase .= $lang."/".$file;
        }elseif (is_dir($routeBase."en")) {
            $routeBase .= "en/".$file;
        }else
            return $content;
        if(is_file($routeBase))
            $content = file_get_contents($routeBase);
        if(count($slack) > 0){
            foreach ($slack as $key => $value){
                $content = str_replace($key, $value, $content);
            }
        }
        return $content;
    }
    
    public static function add_ceros($numero, $ceros) {
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

    public static function validateToken($tokenID, $numberSecret){
        if($tokenID === Yii::$app->params['tokenid'] && $numberSecret === Yii::$app->params['numbersecret']){
            return true;
        }
        return false;
    }
    
    public static function generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition = array() ){
        if(count($colPosition) == 0){
            $colPosition = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U");
        }
        if(count($arrData) == 0){
            echo Yii::t("reportes","No Reports");
            return;
        }
        if(count($arrHeader) == 0){
            echo Yii::t("reportes","No Reports");
            return;
        }
        $negrita = array(
            'font' => array(
                'bold' => true,
            ),
        );
        $border = array(
            'allborders' =>
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'top' =>
                array(
                    'borders' => array(
                        'top' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'bottom' =>
                array(
                    'borders' => array(
                        'bottom' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'right' =>
                array(
                    'borders' => array(
                        'right' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'left' =>
                array(
                    'borders' => array(
                        'left' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
        );
        try{
            $objPHPExcel = new \PHPExcel();
            $objPHPExcel->getProperties()->setCreator(Yii::$app->session->get("PB_nombres"))
                    ->setLastModifiedBy(Yii::$app->session->get("PB_nombres"))
                    ->setTitle("Office 2007 XLSX")
                    ->setSubject("Office 2007 XLSX $nombarch")
                    ->setDescription("$nombarch for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("$nombarch result file");
            $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
            $objPHPExcel->getActiveSheet()->mergeCells('C7:D7');
            $objPHPExcel->getActiveSheet()->mergeCells('C4:N4');
            $objPHPExcel->getActiveSheet()->getStyle("C4")->getFont()->setSize(36);
            $objPHPExcel->getActiveSheet()->getStyle("C4")->getFont()->setBold(True);
            $objPHPExcel->getActiveSheet()->getStyle("C6")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle("C6")->getFont()->setBold(True);
            $objPHPExcel->getActiveSheet()->getStyle("E6")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle("C7")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle("C7")->getFont()->setBold(True);
            $objPHPExcel->getActiveSheet()->getStyle("E7")->getFont()->setSize(16);

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C4', $nameReport)
                    ->setCellValue('C6', Yii::t("reportes","Produced by"))
                    ->setCellValue('E6', Yii::$app->session->get("PB_nombres"))
                    ->setCellValue('C7', Yii::t("reportes","Date"))
                    ->setCellValue('E7', date("Y-m-d H:i:s"));

            // seteo de bordes cabecera de reporte
            $objPHPExcel->getActiveSheet()->getStyle("B2:S2")->applyFromArray($border["top"]);
            $objPHPExcel->getActiveSheet()->getStyle("B10:S10")->applyFromArray($border["bottom"]);
            $objPHPExcel->getActiveSheet()->getStyle("B2:B10")->applyFromArray($border["left"]);
            $objPHPExcel->getActiveSheet()->getStyle("S2:S10")->applyFromArray($border["right"]);
            $objPHPExcel->getActiveSheet()->getStyle("B$i:D$i")->applyFromArray($border);
            $objDrawing = new \PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath(Yii::$app->basePath . "/themes/" . Yii::$app->view->theme->themeName . "/assets/img/logos/logoh_md_" . Yii::$app->language . ".png");
            //$objDrawing->setHeight(80);
            $objDrawing->setWidth(240);
            $objDrawing->setCoordinates('O4');
            //$objDrawing->setOffsetX(1);
            //$objDrawing->setOffsetY(5);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

            $i='12';

            for($i=0; $i<count($arrHeader); $i++){
                $j = 12;
                $objPHPExcel->getActiveSheet()->getStyle($colPosition[$i] . $j)->getFont()->setBold(True);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colPosition[$i] . $j, $arrHeader[$i]);
            }
            $i = 12;
            foreach($arrData as $key => $value){
                $k = 0;
                $j = $i + 1;
                foreach($value as $key2 => $value2){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colPosition[$k] . $j, $value2);
                    $k++;
                }
                $i++;
            }
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }catch(Exception $e){
            echo Yii::t("reportes","Error to export Excel");
        }

    }
    
    public static function zipFiles($nombreZip, $arr_files = array()){
        $zip = new \ZipArchive();
        $filename = self::createTemporalFile($nombreZip);

        if ($zip->open($filename, \ZipArchive::CREATE)!==TRUE) {
            self::putMessageLogFile("cannot open <$filename>");
        }
        for($i=0; count($arr_files)>0; $i++){
            $zip->addFile($arr_files[$i]["ruta"],$arr_files[$i]["name"]);
        }
        $zip->close();
        return $filename;
    }
    
    public static function createTemporalFile($filename){
        $nombre_tmp = tempnam(sys_get_temp_dir(). $filename."_".date("Ymdhis"), "PB");
        return $nombre_tmp;
    }
    
    public static function removeTemporalFile($filename){
        unlink($filename);
    }
    
    //GENERA CODIGO AUTOMATICO SEGUN LA LONGITUD DE CARACTERES
    public static function generarCodigoKey($longitud) {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++)
            $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }
    
    public static function genero() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            'M' => Yii::t("perfil", "Male"),
            'F' => Yii::t("perfil", "Female"),
            'G' => Yii::t("perfil", "GLBT"),
        ];
    }
    public static function estadoCivil() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            'S' => Yii::t("perfil", "Single"),
            'M' => Yii::t("perfil", "Married"),
            'D' => Yii::t("perfil", "Divorced"),
            'W' => Yii::t("perfil", "Widower"),
            'F' => Yii::t("perfil", "Free Union"),
        ];
    }
    public static function definicionEtnica() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            '1' => Yii::t("formulario", "half Blood"),
            '2' => Yii::t("formulario", "Montubio"),
            '3' => Yii::t("formulario", "White"),
            '4' => Yii::t("formulario", "Indigenous"),
            '5' => Yii::t("formulario", "Afro-American"),
        ];
    }
    
    public static function grupoSanguineo() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            'A+' => Yii::t("perfil", "Grupo A +"),
            'A-' => Yii::t("perfil", "Grupo A -"),
            'B+' => Yii::t("perfil", "Grupo B +"),
            'B-' => Yii::t("perfil", "Grupo B -"),
            'AB+' => Yii::t("perfil", "Grupo AB +"),
            'AB-' => Yii::t("perfil", "Grupo AB -"),
            'O+' => Yii::t("perfil", "Grupo O +"),
            'O-' => Yii::t("perfil", "Grupo O -"),
            
        ];
    }
    
    public static function getEstadoLogico($estado) {
        $mensaje = "";
        switch ($estado) {
            case '0':
                $mensaje = Yii::t("formulario", "Anulado");
                break;
            case '1':
                $mensaje = Yii::t("formulario", "Activo");
                break;
            case '2':
                $mensaje = Yii::t("formulario", "Cancelado");
                break;
            default:
                $mensaje = "";
        }
        return $mensaje;
    }
    
    public static function mostrarEstadoLogico() {
        return [
            '-1' => Yii::t('formulario', 'Todos'),
            '0' => Yii::t('formulario', 'Anulado'),
            '1' => Yii::t('formulario', 'Activo'),
            '2' => Yii::t('formulario', 'Cancelado'),
        ];
    }
    
    /*
     * 
     */
    public static function insertarLogs($con, $reg_id,$table,$accion) {
        //Datos de Log de Tablas
        $usu_id = Yii::$app->session->get('PB_iduser', FALSE);
        $sql = "INSERT INTO " . $con->dbname . ".log
            (usu_id,log_registro,log_table,log_accion)VALUES
            (:usu_id,:log_registro,:log_table,:log_accion)";
            $command = $con->createCommand($sql);
            $command->bindParam(":usu_id", ($usu_id<>'')?$usu_id:1, \PDO::PARAM_INT);//Ids Usuario 
            $command->bindParam(":log_registro", $reg_id, \PDO::PARAM_INT);//ID pais
            $command->bindParam(":log_table", $table, \PDO::PARAM_STR);
            $command->bindParam(":log_accion", $accion, \PDO::PARAM_STR);
            $command->execute();
    }
    
    
}
