<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_BaseSybase
 *
 * @author Byron
 */
class cls_BaseSybase {
    //put your code here
    private $servidor = "localhost";
    private $database = "uteg";
    private $usuario  = "dba";
    private $clave    = "sql";
    private $dns      = "odbc:pruebaConexion";
    public function conexionSybase() {
        try {
            $pdo = new PDO($this->dns, $this->usuario, $this->clave);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            //echo 'Falló la conexión: ' . $e;
            putMessageLogFile('Falló la conexión: ' . $e->getMessage());
            exit;
        }
    }

}
