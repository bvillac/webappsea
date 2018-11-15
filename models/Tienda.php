<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Tienda
 *
 * @author root
 */

use yii;
use yii\data\ArrayDataProvider;

class Tienda {
    //put your code here
    
    public static function getMarcaTienda(){
        $con = \Yii::$app->db_tienda;
        $sql="SELECT A.ids_mar,A.cod_mar,A.nom_mar,
                (SELECT COUNT(*) FROM " . $con->dbname . ".productos B WHERE B.est_log=1 AND B.ids_mar=A.ids_mar) rcount
            FROM " . $con->dbname . ".marca A WHERE A.est_log=1 AND A.est_web=1;";
        $comando = $con->createCommand($sql);
        //$comando->bindParam(":med_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public static function getProductoTienda($data){
        $arroout = array();
        $tCount=Tienda::getCountProductoTienda();
        Utilities::putMessageLogFile($data);
        $page=(isset($data["page"]))?$data["page"]:1;
        $rowsPerPage = \Yii::$app->params['pagePro'];
        $offset = ($page - 1) * $rowsPerPage;
        Utilities::putMessageLogFile($page);
        Utilities::putMessageLogFile($offset);
        $con = \Yii::$app->db_tienda;
        $sql="SELECT A.ids_pro,A.cod_art,A.des_com,B.p_venta,A.ruta_img
                FROM " . $con->dbname . ".productos A
                  INNER JOIN " . $con->dbname . ".precios B
                    ON A.ids_pro=B.ids_pro
              WHERE A.est_log=1 LIMIT ".$offset.", ".$rowsPerPage;
        $comando = $con->createCommand($sql);
        //$comando->bindParam(":med_id", $ids, \PDO::PARAM_INT);
        $rawData=$comando->queryAll();
        
        $arroout["status"] = TRUE;
        //$arroout["error"] = null;
        //$arroout["message"] = null;
        $arroout["trows"] = $tCount;//count($rawData);
        $arroout["data"] = $rawData;
        return $arroout;
        
        //return $comando->queryAll();
        
    }
    public static function getCountProductoTienda(){
        $con = \Yii::$app->db_tienda;
        $sql="SELECT COUNT(*) tpro FROM " . $con->dbname . ".productos "
                . "WHERE est_log=1 AND est_web=0 ";
        $comando = $con->createCommand($sql);
        //$comando->bindParam(":med_id", $ids, \PDO::PARAM_INT);
        //$rawData=$comando->queryAll();
        $rawData=$comando->queryScalar();
        if ($rawData === false)
            return 0; //en caso de que existe problema o no retorne nada tiene 1 por defecto 
        return $rawData;
    }
    
}
