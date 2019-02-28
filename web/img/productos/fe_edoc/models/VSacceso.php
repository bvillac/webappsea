<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VSacceso
 *
 * @author root
 */
namespace app\modules\fe_edoc\models;

use Yii;

class VSacceso {
    /*
    1 = ENVIADO BASE INTERMEDIA (NO ENVIADO)
    2 = RECIBIDO SRI 
    3 = AUTORIZADO SRI 
    4 = EN PROCESO (CLAVE DE ACCESO) Recibir
    5 = ELIMINADO DEL SISTEMA
    6 = RECHAZADO (NO AUTORIZADOS, NEGADO o DEVUELTAS) =>SOLUC VOLVER ENVIAR CON ESTADO 1
    8 = DOCUMENTO ANULADO
    9 = EN PROCESO (AUTORIZACION) DOCUMENTO*/

    public function tipoAprobacion() {
        return array(
            '1' => Yii::t('fe_edoc', 'No Send'),
            '2' => Yii::t('fe_edoc', 'Received'),
            '3' => Yii::t('fe_edoc', 'Authorized'),
            '4' => Yii::t('fe_edoc', 'In process Clave'),
            '9' => Yii::t('fe_edoc', 'In process Document'),
            '6' => Yii::t('fe_edoc', 'Unauthorized'),
            '8' => Yii::t('fe_edoc', 'invalidated'),
        );
    }

    public static function estadoAprobacion($estado) {
        switch ($estado) {
            Case "1":
                $valRes = Yii::t("fe_edoc", "No Send");
                break;
            Case "2":
                $valRes = Yii::t("fe_edoc", "Received");
                break;
            Case "3":
                $valRes = Yii::t("fe_edoc", "Authorized");
                break;
            Case "4":
                $valRes = Yii::t("fe_edoc", "In process Clave");
                break;
            Case "6":
                $valRes = Yii::t("fe_edoc", "Unauthorized");
                break;
            Case "8":
                $valRes = Yii::t("fe_edoc", "invalidated");
                break;
            Case "9":
                $valRes = Yii::t("fe_edoc", "In process Document");
                break;
            default:
                $valRes = "Error";
        }
        return $valRes;
    }

}
