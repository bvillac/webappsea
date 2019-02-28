<?php

/**
 * This is the model class for table "NubeGuiaRemision".
 *
 * The followings are the available columns in table 'NubeGuiaRemision':
 * @property string $IdGuiaRemision
 * @property string $AutorizacionSRI
 * @property string $FechaAutorizacion
 * @property integer $Ambiente
 * @property integer $TipoEmision
 * @property string $RazonSocial
 * @property string $NombreComercial
 * @property string $Ruc
 * @property string $ClaveAcceso
 * @property string $CodigoDocumento
 * @property string $Establecimiento
 * @property string $PuntoEmision
 * @property string $Secuencial
 * @property string $DireccionMatriz
 * @property string $DireccionEstablecimiento
 * @property string $DireccionPartida
 * @property string $RazonSocialTransportista
 * @property string $TipoIdentificacionTransportista
 * @property string $IdentificacionTransportista
 * @property string $Rise
 * @property string $ObligadoContabilidad
 * @property integer $ContribuyenteEspecial
 * @property string $FechaInicioTransporte
 * @property string $FechaFinTransporte
 * @property string $Placa
 * @property string $UsuarioCreador
 * @property string $EmailResponsable
 * @property string $EstadoDocumento
 * @property string $DescripcionError
 * @property string $CodigoError
 * @property string $DirectorioDocumento
 * @property string $NombreDocumento
 * @property integer $GeneradoXls
 * @property string $SecuencialERP
 * @property integer $Estado
 * @property string $IdLote
 *
 * The followings are the available model relations:
 * @property NubeDatoAdicionalGuiaRemision[] $nubeDatoAdicionalGuiaRemisions
 * @property NubeGuiaRemisionDestinatario[] $nubeGuiaRemisionDestinatarios
 */

namespace app\modules\fe_edoc\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;

class NubeGuiaRemision extends \app\modules\fe_edoc\components\CActiveRecord {
    private $tipoDoc='06';

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Ambiente, TipoEmision, ContribuyenteEspecial, GeneradoXls, Estado', 'numerical', 'integerOnly' => true),
            array('AutorizacionSRI, EmailResponsable, DirectorioDocumento', 'length', 'max' => 100),
            array('RazonSocial, NombreComercial, DireccionMatriz, DireccionEstablecimiento, DireccionPartida, RazonSocialTransportista, UsuarioCreador, DescripcionError, NombreDocumento', 'length', 'max' => 300),
            array('Ruc, IdentificacionTransportista', 'length', 'max' => 13),
            array('ClaveAcceso, IdLote', 'length', 'max' => 50),
            array('CodigoDocumento, TipoIdentificacionTransportista, ObligadoContabilidad', 'length', 'max' => 2),
            array('Establecimiento, PuntoEmision', 'length', 'max' => 3),
            array('Secuencial', 'length', 'max' => 15),
            array('Rise', 'length', 'max' => 40),
            array('Placa', 'length', 'max' => 20),
            array('EstadoDocumento', 'length', 'max' => 25),
            array('CodigoError', 'length', 'max' => 4),
            array('SecuencialERP', 'length', 'max' => 30),
            array('FechaAutorizacion, FechaInicioTransporte, FechaFinTransporte', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdGuiaRemision, AutorizacionSRI, FechaAutorizacion, Ambiente, TipoEmision, RazonSocial, NombreComercial, Ruc, ClaveAcceso, CodigoDocumento, Establecimiento, PuntoEmision, Secuencial, DireccionMatriz, DireccionEstablecimiento, DireccionPartida, RazonSocialTransportista, TipoIdentificacionTransportista, IdentificacionTransportista, Rise, ObligadoContabilidad, ContribuyenteEspecial, FechaInicioTransporte, FechaFinTransporte, Placa, UsuarioCreador, EmailResponsable, EstadoDocumento, DescripcionError, CodigoError, DirectorioDocumento, NombreDocumento, GeneradoXls, SecuencialERP, Estado, IdLote', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'nubeDatoAdicionalGuiaRemisions' => array(self::HAS_MANY, 'NubeDatoAdicionalGuiaRemision', 'IdGuiaRemision'),
            'nubeGuiaRemisionDestinatarios' => array(self::HAS_MANY, 'NubeGuiaRemisionDestinatario', 'IdGuiaRemision'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IdGuiaRemision' => 'Id Guia Remision',
            'AutorizacionSRI' => 'Autorizacion Sri',
            'FechaAutorizacion' => 'Fecha Autorizacion',
            'Ambiente' => 'Ambiente',
            'TipoEmision' => 'Tipo Emision',
            'RazonSocial' => 'Razon Social',
            'NombreComercial' => 'Nombre Comercial',
            'Ruc' => 'Ruc',
            'ClaveAcceso' => 'Clave Acceso',
            'CodigoDocumento' => 'Codigo Documento',
            'Establecimiento' => 'Establecimiento',
            'PuntoEmision' => 'Punto Emision',
            'Secuencial' => 'Secuencial',
            'DireccionMatriz' => 'Direccion Matriz',
            'DireccionEstablecimiento' => 'Direccion Establecimiento',
            'DireccionPartida' => 'Direccion Partida',
            'RazonSocialTransportista' => 'Razon Social Transportista',
            'TipoIdentificacionTransportista' => 'Tipo Identificacion Transportista',
            'IdentificacionTransportista' => 'Identificacion Transportista',
            'Rise' => 'Rise',
            'ObligadoContabilidad' => 'Obligado Contabilidad',
            'ContribuyenteEspecial' => 'Contribuyente Especial',
            'FechaInicioTransporte' => 'Fecha Inicio Transporte',
            'FechaFinTransporte' => 'Fecha Fin Transporte',
            'Placa' => 'Placa',
            'UsuarioCreador' => 'Usuario Creador',
            'EmailResponsable' => 'Email Responsable',
            'EstadoDocumento' => 'Estado Documento',
            'DescripcionError' => 'Descripcion Error',
            'CodigoError' => 'Codigo Error',
            'DirectorioDocumento' => 'Directorio Documento',
            'NombreDocumento' => 'Nombre Documento',
            'GeneradoXls' => 'Generado Xls',
            'SecuencialERP' => 'Secuencial Erp',
            'Estado' => 'Estado',
            'IdLote' => 'Id Lote',
        );
    }
    
    public function mostrarDocumentos($control) {
        $page= new VSValidador;
        $rawData = array();
        $limitrowsql=$page->paginado($control);
        $tipoUser=Yii::$app->session->get('RolId', FALSE);
        $usuarioErp=$this->concatenarUserERP(Yii::$app->session->get('PB_iduser', false));
        //echo $usuarioErp;
        //$fecInifact=Yii::$app->params['dateStartFact'];//Fecha Inicial de Facturacion Electronica
        $fecInifact= date(Yii::$app->params['dateByDefault']);
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.IdGuiaRemision IdDoc,A.Estado,A.SecuencialERP,A.UsuarioCreador,
                        A.FechaAutorizacion,A.AutorizacionSRI,A.ClaveAcceso,
                        CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                        B.FechaEmisionDocSustento,B.IdentificacionDestinatario,B.RazonSocialDestinatario,
                        B.MotivoTraslado,'GUIA DE REMISION' NombreDocumento,A.FechaEmisionErp	
                        FROM " . $con->dbname . ".NubeGuiaRemision A
                        INNER JOIN " . $con->dbname . ".NubeGuiaRemisionDestinatario B
                                    ON A.IdGuiaRemision=B.IdGuiaRemision
                WHERE A.CodigoDocumento='$this->tipoDoc' AND A.Estado NOT IN (5) ";
        
        //Usuarios Vendedor con * es privilegiado y puede ver lo que factura el resta
        $sql .= ($usuarioErp!='1') ? "AND A.UsuarioCreador IN ('$usuarioErp')" : "";//Para Usuario Vendedores.
        //$sql .= "AND A.UsuarioCreador IN ('$usuarioErp') " ;//Para Usuario Vendedores.*/
        
        if (!empty($control)) {//Verifica la Opcion op para los filtros
            $sql .= ($control[0]['TIPO_APR'] != "0") ? " AND A.Estado = '" . $control[0]['TIPO_APR'] . "' " : " AND A.Estado NOT IN (5) ";
            $sql .= ($control[0]['CEDULA'] > 0) ? "AND A.IdentificacionDestinatario = '" . $control[0]['CEDULA'] . "' " : "";
            if($control[0]['F_INI']!='' AND $control[0]['F_FIN']!=''){//Si vienen valores en blanco en las fechas muestra todos
                $sql .= "AND DATE(A.FechaEmisionErp) BETWEEN '" . date("Y-m-d", strtotime($control[0]['F_INI'])) . "' AND '" . date("Y-m-d", strtotime($control[0]['F_FIN'])) . "'  ";
            }
        }
        //$sql .= "ORDER BY A.IdGuiaRemision DESC  $limitrowsql";
        //echo $sql;

        $rawData = $con->createCommand($sql)->queryAll();

        return new ArrayDataProvider(array(
            'key' => 'IdDoc',
            'allModels' => $rawData, 
            'sort' => array(
                'attributes' => array(
                    'IdDoc', 'Estado', 'SecuencialERP', 'UsuarioCreador',
                    'FechaAutorizacion', 'AutorizacionSRI', 'NumDocumento', 'FechaEmisionDocSustento', 'IdentificacionDestinatario',
                    'RazonSocialDestinatario', 'NombreDocumento','FechaEmisionErp',
                ),
            ),
            //'totalItemCount' => count($rawData),
            'pagination' => array(
                'pageSize' => Yii::$app->params['pageSize'],
            //'itemCount'=>count($rawData),
            ),
        ));
    }
    
    private function concatenarUserERP($str) {
        $UERPId="";
        $rawData = explode(",", $str);
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $UERPId .= ($i == 0)?$rawData[$i]:"','".$rawData[$i];
        }
        return $UERPId;
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
                $condicion .=" AND RazonSocialDestinatario LIKE '%$aux[$i]%' ";
            }
        }
        $sql = "SELECT B.IdentificacionDestinatario,B.RazonSocialDestinatario
                    FROM " . $con->dbname . ".NubeGuiaRemision A
                            INNER JOIN " . $con->dbname . ".NubeGuiaRemisionDestinatario B
                                    ON A.IdGuiaRemision=B.IdGuiaRemision
                  WHERE A.Estado<>0 GROUP BY B.IdentificacionDestinatario ";

        switch ($op) {
            case 'CED':
                $sql .=" AND IdentificacionDestinatario LIKE '%$valor%' ";
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
    
    public function mostrarCabGuia($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        
        $sql = "SELECT A.IdGuiaRemision IdDoc,A.Estado,A.SecuencialERP,A.UsuarioCreador,
                    A.FechaAutorizacion,A.AutorizacionSRI,A.ClaveAcceso,A.Ambiente,A.TipoEmision,
                    CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                    A.DireccionPartida,A.RazonSocialTransportista,A.IdentificacionTransportista,
                    A.FechaInicioTransporte,A.FechaFinTransporte,A.Placa,A.DireccionEstablecimiento,
                    'GUIA DE REMISION' NombreDocumento,A.TipoIdentificacionTransportista,A.Rise,A.CodigoDocumento,A.FechaEmisionErp,
                    A.Establecimiento,A.PuntoEmision,A.Secuencial,A.DireccionMatriz,A.ObligadoContabilidad,A.ContribuyenteEspecial,
                    A.RazonSocial, A.Ruc
                    FROM " . $con->dbname . ".NubeGuiaRemision A
            WHERE A.CodigoDocumento='$this->tipoDoc' AND A.IdGuiaRemision =$id ";
        
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }
    
    public function mostrarDestinoGuia($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeGuiaRemisionDestinatario WHERE IdGuiaRemision=$id";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryAll(); 
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $rawData[$i]['GuiaDet'] = $this->mostrarDetGuia($rawData[$i]['IdGuiaRemisionDestinatario']); //Retorna el Detalle del Impuesto
        }
        return $rawData;
    }
    
    private function mostrarDetGuia($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeGuiaRemisionDetalle WHERE IdGuiaRemisionDestinatario=$id";
        $rawData = $con->createCommand($sql)->queryAll(); 
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $rawData[$i]['GuiaDetAdi'] = $this->mostrarDetGuiaDatoAdi($rawData[$i]['IdGuiaRemisionDetalle']); //Retorna el Detalle del Impuesto
        }
        return $rawData;
    }
    
    private function mostrarDetGuiaDatoAdi($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDatoAdicionalGuiaRemisionDetalle WHERE IdGuiaRemisionDetalle=$id";
        $rawData = $con->createCommand($sql)->queryAll(); 
        return $rawData;
    }
    
    public function mostrarCabGuiaDataAdicional($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDatoAdicionalGuiaRemision WHERE IdGuiaRemision=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    
    public function mostrarRutaXMLAutorizado($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT EstadoDocumento,DirectorioDocumento,NombreDocumento FROM " . $con->dbname . ".NubeGuiaRemision WHERE "
                . "IdGuiaRemision=$id AND EstadoDocumento='AUTORIZADO'";
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }
    
    
    

}
