<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\fe_edoc\models;

use Yii;

Yii::import('system.vendors.PHPMailer.*'); //Usar de Forma nativa.
require_once('PHPMailerAutoload.php');

class mailSystem {
    private $domEmpresa='uteg.edu.ed';
    private $mailSMTP='mail.uteg.edu.ed';
    private $noResponder='no-responder@uteg.edu.ec';
    private $noResponderPass='xxxxxxx';
    private $port=465;
    private $charSet='UTF-8';


    //put your code here
    public function enviarMail($body,$CabPed) {
        $msg = new VSexception();
        $mail = new PHPMailer();
        //$body = "Hola como estas";

        $mail->IsSMTP();
        //Para tls
        //$mail->SMTPSecure = 'tls';
        //$mail->Port = 587;
        //Para ssl
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        // la dirección del servidor, p. ej.: smtp.servidor.com
        $mail->Host = "mail.utimpor.com";

        // dirección remitente, p. ej.: no-responder@miempresa.com
        // nombre remitente, p. ej.: "Servicio de envío automático"
        $mail->setFrom('no-responder@utimpor.com', 'Servicio de envío automático Utimpor.com');
        //$mail->setFrom('bvillacreses@utimpor.com', 'Utimpor.com');

        // asunto y cuerpo alternativo del mensaje
        $mail->Subject = "Ha Recibido un(a) Orden Nuevo(a)!!!";
        $mail->AltBody = "Data alternativao";

        // si el cuerpo del mensaje es HTML
        $mail->MsgHTML($body);

        // podemos hacer varios AddAdress 
        $mail->AddAddress($CabPed[0]["CorreoUser"], $CabPed[0]["NombreUser"]);//Usuario Autoriza Pedido
        $mail->AddAddress($CabPed[0]["CorreoPersona"], $CabPed[0]["NombrePersona"]);//Usuario Genera Pedido
        //$mail->AddAddress("byron_villacresesf@hotmail.com", "Byron Villa");
        //$mail->AddAddress("byronvillacreses@gmail.com", "Byron Villa");
        
        /******** COPIA OCULTA PARA VENTAS  ***************/
        $mail->addBCC('ventas@uteg.edu.ec', 'Ventas Uteg'); //Para copia Oculta
        
        $mail->addBCC('admin@uteg.edu.ec', 'Admin'); //Para con copia
        //$mail->addCC('byronvillacreses@gmail.com', 'ByronV'); //Para con copia
        //$mail->addReplyTo('byronvillacreses@gmail.com', 'First Last');
        //
        // si el SMTP necesita autenticación
        $mail->SMTPAuth = true;

        // credenciales usuario
        $mail->Username = $this->noResponder;
        $mail->Password = $this->noResponderPass;
        $mail->CharSet = $this->charSet;

        if (!$mail->Send()) {
            //echo "Error enviando: " . $mail->ErrorInfo;
            return $msg->messageSystem('NO_OK', "Error enviando: " . $mail->ErrorInfo, 11, null, null);
        } else {
            //echo "¡¡Enviado!!";
            return $msg->messageSystem('OK', "¡¡Enviado!!", 30, null, null);
        }
    }
    
    public function enviarMailInforma($body,$CabPed,$DatVen,$Subject,$op) {
        $msg = new VSexception();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPSecure = "ssl";
        $mail->Port = $this->port;
        $mail->Host = $this->mailSMTP;
        $mail->setFrom($this->noResponder, 'Servicio de envío automático '.$this->domEmpresa);
        $mail->Subject = $Subject;
        $mail->MsgHTML($body);        
        switch ($op) {
            Case 1://NOTIFICA A USUARIOS DEL SISTEMA WEBSEA PARA ANULACION
                $mail->AddAddress($DatVen["CorreoUser"], $DatVen["NombreUser"]);//Usuario Genera Pedido        
                $mail->AddAddress(Yii::$app->session->get('CorreoConta', FALSE), "Contabiliad");
                break;
            Case 2://NOTIFICA A CLIENTES
                //$mail->AddAddress($CabPed[0]["CorreoUser"], $CabPed[0]["NombreUser"]);//Usuario Autoriza Pedido
                break;
            default:
                //NOTIFICA ADMINISTRADOR
                $mail->AddAddress("admin@uteg.edu.ec", "Admin");
        }
        // si el SMTP necesita autenticación
        $mail->SMTPAuth = true;
        // credenciales usuario
        $mail->Username = $this->noResponder;
        $mail->Password = $this->noResponderPass;
        $mail->CharSet = $this->charSet;

        if (!$mail->Send()) {
            return $msg->messageSystem('NO_OK', "Error enviando: " . $mail->ErrorInfo, 11, null, null);
        } else {
            //echo "¡¡Enviado!!";
            return $msg->messageSystem('OK', "¡¡Enviado!!", 30, null, null);
        }
    }

}
