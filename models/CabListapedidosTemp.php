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
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            
            $idCab=$this->InsertarCabListPedTemp($con,$dtsCab);
            $this->InsertarDetListPedTemp($con,$idCab,$dtsDet);
            //$idCab = $con->getLastInsertID($con->dbname . '.TEMP_CAB_PEDIDO');
            /*for ($i = 0; $i < sizeof($dts_Lista); $i++) {
                $artieId = $dts_Lista[$i]['ARTIE_ID'];
                $artId = $dts_Lista[$i]['ART_ID'];
                $cant = $dts_Lista[$i]['CANT'];
                $precio = $dts_Lista[$i]['PRECIO'];
                $subtotal = $dts_Lista[$i]['TOTAL'];
                $observ = $dts_Lista[$i]['OBSERV'];  
                $sql = "INSERT INTO " . $con->dbname . ".TEMP_DET_PEDIDO
                        (TCPED_ID,ARTIE_ID,ART_ID,TDPED_CAN_PED,TDPED_P_VENTA,TDPED_T_VENTA,
                        TDPED_EST_AUT,TDPED_OBSERVA,TDPED_EST_LOG,TDPED_FEC_CRE)VALUES
                        ($idCab,$artieId,$artId,$cant,$precio,$subtotal,'1','$observ','1',CURRENT_TIMESTAMP())";
                //echo $sql;
                $command = $con->createCommand($sql);
                $command->execute();
            }*/
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            //$arroout["ids"]= $ftem_id;
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

    
    private function InsertarCabListPedTemp($con,$data) { 
        //ids_clis
        $sql = "INSERT INTO " . $con->dbname . ".cab_listapedidos_temp
            (cli_id,cod_cli,atiende,tip_doc,num_doc,ids_lre,nom_clis,dir_entrega,val_bru,por_des,
             val_des,val_fle,bas_iva,bas_iv0,por_iva,val_iva,val_net,est_ped,est_log,usuario)VALUES
            (:cli_id,:cod_cli,:atiende,:tip_doc,:num_doc,:ids_lre,:nom_clis,:dir_entrega,:val_bru,:por_des,
             :val_des,:val_fle,:bas_iva,:bas_iv0,:por_iva,:val_iva,:val_net,:est_ped,:est_log,:usuario)";
        $command = $con->createCommand($sql);

        //$command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":per_nombre", $data[0]['per_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":per_apellido", $data[0]['per_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":per_ced_ruc", $data[0]['per_ced_ruc'], \PDO::PARAM_STR);        
        $command->bindParam(":per_genero", $data[0]['per_genero'], \PDO::PARAM_STR);
        $command->bindParam(":per_fecha_nacimiento", $data[0]['per_fecha_nacimiento'], \PDO::PARAM_STR);
        $command->bindParam(":per_estado_civil", $data[0]['per_estado_civil'], \PDO::PARAM_STR);
        $command->bindParam(":per_correo", $data[0]['per_correo'], \PDO::PARAM_STR);
        $command->bindParam(":per_tipo_sangre", $data[0]['per_tipo_sangre'], \PDO::PARAM_STR);
        $command->bindParam(":per_foto", $data[0]['per_foto'], \PDO::PARAM_STR);
        $command->execute();
        return $con->getLastInsertID();
    }
    
    private function InsertarDetListPedTemp($con,$idCab,$dtsDet) {

        //Dim por_iva As Decimal = CDbl(dtsData.Tables("VC010101").Rows(0).Item("POR_IVA")) / 100
        $por_iva=0;
        $idDet=0;
        $valSinImp = 0;
        $val_iva12 = 0;
        $vet_iva12 = 0;
        $val_iva0 = 0;//Valor de Iva
        $vet_iva0 = 0;//Venta total con Iva
        for ($i = 0; $i < sizeof($detFact); $i++) {
	    $por_iva=intval($detFact[$i]['IMP_PORCENTAJE']);//TARIFA % DE IVA SEGUN TABLA 17
			//Utilities::putMessageLogFile($por_iva);
            $valSinImp = $detFact[$i]['TOTALSINIMPUESTOS'];//floatval($detFact[$i]['T_VENTA']) - floatval($detFact[$i]['VAL_DES']);
            //%codigo iva segun tabla #17
            $codigoImp=$detFact[$i]['IMP_CODIGO'];
            if ($por_iva > 0) {
                $val_iva12 = $val_iva12 + ((floatval($detFact[$i]['CANTIDAD'])*floatval($detFact[$i]['PRECIOUNITARIO'])-floatval($detFact[$i]['DESC']))* (floatval($por_iva)/100));
                $vet_iva12 = $vet_iva12 + $valSinImp;
            } else {
                $val_iva0 = 0;
                $vet_iva0 = $vet_iva0 + $valSinImp;
            }
            $CodigoAuxiliar=($detFact[$i]['CODIGOPRINCIPAL']!='')?$detFact[$i]['CODIGOPRINCIPAL']:1;
            $sql = "INSERT INTO " . $con->dbname . ".NubeDetalleFactura
                        (CodigoPrincipal,CodigoAuxiliar,Descripcion,Cantidad,PrecioUnitario,Descuento,PrecioTotalSinImpuesto,IdFactura) VALUES 
                        (:CodigoPrincipal,:CodigoAuxiliar,:Descripcion,:Cantidad,:PrecioUnitario,:Descuento,:PrecioTotalSinImpuesto,:IdFactura);";
            
            $comando = $con->createCommand($sql);
            $comando->bindParam(":CodigoPrincipal", $detFact[$i]['CODIGOPRINCIPAL'], \PDO::PARAM_STR);
            $comando->bindParam(":CodigoAuxiliar", $CodigoAuxiliar, \PDO::PARAM_STR);
            $comando->bindParam(":Descripcion", $detFact[$i]['DESCRIPCION'], \PDO::PARAM_STR);
            $comando->bindParam(":Cantidad", $detFact[$i]['CANTIDAD'], \PDO::PARAM_STR);
            $comando->bindParam(":PrecioUnitario", $detFact[$i]['PRECIOUNITARIO'], \PDO::PARAM_STR);
            $comando->bindParam(":Descuento", $detFact[$i]['DESC'], \PDO::PARAM_STR);
            $comando->bindParam(":PrecioTotalSinImpuesto", $valSinImp, \PDO::PARAM_STR);
            $comando->bindParam(":IdFactura", $idCab, \PDO::PARAM_INT);
            $comando->execute();
            $idDet = $con->getLastInsertID();
            
            //Inserta el IVA de cada Item             
            if ($por_iva > 0) {//Verifico si el ITEM tiene Impuesto 12%
                //Segun Datos Sri
                $valIvaImp=(floatval($valSinImp)*floatval($por_iva))/100;//Calculo del Valor del Impuesto Generado por Detalle
                $this->InsertarDetImpFactura($con, $idDet, '2',$por_iva, $valSinImp, $valIvaImp); //12%
            } else {//Caso Contrario no Genera Impuesto 0%
                $this->InsertarDetImpFactura($con, $idDet, '2','0', $valSinImp, '0'); //0%
            }
        }
       
    }
    
    
}
