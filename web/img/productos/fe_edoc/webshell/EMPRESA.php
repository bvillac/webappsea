<?php
//include('cls_Base.php');
class EMPRESA {
    //put your code here
    public function buscarDataEmpresa($emp_id,$est_id,$pemi_id) {
        $obj_con = new cls_Base();
        $conApp = $obj_con->conexionIntermedio();
        $sql = "SELECT A.emp_id,A.emp_ruc Ruc,A.emp_razonsocial RazonSocial,A.emp_nom_comercial NombreComercial,
                    A.emp_ambiente Ambiente,A.emp_tipo_emision TipoEmision,A.emp_direccion_matriz DireccionMatriz,
                    A.emp_obliga_contabilidad ObligadoContabilidad,A.emp_contri_especial ContribuyenteEspecial,
                    B.est_numero Establecimiento,C.pemi_numero PuntoEmision,A.emp_moneda Moneda
                    FROM " . $obj_con->BdIntermedio . ".empresa A
                            INNER JOIN (" . $obj_con->BdIntermedio . ".establecimiento B
                                            INNER JOIN " . $obj_con->BdIntermedio . ".punto_emision C
                                                    ON B.est_id=C.est_id AND C.est_log='1')
                                    ON A.emp_id=B.emp_id AND B.est_log='1'
            WHERE A.emp_id='$emp_id' AND A.emp_est_log='1' 
                     AND B.est_id='$est_id' AND C.pemi_id='$pemi_id'";
        //echo $sql;
        //$rawData = $conApp->createCommand($sql)->queryAll(); //Varios registros =>  $rawData[0]['RazonSocial']
        //$rawData = $conApp->createCommand($sql)->queryRow();  //Un solo Registro => $rawData['RazonSocial']
        //$conCont->active = false;
        $sentencia = $conApp->query($sql);
        return $sentencia->fetch_assoc();
    }
    
    public function buscarDatoVendedor($vend_id) {
        $obj_con = new cls_Base();
        $conApp = $obj_con->conexionIntermedio();
        //$rawData = array();
        $sql = "SELECT usu_nombre NombreUser,usu_correo CorreoUser FROM " . $obj_con->BdIntermedio . ".usuario WHERE usu_id='$vend_id';";
        $sentencia = $conApp->query($sql);
        $conApp->close();
        return $sentencia->fetch_assoc();
    }
    
    public static function buscarAmbienteEmp($IdCompania,$Ambiente) {
        $obj_con = new cls_Base();
        $conApp = $obj_con->conexionIntermedio();
        //Se puede Extraer el Ambiente directamente de la Base de Datos
        $sql = "SELECT Recepcion,Autorizacion,RecepcionLote,TiempoRespuesta,TiempoSincronizacion "
                . "FROM " . $obj_con->BdIntermedio . ".VSServiciosSRI WHERE emp_id=$IdCompania AND Ambiente=$Ambiente AND Estado=1 ";
        $sentencia = $conApp->query($sql);
        $conApp->close();
        return $sentencia->fetch_assoc();
    }
    
    public static function infoTributariaXML($cabDoc,$xml){
        $valida= new cls_Global;
        $infoTributaria=$xml->createElement('infoTributaria');
        $infoTributaria->appendChild($xml->createElement('ambiente', $cabDoc[0]['Ambiente']));
        $infoTributaria->appendChild($xml->createElement('tipoEmision', $cabDoc[0]['TipoEmision']));        
        $infoTributaria->appendChild($xml->createElement('razonSocial', utf8_encode($valida->limpioCaracteresXML(trim(strtoupper($cabDoc[0]['RazonSocial']))))));
        $infoTributaria->appendChild($xml->createElement('nombreComercial', utf8_encode($valida->limpioCaracteresXML(trim(strtoupper($cabDoc[0]['NombreComercial']))))));
        $infoTributaria->appendChild($xml->createElement('ruc', $cabDoc[0]['Ruc']));
        $infoTributaria->appendChild($xml->createElement('claveAcceso', $cabDoc[0]['ClaveAcceso']));
        $infoTributaria->appendChild($xml->createElement('codDoc', $cabDoc[0]['CodigoDocumento']));
        $infoTributaria->appendChild($xml->createElement('estab', $cabDoc[0]['Establecimiento']));
        $infoTributaria->appendChild($xml->createElement('ptoEmi', $cabDoc[0]['PuntoEmision']));
        $infoTributaria->appendChild($xml->createElement('secuencial', $cabDoc[0]['Secuencial']));
        $infoTributaria->appendChild($xml->createElement('dirMatriz', utf8_encode(trim($cabDoc[0]['DireccionMatriz']))));
        return $infoTributaria;
    }
    
    public static function infoAdicionalXML($adiFact,$xml){
        //Razones por la que el Servicio Tomcat Se cae
        //Verificar XML si esta Bien Generado (Probar el Error en Navegador)
        //Evitar caracteres Especiales
        $valida = new cls_Global;
        $infoAdicional=$xml->createElement('infoAdicional');
        for ($i = 0; $i < sizeof($adiFact); $i++) {
            if(strlen(trim($adiFact[$i]['Descripcion']))>0){
                //$xmldata .='<campoAdicional nombre="' . utf8_encode(trim($adiFact[$i]['Nombre'])) . '">' . utf8_encode($valida->limpioCaracteresXML(trim($adiFact[$i]['Descripcion']))) . '</campoAdicional>';
                $campoA=$xml->createElement('campoAdicional',utf8_encode($valida->limpioCaracteresXML(trim($adiFact[$i]['Descripcion']))) );
                $campoA->setAttribute('nombre', $valida->limpioCaracteresXML(trim($adiFact[$i]['Nombre'])));
                $infoAdicional->appendChild($campoA);
            }
        }
        return $infoAdicional;
    }
    
}
