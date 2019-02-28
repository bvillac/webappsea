<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* Web Server */
$WS_HOST = "192.168.1.100";
$WS_PORT = "80";
$WS_USER = "test";
$WS_PASS = "test";
$WS_URI = "asgard/api/request/fe_edoc/Edoc/sendEdoc/json";

$service = "uteg-fe";
$logFile = "logs/$service.log";
$limit = 10;
$timeWait=1;//1 Segundo

function putMessageLogFile($message) {
    GLOBAL $logFile;
    if (is_array($message))
        $message = json_encode($message);
    $message = date("Y-m-d H:i:s") . " " . $message . "\n";
    file_put_contents($logFile, $message, FILE_APPEND | LOCK_EX);
}
