<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('PHPMailerAutoload.php');
class mailSystem {
    private $domEmpresa='uteg.edu.ec';
    private $mailSMTP='mail.uteg.edu.ec';
    //private $noResponder='no-responder@uteg.edu.ec';
    private $noResponder='developer@uteg.edu.ec';
    private $adminMail='developer@uteg.edu.ec';//Cambiar 
    private $noResponderPass='developer1806';//Clave de correo NO responder
    public $Subject='Ha Recibido un(a)  Nuevo(a)!!! ';
    public $file_to_attachXML='';
    public $file_to_attachPDF='';
    public $fileXML='';
    public $filePDF='';
    
    //Valida si es un Email Correcto Devuelve True
    private function valid_email($val) {
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    //put your code here
    public function enviarMail($body,$CabPed,$obj_var,$usuData,$fil) {
        $mail = new PHPMailer();
        
        $mail->IsSMTP();
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        // la dirección del servidor, p. ej.: smtp.servidor.com
        $mail->Host = $this->mailSMTP;
        $mail->setFrom($this->noResponder, 'Servicio de envío automático '.$this->domEmpresa);

        // asunto y cuerpo alternativo del mensaje
        $mail->Subject = $this->Subject;
        $mail->AltBody = "Data alternativao";

        // si el cuerpo del mensaje es HTML
        $mail->MsgHTML($body);
        
        //##############################################
        //Separa en Array los Correos Ingresados para enviar
        $DataCorreos = (trim($CabPed[$fil]["CorreoPer"])!='')?explode(";",$CabPed[$fil]["CorreoPer"]):0;
        for ($icor = 0; $icor < count($DataCorreos); $icor++) {
            if ($this->valid_email(trim($DataCorreos[$icor]))) {//Verifica Email Correcto
                $mail->AddAddress(trim($DataCorreos[$icor]), trim($CabPed[$fil]["RazonSoc"]));
            }else{
                //Correos Alternativos de admin  $adminMail
                $mail->addBCC("byron_villacresesf@hotmail.com", "Byron Villa");
                //$mail->addBCC($usuData["CorreoUser"], $usuData["NombreUser"]);//Enviar Correos del Vendedor
            }
        }
        //if($DataCorreos==0){
            //Correos Alternativos de admin  $adminMail
            $mail->addBCC("bvillacreses@utimpor.com", "Byron Villa");
            //$mail->addBCC($usuData["CorreoUser"], $usuData["NombreUser"]);//Enviar Correos del Vendedor
        //}
        
     
        
        /******** COPIA OCULTA PARA VENTAS  ***************/
        //$mail->addBCC('byronvillacreses@gmail.com', 'Byron Villa'); //Para con copia
        
        //$mail->AddAttachment("archivo.zip");//adjuntos un archivo al mensaje
        $mail->AddAttachment($this->file_to_attachXML.$this->fileXML,$this->fileXML);
        $mail->AddAttachment($this->file_to_attachPDF.$this->filePDF,$this->filePDF);
        // si el SMTP necesita autenticación
        $mail->SMTPAuth = true;

        // credenciales usuario
        $mail->Username = $this->noResponder;
        $mail->Password = $this->noResponderPass;
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 1;//Muestra el Error

        if (!$mail->Send()) {
            //echo "Error enviando: " . $mail->ErrorInfo;
            return $obj_var->messageSystem('NO_OK', "Error enviando: " . $mail->ErrorInfo, null, null, null);
        } else {
            //echo "¡¡Enviado!!";
            return $obj_var->messageSystem('OK', "¡¡Enviado!!", null, null, null);
        }
    }
    
    public function enviarMailError($DocData) {
        $mail = new PHPMailer();
        $body = 'Error en Documento '.$DocData["tipo"].'-'.$DocData["NumDoc"].'<BR>';
        $body .= 'Error '.$DocData["Error"];
        
        $mail->IsSMTP();
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->Host = $this->mailSMTP;//"mail.utimpor.com";
        $mail->setFrom($this->noResponder, 'Error Servicio de envío automático '.$this->domEmpresa);

        // asunto y cuerpo alternativo del mensaje
        $mail->Subject = $this->Subject;
        $mail->AltBody = "Data alternativao";

        // si el cuerpo del mensaje es HTML
        $mail->MsgHTML($body);
        $mail->AddAddress("bvillacreses@utimpor.com", "Ing.Byron Villa");

        $mail->SMTPAuth = true;

        // credenciales usuario
        $mail->Username = $this->noResponder;
        $mail->Password = $this->noResponderPass;
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 1;//Muestra el Error
        
        $mail->Send();

        /*if (!$mail->Send()) {
            //echo "Error enviando: " . $mail->ErrorInfo;
            return $obj_var->messageSystem('NO_OK', "Error enviando: " . $mail->ErrorInfo, null, null, null);
        } else {
            //echo "¡¡Enviado!!";
            return $obj_var->messageSystem('OK', "¡¡Enviado!!", null, null, null);
        }*/
    }
    
    
    function sendEmail($from = "no-responder@uteg.edu.ec", $to = array(), $files = array(), $subject, $body, $smtpConfig = NULL, $titleMessage = "") {
        $mail = new PHPMailer;
        $smtpConfig = isset($smtpConfig) ? $smtpConfig : (getDataSMTPClient());
        //$mail->SMTPDebug = 3; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = $smtpConfig["Host"];
        $mail->SMTPAuth = isset($smtpConfig["SMTPAuth"]) ? $smtpConfig["SMTPAuth"] : true;
        $mail->Username = $this->noResponder;//$smtpConfig["Username"];
        $mail->Password = $this->noResponderPass;//$smtpConfig["Password"];
        //$mail->SMTPSecure = isset($smtpConfig["tls"])?$smtpConfig["tls"]:'tls';
        $mail->Port = 465;//$smtpConfig["Port"];                                    // TCP port to connect to

        $mail->From = isset($from) ? $from : ($this->$adminMail);
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
        $name = "UTEG";
        $cabecera_head = $name . ", " . "la solución que usted necesita";
        $browser_label = "Ver en su Browser";
        $copyright = "Copyright &copy; " . date("Y") . " UTEG";
        $label_mailing = "Nuestra dirección de email es: ";
        $webmail = $this->adminMail;
        $social = array("twitter" => "https://twitter.com", "facebook" => "https://www.facebook.com");
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

}
