<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of CabListapedidosTemp
 *
 * @author root
 */
use Yii;
use yii\helpers\Url;

class CabListapedidosTemp {
    //put your code here
    
    public function insertarLista($dtsCab,$dtsDet) {
        //$msg = new VSexception();
        //$valida = new VSValidador();
        
        $arroout = array();
        $con = \Yii::$app->db_tienda;
        $trans = $con->beginTransaction();
        try {            
            $idCab=$this->InsertarCabListPedTemp($con,$dtsCab,$usuario);
            $this->InsertarDetListPedTemp($con,$idCab,$dtsDet,$usuario);            
            $trans->commit();
            $con->close();
            
            //Envio de correo
            $nombres = $dtsCab[0]['per_nombre'];
            $tituloMensaje = Yii::t("register","Pedidos Exitoso");
            $asunto = Yii::t("register", "Ha Recibido un(a) Orden Nuevo(a)!!!") . " " . Yii::$app->params["siteName"];
            $body = Utilities::getMailMessage("formatoPedidos", array("[[user]]" => $nombres, "[[username]]" => $dtsCab[0]['per_correo'],
                            "[[Orden]]" => $idCab,"[[Total]]" => $dtsCab[0]['val_net']), Yii::$app->language);
            Utilities::sendEmail($tituloMensaje, Yii::$app->params["no-responder"], 
                                    [$dtsCab[0]['per_correo'] => $dtsCab[0]['per_nombre'] . " " . $dtsCab[0]['per_apellido']],
                                    [],//Bcc
                                    $asunto, $body);
            
            //RETORNA DATOS 
            $arroout["ids"]= $idCab;
            $arroout["status"]= true;
            //$arroout["secuencial"]= $doc_numero;
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
        }
    }

    
    private function InsertarCabListPedTemp($con,$data,$usuario) {         
        
        //ids_clis
        $cli_id=1;
        $cod_cli='9999999999';
        $atiende='01';
        $ids_lre=1;
        $nom_clis='LISTA 1';
        
        $por_des=0;
        $val_des=0;
        $val_fle=0;
        $bas_iva=0;
        $bas_iv0=0;
        $por_iva=12;
        $val_iva=0;
        $val_net=$data[0]['val_net'];
        $est_ped='PD';
        $est_ped='1';
        //Utilities::putMessageLogFile($data[0]['val_net']);

        $sql = "INSERT INTO " . $con->dbname . ".cab_listapedidos_temp
            (cli_id,cod_cli,atiende,tip_doc,num_doc,ids_lre,nom_clis,dir_entrega,val_bru,por_des,
             val_des,val_fle,bas_iva,bas_iv0,por_iva,val_iva,val_net,est_ped,est_log,usuario)VALUES
            (:cli_id,:cod_cli,:atiende,:tip_doc,:num_doc,:ids_lre,:nom_clis,:dir_entrega,:val_bru,:por_des,
             :val_des,:val_fle,:bas_iva,:bas_iv0,:por_iva,:val_iva,:val_net,:est_ped,:est_log,:usuario)";
        $command = $con->createCommand($sql);

        //$command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":cli_id",$cli_id, \PDO::PARAM_INT);
        $command->bindParam(":cod_cli",$cod_cli, \PDO::PARAM_STR);
        $command->bindParam(":atiende",$atiende, \PDO::PARAM_STR);
        $command->bindParam(":tip_doc", $data[0]['tip_doc'], \PDO::PARAM_STR);
        $command->bindParam(":num_doc", $data[0]['num_doc'], \PDO::PARAM_STR);
        $command->bindParam(":ids_lre", $ids_lre, \PDO::PARAM_STR);
        $command->bindParam(":nom_clis", $nom_clis, \PDO::PARAM_STR);
        $command->bindParam(":dir_entrega", $data[0]['dper_direccion'], \PDO::PARAM_STR);        
        $command->bindParam(":val_bru", $data[0]['val_bru'], \PDO::PARAM_STR);
        $command->bindParam(":por_des", $por_des, \PDO::PARAM_STR);
        $command->bindParam(":val_des", $val_des, \PDO::PARAM_STR);
        $command->bindParam(":val_fle", $val_fle, \PDO::PARAM_STR);
        $command->bindParam(":val_des", $val_des, \PDO::PARAM_STR);
        $command->bindParam(":bas_iva", $bas_iva, \PDO::PARAM_STR);
        $command->bindParam(":bas_iv0", $bas_iv0, \PDO::PARAM_STR);
        $command->bindParam(":por_iva", $por_iva, \PDO::PARAM_STR);
        $command->bindParam(":val_iva", $val_iva, \PDO::PARAM_STR);
        $command->bindParam(":val_net", $val_net, \PDO::PARAM_STR);
        $command->bindParam(":est_ped", $est_ped, \PDO::PARAM_STR);
        $command->bindParam(":est_log", $est_log, \PDO::PARAM_STR);
        $command->bindParam(":usuario", $usuario, \PDO::PARAM_STR);
        $command->execute();
        return $con->getLastInsertID();
    }
    
    private function InsertarDetListPedTemp($con,$idCab,$dtsDet,$usuario) {
        //Utilities::putMessageLogFile($dtsDet);
        //ids_dlis
        $por_iva=0;
        $idDet=0;        
        $ids_pre=1;       
  
        for ($i = 0; $i < sizeof($dtsDet); $i++) {             
            $cli_id=$dtsDet[$i]['cli_id'];
            $sql = "INSERT INTO " . $con->dbname . ".det_listapedidos_temp                
                    (ids_clis,ids_pre,ids_pro,cod_art,tip_doc,num_doc,cli_id,p_venta,can_des,
                     t_venta,por_des,val_des,i_m_iva,val_iva,est_ped,est_log, usuario) VALUES
                    (:ids_clis,:ids_pre,:ids_pro,:cod_art,:tip_doc,:num_doc,:cli_id,:p_venta,:can_des,
                     :t_venta,:por_des,:val_des,:i_m_iva,:val_iva,:est_ped,:est_log,:usuario);";
            $comando = $con->createCommand($sql);
            $comando->bindParam(":ids_clis", $idCab, \PDO::PARAM_INT);
            $comando->bindParam(":ids_pre", $ids_pre, \PDO::PARAM_INT);
            $comando->bindParam(":ids_pro", $dtsDet[$i]['ids_pro'], \PDO::PARAM_INT);
            $comando->bindParam(":cod_art", $dtsDet[$i]['cod_art'], \PDO::PARAM_STR);
            $comando->bindParam(":tip_doc", $dtsDet[$i]['tip_doc'], \PDO::PARAM_STR);
            $comando->bindParam(":num_doc", $dtsDet[$i]['num_doc'], \PDO::PARAM_STR);
            $comando->bindParam(":cli_id", $cli_id, \PDO::PARAM_INT);
            $comando->bindParam(":p_venta", $dtsDet[$i]['p_venta'], \PDO::PARAM_STR);
            $comando->bindParam(":can_des", $dtsDet[$i]['can_des'], \PDO::PARAM_STR);
            $comando->bindParam(":t_venta", $dtsDet[$i]['t_venta'], \PDO::PARAM_STR);
            $comando->bindParam(":por_des", $dtsDet[$i]['por_des'], \PDO::PARAM_STR);
            $comando->bindParam(":val_des", $dtsDet[$i]['val_des'], \PDO::PARAM_STR);
            $comando->bindParam(":i_m_iva", $dtsDet[$i]['i_m_iva'], \PDO::PARAM_STR);
            $comando->bindParam(":val_iva", $dtsDet[$i]['val_iva'], \PDO::PARAM_STR);
            $comando->bindParam(":est_ped", $dtsDet[$i]['est_ped'], \PDO::PARAM_STR);
            $comando->bindParam(":est_log", $dtsDet[$i]['est_log'], \PDO::PARAM_STR);
            $comando->bindParam(":usuario", $usuario, \PDO::PARAM_INT);
            $comando->execute();
            $idDet = $con->getLastInsertID();
        }
       
    }
    
    
}
