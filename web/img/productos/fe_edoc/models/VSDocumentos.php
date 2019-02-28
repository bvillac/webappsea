<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\fe_edoc\models;

use Yii;

class VSDocumentos extends \app\modules\fe_edoc\components\CActiveRecord{
    
    public static function corregirDocSEA($Ids, $tipDoc) {
        //NOTA: VERIFICAR QUE CUANDO SE ELIMINE EN EN LAS TABLAS INTERMEDIAS TAMBIEN SE REALIQUE EN LA APP de Escritorio
        $errAuto= new VSexception();
        $con = Yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            switch ($tipDoc) {
                Case "FA"://FACTURAS
                    $sql = "UPDATE " . $con->dbname . ".VC010101 SET ENV_DOC=0 WHERE ENV_DOC='$Ids';";
                    break;
                Case "GR"://GUIAS DE REMISION
                    $sql = "UPDATE " . $con->dbname . ".IG0045 SET ENV_DOC=0 WHERE ENV_DOC='$Ids';";
                    break;
                Case "CO"://RETENCIONES
                    $sql = "UPDATE " . $con->dbname . ".IG0050 SET ENV_DOC=0 WHERE ENV_DOC='$Ids';";
                    break;
                Case "PP"://RETENCIONES
                    $sql = "UPDATE " . $con->dbname . ".IG0054 SET ENV_DOC=0 WHERE ENV_DOC='$Ids';";
                    break;
                Case "NC"://NOTAS DE CREDITO
                    $sql = "UPDATE " . $con->dbname . ".IG0060 SET ENV_DOC=0 WHERE ENV_DOC='$Ids';";
                    break;
                Case "ND"://NOTAS DE DEBITO
                    //$sql = "UPDATE " . $con->dbname . ".NubeFactura SET ENV_DOC=0 WHERE ENV_DOC='$Ids';";
                    break;
            }
            //VSValidador::putMessageLogFile($sql);
            if ($sql <> '') {//Verifica si Existe Sentencia SQL
                $comando = $con->createCommand($sql);
                $comando->execute();
                $trans->commit();
                //return true;
                return $errAuto->messageSystem('OK', null,12,null, null);
            } else {
                //return true;
                return $errAuto->messageSystem('NO_OK',null, 1, null, null);
            }
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            $trans->rollBack();
            throw $e;
            //return false;
            return $errAuto->messageSystem('NO_OK',null, 1, null, null);
        }
    }
    
    public static function anularDodSri($Ids,$tipDoc,$Estado) {
        //Vefificar si se Actualiza en las 2 base de Datos
        //5 = ELIMINADO DEL SISTEMA
        //8 = DOCUMENTO ANULADO AUTORIZADO EN SRI Y WEBSEA
        $errAuto= new VSexception();
        $con = Yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            switch ($tipDoc) {
                    Case "FA"://FACTURAS
                        $sql = "UPDATE " . $con->dbname . ".NubeFactura SET Estado='$Estado' WHERE IdFactura='$Ids';";
                        break;
                    Case "GR"://GUIAS DE REMISION
                        $sql = "UPDATE " . $con->dbname . ".NubeGuiaRemision SET Estado='$Estado' WHERE IdGuiaRemision='$Ids';";
                        break;
                    Case "RT"://RETENCIONES
                        $sql = "UPDATE " . $con->dbname . ".NubeRetencion SET Estado='$Estado' WHERE IdRetencion='$Ids';";
                        break;
                    Case "NC"://NOTAS DE CREDITO
                        $sql = "UPDATE " . $con->dbname . ".NubeNotaCredito SET Estado='$Estado' WHERE IdNotaCredito='$Ids';";
                        break;
                    Case "ND"://NOTAS DE DEBITO
                        //$sql = "UPDATE " . $con->dbname . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                }
            //VSValidador::putMessageLogFile($sql);
            if ($sql <> '') {//Verifica si Existe Sentencia SQL
                $comando = $con->createCommand($sql);
                $comando->execute();
                $trans->commit();
                //return true;
                return $errAuto->messageSystem('OK', null,13,null, null);
            } else {
                //return false;
                return $errAuto->messageSystem('NO_OK',null, 1, null, null);
            }
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            $trans->rollBack();
            throw $e;
            //return false;
            return $errAuto->messageSystem('NO_OK',null, 1, null, null);
        }
    }
    
    public static function reenviarDodSri($Ids,$tipDoc,$Estado) {
        //2 = ESTE ESTADO PERMITE QUE SE REENVIE EL CORREO
        $errAuto= new VSexception();
        $con = Yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            switch ($tipDoc) {
                    Case "FA"://FACTURAS
                        $sql = "UPDATE " . $con->dbname . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                    Case "GR"://GUIAS DE REMISION
                        $sql = "UPDATE " . $con->dbname . ".NubeGuiaRemision SET EstadoEnv='$Estado' WHERE IdGuiaRemision='$Ids';";
                        break;
                    Case "RT"://RETENCIONES
                        $sql = "UPDATE " . $con->dbname . ".NubeRetencion SET EstadoEnv='$Estado' WHERE IdRetencion='$Ids';";
                        break;
                    Case "NC"://NOTAS DE CREDITO
                        $sql = "UPDATE " . $con->dbname . ".NubeNotaCredito SET EstadoEnv='$Estado' WHERE IdNotaCredito='$Ids';";
                        break;
                    Case "ND"://NOTAS DE DEBITO
                        //$sql = "UPDATE " . $con->dbname . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                }
            //VSValidador::putMessageLogFile($sql);
            if ($sql <> '') {//Verifica si Existe Sentencia SQL
                $comando = $con->createCommand($sql);
                $comando->execute();
                $trans->commit();
                //return true;
                return $errAuto->messageSystem('OK', null,44,null, null);
            } else {
                //return false;
                return $errAuto->messageSystem('NO_OK',null, 1, null, null);
            }
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            $trans->rollBack();
            throw $e;
            //return false;
            return $errAuto->messageSystem('NO_OK',null, 1, null, null);
        }
    }
    
    public static function enviarInfoDodSri($Ids,$tipDoc) {
        //ALTER TABLE `APPWEB`.`EMPRESA` CHANGE COLUMN `EMP_EMAIL_DIGITAL` `EMP_EMAIL_DIGITAL` VARCHAR(60) NULL DEFAULT NULL  , ADD COLUMN `EMP_EMAIL_CONTA` VARCHAR(60) NULL  AFTER `EMP_EMAIL_DIGITAL` ;
        //UPDATE `APPWEB`.`EMPRESA` SET `EMP_EMAIL_CONTA`='lmizhquero@utimpor.com' WHERE `EMP_ID`='1';
        $rawData = array();
        $con = Yii::$app->db_edoc;
            switch ($tipDoc) {
                    Case "FA"://FACTURAS
                        $sql = "SELECT A.ClaveAcceso,A.AutorizacionSRI,A.FechaAutorizacion,A.IdentificacionComprador Identificacion,
                                        A.RazonSocialComprador RazonSocial,A.NombreDocumento,B.USU_CORREO Correo,A.USU_ID UsuId
                                        FROM " . $con->dbname . ".NubeFactura A
                                                INNER JOIN APPWEB.USUARIO B ON B.USU_NOMBRE=A.IdentificacionComprador
                                WHERE A.IdFactura='$Ids' AND A.Estado IN(2,8) ";                        
                        break;
                    Case "GR"://GUIAS DE REMISION
                        $sql = "SELECT A.ClaveAcceso,A.AutorizacionSRI,A.FechaAutorizacion,A.IdentificacionTransportista Identificacion,
                                        A.RazonSocialTransportista RazonSocial,A.NombreDocumento,B.USU_CORREO Correo,A.USU_ID UsuId
                                        FROM " . $con->dbname . ".NubeGuiaRemision A
                                                INNER JOIN APPWEB.USUARIO B ON B.USU_NOMBRE=A.IdentificacionTransportista
                                WHERE A.IdGuiaRemision='$Ids' AND A.Estado IN(2,8) ";    
                        break;
                    Case "RT"://RETENCIONES
                        $sql = "SELECT A.ClaveAcceso,A.AutorizacionSRI,A.FechaAutorizacion,A.IdentificacionSujetoRetenido Identificacion,
                                        A.RazonSocialSujetoRetenido RazonSocial,A.NombreDocumento,B.USU_CORREO Correo,A.USU_ID UsuId
                                        FROM " . $con->dbname . ".NubeRetencion A
                                                INNER JOIN APPWEB.USUARIO B ON B.USU_NOMBRE=A.IdentificacionSujetoRetenido
                                WHERE A.IdRetencion='$Ids' AND A.Estado IN(2,8) "; 
                        break;
                    Case "NC"://NOTAS DE CREDITO
                        $sql = "SELECT A.ClaveAcceso,A.AutorizacionSRI,A.FechaAutorizacion,A.IdentificacionComprador Identificacion,
                                        A.RazonSocialComprador RazonSocial,A.NombreDocumento,B.USU_CORREO Correo,A.USU_ID UsuId
                                        FROM " . $con->dbname . ".NubeNotaCredito A
                                                INNER JOIN APPWEB.USUARIO B ON B.USU_NOMBRE=A.IdentificacionComprador
                                WHERE A.IdNotaCredito='$Ids' AND A.Estado IN(2,8) ";
                        break;
                    Case "ND"://NOTAS DE DEBITO
                        //$sql = "UPDATE " . $con->dbname . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                }
                //$cabFact["Estado"];
            //$rawData = $con->createCommand($sql)->queryAll();
            $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
            return $rawData;
    }
    
    public static function buscarDatoVendedor($vend_id) {
        $rawData = array();
        $conApp = Yii::$app->db;
        $sql = "SELECT u.usu_user NombreUser, u.usu_user Alias, p.per_correo CorreoUser FROM " . $conApp->dbname . ".usuario u inner join " . $conApp->dbname . ".persona p on p.per_id=u.per_id WHERE usu_id='$vend_id';";
        $rawData = $conApp->createCommand($sql)->queryOne();  //Un solo Registro => $rawData['RazonSocial']
        return $rawData;
    }

}
