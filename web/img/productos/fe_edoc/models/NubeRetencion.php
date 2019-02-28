<?php

/**
 * This is the model class for table "NubeRetencion".
 *
 * The followings are the available columns in table 'NubeRetencion':
 * @property string $IdRetencion
 * @property string $AutorizacionSRI
 * @property string $FechaAutorizacion
 * @property integer $Ambiente
 * @property integer $TipoEmision
 * @property string $RazonSocial
 * @property string $NombreComercial
 * @property string $Ruc
 * @property string $ClaveAcceso
 * @property string $CodigoDocumento
 * @property string $PuntoEmision
 * @property string $Establecimiento
 * @property string $Secuencial
 * @property string $DireccionMatriz
 * @property string $FechaEmision
 * @property string $DireccionEstablecimiento
 * @property string $ContribuyenteEspecial
 * @property string $ObligadoContabilidad
 * @property string $TipoIdentificacionSujetoRetenido
 * @property string $IdentificacionSujetoRetenido
 * @property string $RazonSocialSujetoRetenido
 * @property string $PeriodoFiscal
 * @property string $TotalRetencion
 * @property string $UsuarioCreador
 * @property string $EmailResponsable
 * @property string $EstadoDocumento
 * @property string $DescripcionError
 * @property string $CodigoError
 * @property string $DirectorioDocumento
 * @property string $NombreDocumento
 * @property integer $GeneradoXls
 * @property string $SecuencialERP
 * @property string $CodigoTransaccionERP
 * @property integer $Estado
 * @property string $FechaCarga
 * @property string $IdLote
 *
 * The followings are the available model relations:
 * @property NubeDatoAdicionalRetencion[] $nubeDatoAdicionalRetencions
 * @property NubeDetalleRetencion[] $nubeDetalleRetencions
 */

namespace app\modules\fe_edoc\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;

class NubeRetencion extends \app\modules\fe_edoc\components\CActiveRecord {
    private $tipoDoc='07';

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Ambiente, TipoEmision, GeneradoXls, Estado', 'numerical', 'integerOnly' => true),
            array('AutorizacionSRI, EmailResponsable, DirectorioDocumento', 'length', 'max' => 100),
            array('RazonSocial, NombreComercial, DireccionMatriz, DireccionEstablecimiento, RazonSocialSujetoRetenido, UsuarioCreador, DescripcionError, NombreDocumento', 'length', 'max' => 300),
            array('Ruc', 'length', 'max' => 13),
            array('ClaveAcceso, ContribuyenteEspecial, IdentificacionSujetoRetenido, CodigoTransaccionERP, IdLote', 'length', 'max' => 50),
            array('CodigoDocumento, ObligadoContabilidad, TipoIdentificacionSujetoRetenido', 'length', 'max' => 2),
            array('PuntoEmision, Establecimiento', 'length', 'max' => 3),
            array('Secuencial', 'length', 'max' => 15),
            array('PeriodoFiscal', 'length', 'max' => 10),
            array('TotalRetencion', 'length', 'max' => 19),
            array('EstadoDocumento', 'length', 'max' => 25),
            array('CodigoError', 'length', 'max' => 4),
            array('SecuencialERP', 'length', 'max' => 30),
            array('FechaAutorizacion, FechaEmision, FechaCarga', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdRetencion, AutorizacionSRI, FechaAutorizacion, Ambiente, TipoEmision, RazonSocial, NombreComercial, Ruc, ClaveAcceso, CodigoDocumento, PuntoEmision, Establecimiento, Secuencial, DireccionMatriz, FechaEmision, DireccionEstablecimiento, ContribuyenteEspecial, ObligadoContabilidad, TipoIdentificacionSujetoRetenido, IdentificacionSujetoRetenido, RazonSocialSujetoRetenido, PeriodoFiscal, TotalRetencion, UsuarioCreador, EmailResponsable, EstadoDocumento, DescripcionError, CodigoError, DirectorioDocumento, NombreDocumento, GeneradoXls, SecuencialERP, CodigoTransaccionERP, Estado, FechaCarga, IdLote', 'safe', 'on' => 'search'),
        );
    }

   

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IdRetencion' => 'Id Retencion',
            'AutorizacionSRI' => 'Autorizacion Sri',
            'FechaAutorizacion' => 'Fecha Autorizacion',
            'Ambiente' => 'Ambiente',
            'TipoEmision' => 'Tipo Emision',
            'RazonSocial' => 'Razon Social',
            'NombreComercial' => 'Nombre Comercial',
            'Ruc' => 'Ruc',
            'ClaveAcceso' => 'Clave Acceso',
            'CodigoDocumento' => 'Codigo Documento',
            'PuntoEmision' => 'Punto Emision',
            'Establecimiento' => 'Establecimiento',
            'Secuencial' => 'Secuencial',
            'DireccionMatriz' => 'Direccion Matriz',
            'FechaEmision' => 'Fecha Emision',
            'DireccionEstablecimiento' => 'Direccion Establecimiento',
            'ContribuyenteEspecial' => 'Contribuyente Especial',
            'ObligadoContabilidad' => 'Obligado Contabilidad',
            'TipoIdentificacionSujetoRetenido' => 'Tipo Identificacion Sujeto Retenido',
            'IdentificacionSujetoRetenido' => 'Identificacion Sujeto Retenido',
            'RazonSocialSujetoRetenido' => 'Razon Social Sujeto Retenido',
            'PeriodoFiscal' => 'Periodo Fiscal',
            'TotalRetencion' => 'Total Retencion',
            'UsuarioCreador' => 'Usuario Creador',
            'EmailResponsable' => 'Email Responsable',
            'EstadoDocumento' => 'Estado Documento',
            'DescripcionError' => 'Descripcion Error',
            'CodigoError' => 'Codigo Error',
            'DirectorioDocumento' => 'Directorio Documento',
            'NombreDocumento' => 'Nombre Documento',
            'GeneradoXls' => 'Generado Xls',
            'SecuencialERP' => 'Secuencial Erp',
            'CodigoTransaccionERP' => 'Codigo Transaccion Erp',
            'Estado' => 'Estado',
            'FechaCarga' => 'Fecha Carga',
            'IdLote' => 'Id Lote',
        );
    } 
    
    public function mostrarDocumentos($control) {
        $page= new VSValidador;
        $rawData = array();
        $limitrowsql=$page->paginado($control);
        $tipoUser=Yii::$app->session->get('RolId', FALSE);
        $usuarioErp=$page->concatenarUserERP(Yii::$app->session->get('PB_iduser', false));
        //echo $usuarioErp;
        //$fecInifact=Yii::$app->params['dateStartFact'];//Fecha Inicial de Facturacion Electronica
        $fecInifact= date(Yii::$app->params['dateByDefault']);
        $con = Yii::$app->db_edoc;
        
        $sql = "SELECT A.IdRetencion IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                    A.FechaAutorizacion,A.AutorizacionSRI,
                    CONCAT(A.CodigoTransaccionERP,'-',A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                    A.FechaEmision,A.IdentificacionSujetoRetenido,A.RazonSocialSujetoRetenido,
                    A.TotalRetencion,'COMPROBANTE DE RETENCION' NombreDocumento,A.AutorizacionSri,
                       A.ClaveAcceso,A.FechaAutorizacion,A.DocSustentoERP
                    FROM " . $con->dbname . ".NubeRetencion A
                WHERE A.CodigoDocumento='$this->tipoDoc' AND A.Estado NOT IN (5) ";
        
        //Usuarios Vendedor con * es privilegiado y puede ver lo que factura el resta
        $sql .= ($usuarioErp!='1') ? "AND A.UsuarioCreador IN ('$usuarioErp')" : "";//Para Usuario Vendedores.

        
        if (!empty($control)) {//Verifica la Opcion op para los filtros
            $sql .= ($control[0]['TIPO_APR'] != "0") ? " AND A.Estado = '" . $control[0]['TIPO_APR'] . "' " : " AND A.Estado NOT IN (5) ";
            $sql .= ($control[0]['CEDULA'] > 0) ? "AND A.IdentificacionSujetoRetenido = '" . $control[0]['CEDULA'] . "' " : "";
            //$sql .= ($control[0]['COD_PACIENTE'] != "0") ? "AND CDOR_ID_PACIENTE='".$control[0]['COD_PACIENTE']."' " : "";
            //$sql .= ($control[0]['PACIENTE'] != "") ? "AND CONCAT(B.PER_APELLIDO,' ',B.PER_NOMBRE) LIKE '%" . $control[0]['PACIENTE'] . "%' " : "";
            if($control[0]['F_INI']!='' AND $control[0]['F_FIN']!=''){//Si vienen valores en blanco en las fechas muestra todos
                $sql .= "AND DATE(A.FechaEmision) BETWEEN '" . date("Y-m-d", strtotime($control[0]['F_INI'])) . "' AND '" . date("Y-m-d", strtotime($control[0]['F_FIN'])) . "'  ";
            }
        }
        //$sql .= "ORDER BY A.IdRetencion DESC $limitrowsql";
        //echo $sql;
        //VSValidador::putMessageLogFile($sql);
        $rawData = $con->createCommand($sql)->queryAll();

        return new ArrayDataProvider(array(
            'key' => 'IdDoc',
            'allModels' => $rawData, 
            'sort' => array(
                'attributes' => array(
                    'IdDoc', 'Estado', 'CodigoTransaccionERP', 'SecuencialERP', 'UsuarioCreador',
                    'FechaAutorizacion', 'AutorizacionSRI', 'NumDocumento', 'FechaEmision', 'IdentificacionSujetoRetenido',
                    'RazonSocialSujetoRetenido', 'TotalRetencion', 'NombreDocumento',
                ),
            ),
            //'totalItemCount' => count($rawData),
            'pagination' => array(
                'pageSize' => Yii::$app->params['pageSize'],
            //'itemCount'=>count($rawData),
            ),
        ));
    }
    
    /**
     * Función 
     *
     * @author Byron Villacreses
     * @access public
     * @return Retorna Los Datos de las Retenciones GENERADAS
     */
    public function retornarPersona($valor, $op) {
        $con = Yii::$app->db_edoc;
        $rawData = array();
        //Patron de Busqueda
        /* http://www.mclibre.org/consultar/php/lecciones/php_expresiones_regulares.html */
        $patron = "/^[[:digit:]]+$/"; //Los patrones deben empezar y acabar con el carácter / (barra).
        if (preg_match($patron, $valor)) {
            $op = "CED"; //La cadena son sólo números.
        } else {
            $op = "NOM"; //La cadena son Alfanumericos.
            //Las separa en un array 
            $aux = explode(" ", $valor);
            $condicion = " ";
            for ($i = 0; $i < count($aux); $i++) {
                //Crea la Sentencia de Busqueda
                //$condicion .=" AND (PER_NOMBRE LIKE '%$aux[$i]%' OR PER_APELLIDO LIKE '%$aux[$i]%' ) ";
                $condicion .=" AND RazonSocialSujetoRetenido LIKE '%$aux[$i]%' ";
            }
        }
        $sql = "SELECT A.IdentificacionSujetoRetenido,A.RazonSocialSujetoRetenido
                    FROM " . $con->dbname . ".NubeRetencion A
                  WHERE A.Estado<>0	GROUP BY IdentificacionSujetoRetenido ";

        switch ($op) {
            case 'CED':
                $sql .=" AND IdentificacionSujetoRetenido LIKE '%$valor%' ";
                break;
            case 'NOM':
                $sql .=$condicion;
                break;
            default:
        }
        $sql .= " LIMIT " . Yii::$app->params['limitRow'];
        //$sql .= " LIMIT 10";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryAll();
        return $rawData;
    }
    
    public function mostrarCabRetencion($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.IdRetencion IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                    A.FechaAutorizacion,A.AutorizacionSRI,A.DireccionMatriz,A.DireccionEstablecimiento,
                    CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                    A.ContribuyenteEspecial,A.ObligadoContabilidad,A.TipoIdentificacionSujetoRetenido,
                    A.CodigoDocumento,A.Establecimiento,A.PuntoEmision,A.Secuencial,A.PeriodoFiscal,
                    A.FechaEmision,A.IdentificacionSujetoRetenido,A.RazonSocialSujetoRetenido,
                    A.TotalRetencion,'COMPROBANTE DE RETENCION' NombreDocumento,A.ClaveAcceso,A.FechaAutorizacion,
                    A.Ambiente,A.TipoEmision,A.Ruc,A.CodigoError, A.RazonSocial
                    FROM " . $con->dbname . ".NubeRetencion A
                WHERE A.CodigoDocumento='$this->tipoDoc' AND A.IdRetencion =$id ";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }

    public function mostrarDetRetencion($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDetalleRetencion WHERE IdRetencion=$id";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        /*for ($i = 0; $i < sizeof($rawData); $i++) {
            $rawData[$i]['impuestos'] = $this->mostrarDetalleImp($rawData[$i]['IdDetalleFactura']); //Retorna el Detalle del Impuesto
        }*/
        return $rawData;
    }


    public function mostrarRetencionDataAdicional($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDatoAdicionalRetencion WHERE IdRetencion=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    
    public function mostrarRutaXMLAutorizado($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT EstadoDocumento,DirectorioDocumento,NombreDocumento FROM " . $con->dbname . ".NubeRetencion WHERE "
                . "IdRetencion=$id AND EstadoDocumento='AUTORIZADO'";
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }
    
    

}
