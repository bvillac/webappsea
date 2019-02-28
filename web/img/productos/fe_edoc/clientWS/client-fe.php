<?php

include_once('libs/SybaseFactura.php');//para HTTP
include_once('libs/SybaseRetenciones.php');//para HTTP
include_once('libs/SybaseNC.php');//para HTTP 

$objFac = new SybaseFactura();
$res=$objFac->consultarSybCabFacturas();
$objRet = new SybaseRetenciones();
$res=$objRet->consultarSybCabRetenciones();
$objNc = new SybaseNC();
$res=$objNc->consultarSybCabFacturas();
?>