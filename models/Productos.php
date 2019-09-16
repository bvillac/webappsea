<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Productos
 *
 * @author root
 */
use Yii;
use yii\helpers\Url;

class Productos {
    //put your code here
    public static function consultarCatPrecio($ids) {
        //Recibe IdsCliente  y si no tiene valor 
        //su valor por defecto=1 que es consumidor final
        //Precio por defecto f3
        //$ids=($ids!='')?$ids:1;//revisar bien
        $con = \Yii::$app->db;
        $con1 = \Yii::$app->db_tienda;
        $sql="SELECT B.ids_ctp,B.cod_ctp,B.por_des 
                        FROM " . $con->dbname . ".cliente A
                                INNER JOIN " . $con1->dbname . ".categoria_precios B 
                        ON A.ids_ctp=B.ids_ctp
                WHERE A.cli_est_log=1 AND B.est_log=1 AND A.cli_id=:ids;";
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ids", $ids, \PDO::PARAM_INT);
        return $comando->queryOne();
        
    }
    
    
}
