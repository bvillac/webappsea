<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
// para que reconozca nuevas funciones del WS 
ini_set('soap.wsdl_cache_enable', 0);
ini_set('soap.wsdl_cache_ttl', 0);
$basePath = dirname(__FILE__);
$nuSoap = TRUE;
if ($nuSoap)
    require_once('libs/nusoap/nusoap.php');
require_once('libs/phpmailer/PHPMailerAutoload.php');
$linkHttp = "https://micuenta.planvital.ec/";
$wsPath = $linkHttp . "facturacionAdmin/fews/ws";
$timeSend = 5; // en segundos
$timeWait = 3; // en segundos
$directorios = array(
    "GENERADOS" => "$basePath/GENERADOS/",
    "PENDIENTES" => "$basePath/PENDIENTES/",
    "AUTORIZADOS" => "$basePath/AUTORIZADOS/",
    "RECHAZADOS" => "$basePath/RECHAZADOS/",
    "PROCESADOS" => "$basePath/PROCESADOS/"
);
$service = "gm-fe";
$mailUserClient = "hcueva@galgomedia.com";
$empresa = "Plan Vital";
$baseDaemon = "/opt/$service";
$logFile = "/var/log/$service.log";
try {
    $cliente = new SoapClient($wsPath);
} catch (Exception $e) {
    putMessageLogFile($e);
}
$arr_files_cola = array();
// Se debe preguntar si existen arhcivos en el directorio GENERADOS
while (true) {
    if (verificarDirectorio($directorios["GENERADOS"])) {
        $listGenerados = getListFilesXML($directorios["GENERADOS"]);
        //echo json_encode($listGenerados)."<br />";
        foreach ($listGenerados as $filename) {
            $file = $directorios["GENERADOS"] . $filename;
            if (is_file($file) && is_readable($file)) {
                $fileContent = file_get_contents($file);
                $fileEncoded = base64_encode($fileContent);
                try {
                    $resultado = $cliente->sendFileXML($filename, $fileEncoded);
                    if (is_array($resultado)) {
                        $estado = $resultado["response"];
                        if ($estado === "OK") {
                            // se debe mover archivo a directorio de pendientes
                            if (verificarDirectorio($directorios["PENDIENTES"])) {
                                rename($file, $directorios["PENDIENTES"] . $filename);
                            } else {
                                putMessageLogFile("Imposible mover archivo $file a directorio $directorios[PENDIENTES].");
                            }
                        } else {
                            putMessageLogFile("NO_OK: $estado.");
                        }
                    }
                } catch (Exception $e) {
                    putMessageLogFile("Imposible leer archivo $file.");
                }
            } else {
                putMessageLogFile("Imposible leer archivo $file.");
            }
            sleep($timeSend);
        }
        if (count($listGenerados) <= 0) {
            putMessageLogFile("No hay archivos que procesar.");
        }
    } else {
        putMessageLogFile("Imposible leer directorio $directorios[GENERADOS].");
    }
    sleep($timeWait);
    if (verificarDirectorio($directorios["RECHAZADOS"]) && verificarDirectorio($directorios["PROCESADOS"]) && verificarDirectorio($directorios["AUTORIZADOS"])) {
        try {
            $resultado = $cliente->getFileXML();
            if (is_array($resultado)) {
                $estado = $resultado["response"];
                if ($estado === "OK") {
                    // se debe mover archivo a directorio de pendientes
                    $file_name = $resultado["file"]["name"];
                    $file_Content = base64_decode($resultado["file"]["content"]);
                    $status = $resultado["file"]["status"];
                    if ($status == "AUT") {
                        putMessageLogFile("Se encontro un archivo autorizado: $file_name");
                        if (!file_put_contents($directorios["AUTORIZADOS"] . $file_name, $file_Content)) {
                            putMessageLogFile("Imposible escribir en directorio $directorios[AUTORIZADOS]");
                        } else {
                            if (!rename($directorios["PENDIENTES"] . $file_name, $directorios["PROCESADOS"] . $file_name)) {
                                putMessageLogFile("No se puede mover el archivo $directorios[PENDIENTES]$file_name a procesados");
                            } else {
                                putMessageLogFile("Se movio archivo de $directorios[PENDIENTES]$file_name a $directorios[PROCESADOS]$file_name");
                            }
                        }
                    } else {
                        putMessageLogFile("Se encontro un archivo rechazado: $file_name");
                        if (!file_put_contents($directorios["RECHAZADOS"] . $file_name, $file_Content)) {
                            putMessageLogFile("Imposible escribir en directorio $directorios[RECHAZADOS]");
                        } else {
                            if (!rename($directorios["PENDIENTES"] . $file_name, $directorios["PROCESADOS"] . $file_name)) {
                                putMessageLogFile("No se puede mover el archivo $directorios[PENDIENTES]$file_name a procesados");
                            } else {
                                putMessageLogFile("Se movio archivo de $directorios[PENDIENTES]$file_name a $directorios[PROCESADOS]$file_name");
                            }
                        }
                    }
                } else {
                    putMessageLogFile($estado);
                }
            }
        } catch (Exception $e) {
            putMessageLogFile("Un error fue encontrado.");
        } catch (SoapFault $fault) {
            putMessageLogFile("Un error fue encontrado. $fault");
        }
    }
    sleep($timeSend);
    if (verificarDirectorio($directorios["GENERADOS"]) && verificarDirectorio($directorios["PENDIENTES"])) {
        $listSearch1 = getListFilesXML($directorios["GENERADOS"]);
        $listSearch2 = getListFilesXML($directorios["PENDIENTES"]);
        $listSearch = array_merge($listSearch1, $listSearch2);
        foreach ($listSearch as $fileSearch) {
            $arr_fileNameData = array();
            if (preg_match("/^\d{14}_\d{6,7}_\d{9,10}_[\w,\d]{10,14}\.xml$/", strtolower($fileSearch))) {
                $arr_fileNameData = explode("_", str_replace("xml", "", strtolower($fileSearch)));
            }
            if (count($arr_fileNameData) < 4) {
                putMessageLogFile("El archivo con nombre no cumple con el formato $fileSearch.");
                $subject = "Facturación Electrónica: Error con archivo";
                $body = "El archivo con nombre no cumple con el formato $fileSearch.";
                sendEmail("facturacionelectronica@planvital.ec", array($mailUserClient), array($filename), $subject, $body);
            } else {
                $fechaEmision = date("Y-m-d H:i:s", strtotime($arr_fileNameData[0]));
                $establecimiento = substr($arr_fileNameData[1], 0, 3);
                $puntoEmision = substr($arr_fileNameData[1], 3, 3);
                $numFactura = $arr_fileNameData[2];
                $numeroDocuE = "$establecimiento-$puntoEmision-$numFactura";
                $identificacion = $arr_fileNameData[3];
                $segundos = strtotime('now') - strtotime($fechaEmision);
                $diferencia_dias = intval($segundos / 60 / 60 / 24);
                if ($diferencia_dias >= 1 && !in_array($filename, $arr_files_cola)) {
                    if (count($arr_files_cola) > 100) {
                        $arr_files_cola = array();
                    }
                    $arr_files_cola[] = $filename;
                    putMessageLogFile("Enviando Correo documento electronico ya tiene mas de un día sin autorizar: $fileSearch.");
                    $subject = "Facturación Electrónica: Error con archivo";
                    $body = "El documento electronico ya tiene mas de un día sin autorizar. El nombre del documento es: $fileSearch.";
                    sendEmail("facturacionelectronica@planvital.ec", array($mailUserClient), array($filename), $subject, $body);
                }
            }
        }
    }
    sleep($timeWait);
}

// proceso de verificacion de archivos Rechazados y Autorizados


function getListFilesXML($dir) {
    $arr_files = array();
    $listFiles = scandir($dir);
    foreach ($listFiles as $key) {
        if (preg_match("/\.xml$/", strtolower(trim($key)))) {
            $arr_files[] = $key;
        }
    }
    return $arr_files;
}

function verificarDirectorio($dir) {
    if (!is_dir($dir)) {
        if (mkdir(dirname($dir), 0777, true))
            return true;
        else
            return false;
    }
    return true;
}

function putMessageLogFile($message) {
    GLOBAL $logFile;
    if (is_array($message))
        $message = json_encode($message);
    $message = date("Y-m-d H:i:s") . " " . $message . "\r\n";
    if ((filesize($logFile) / pow(1024, 2)) > 100) { // si el log es mayor a 100 MB entonces se debe limpiar el archivo
        file_put_contents($logFile, $message, LOCK_EX);
    } else {
        file_put_contents($logFile, $message, FILE_APPEND | LOCK_EX);
    }
}

function sendEmail($from = "admin@galgomedia.com", $to = array(), $files = array(), $subject, $body, $smtpConfig = NULL, $titleMessage = "") {
    $mail = new PHPMailer;
    $smtpConfig = isset($smtpConfig) ? $smtpConfig : (getDataSMTPClient());
    //$mail->SMTPDebug = 3; // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = $smtpConfig["Host"];
    $mail->SMTPAuth = isset($smtpConfig["SMTPAuth"]) ? $smtpConfig["SMTPAuth"] : true;
    $mail->Username = $smtpConfig["Username"];
    $mail->Password = $smtpConfig["Password"];
    //$mail->SMTPSecure = isset($smtpConfig["tls"])?$smtpConfig["tls"]:'tls';
    $mail->Port = $smtpConfig["Port"];                                    // TCP port to connect to

    $mail->From = isset($from) ? $from : (Yii::app()->params["adminEmail"]);
    $mail->CharSet = "UTF-8";
    $arr_mail = explode("@", $from);
    $mail->FromName = $arr_mail[0];
    if (count($to) > 0) {
        for ($i = 0; $i < count($to); $i++) {
            $mail->addAddress($to[$i]);
        }
    }

    if (count($files) > 0 && is_array($files)) {
        for ($i = 0; $i < count($files); $i++) {
            if (is_array($files[$i])) {
                $item = $files[$i];
                $content = $item["content"];
                $mime = $item["mime-type"];
                $name = $item["name"];
                $mail->addStringAttachment($content, $name, "base64", $mime);
            } else
                $mail->addAttachment($files[$i]);
        }
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    }

    // adjunta files/imagen.jpg
    $ruta_images = dirname(__FILE__) . DIRECTORY_SEPARATOR . "/layouts/images/";
    $mail->AddEmbeddedImage($ruta_images . "logo.png", 'logo', 'file/logo.png');
    $mail->AddEmbeddedImage($ruta_images . "fb.png", 'facebook', 'file/facebook.png');
    $mail->AddEmbeddedImage($ruta_images . "tw.png", 'twitter', 'file/twitter.png');
    $mail->AddEmbeddedImage($ruta_images . "banner.jpg", 'banner', 'file/banner.jpg');
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = printFormatEmailClient($body);
    $mail->AltBody = $body;

    if (!$mail->send()) {
        putMessageLogFile("Message could not be sent. Mailer Error: " . $mail->ErrorInfo);
        return FALSE;
    } else {
        return TRUE;
    }
}

function printFormatEmailClient($message, $titleMessage = "") {
    Global $empresa;
    $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . "/layouts/mailing.php";
    if ($titleMessage == "")
        $titleMessage = "Facturación Electrónica";
    $name = "Plan Vital";
    $cabecera_head = $name . ", " . "la solución que usted necesita";
    $browser_label = "Ver en su Browser";
    $copyright = "Copyright &copy; " . date("Y") . " Plan Vital S.A";
    $label_mailing = "Nuestra dirección de email es: ";
    $webmail = "info@planvital.ec";
    $social = array("twitter" => "https://twitter.com/planvitalec", "facebook" => "https://www.facebook.com/planvital");
    $twitter = $social["twitter"];
    $facebook = $social["facebook"];

    $message = str_replace("\\n", "<br />", $message);
    $message = str_replace("\n", "<br />", $message);
    $content = file_get_contents($file);
    $content = str_replace("[[NAME]]", $name, $content);
    $content = str_replace("[[TITLE]]", htmlentities($titleMessage), $content);
    $content = str_replace("[[CABECERA_HEAD]]", htmlentities($cabecera_head), $content);
    $content = str_replace("[[BROWSER_LABEL]]", htmlentities($browser_label), $content);

    $content = str_replace("[[FACEBOOK]]", htmlentities($facebook), $content);
    $content = str_replace("[[TWITTER]]", htmlentities($twitter), $content);
    $content = str_replace("[[WEBMAIL]]", htmlentities($webmail), $content);
    $content = str_replace("[[COPYRIGHT]]", $copyright, $content);
    $content = str_replace("[[LABEL_MAILING]]", htmlentities($label_mailing), $content);

    $content = str_replace("[[MESSAGE]]", $message, $content);

    return $content;
}

function getDataSMTPClient() {
    $data["Host"] = "mail.planvital.ec"; //"secure103.inmotionhosting.com";
    $data["SMTPAuth"] = true;
    $data["Username"] = "facturacionelectronica@planvital.ec";
    $data["Password"] = "Factura2o15";
    //$data["SMTPSecure"] = "ssl"; // Enable TLS encryption, `ssl` also accepted
    $data["Port"] = "587"; //"465";
    return $data;
}

?>