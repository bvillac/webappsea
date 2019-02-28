<?php

/**
 * This is the model class for table "NubeNotaCredito".
 *
 * The followings are the available columns in table 'NubeNotaCredito':
 * @property string $IdNotaCredito
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
 * @property string $FechaEmision
 * @property string $DireccionEstablecimiento
 * @property integer $ContribuyenteEspecial
 * @property string $ObligadoContabilidad
 * @property string $TipoIdentificacionComprador
 * @property string $RazonSocialComprador
 * @property string $IdentificacionComprador
 * @property string $Rise
 * @property string $CodDocModificado
 * @property string $NumDocModificado
 * @property string $FechaEmisionDocModificado
 * @property string $TotalSinImpuesto
 * @property string $ValorModificacion
 * @property string $MotivoModificacion
 * @property string $Moneda
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
 * @property string $CodigoTransaccionERP
 *
 * The followings are the available model relations:
 * @property NubeDatoAdicionalNotaCredito[] $nubeDatoAdicionalNotaCreditos
 * @property NubeDetalleNotaCredito[] $nubeDetalleNotaCreditos
 * @property NubeNotaCreditoImpuesto[] $nubeNotaCreditoImpuestos
 */

namespace app\modules\fe_edoc\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;

class NubeNotaCredito extends \app\modules\fe_edoc\components\CActiveRecord {

    private $tipoDoc = '04';

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Ambiente, TipoEmision, ContribuyenteEspecial, GeneradoXls, Estado', 'numerical', 'integerOnly' => true),
            array('AutorizacionSRI, EmailResponsable, DirectorioDocumento', 'length', 'max' => 100),
            array('RazonSocial, NombreComercial, DireccionMatriz, DireccionEstablecimiento, RazonSocialComprador, MotivoModificacion, UsuarioCreador, DescripcionError, NombreDocumento', 'length', 'max' => 300),
            array('Ruc, IdentificacionComprador', 'length', 'max' => 13),
            array('ClaveAcceso, IdLote, CodigoTransaccionERP', 'length', 'max' => 50),
            array('CodigoDocumento, ObligadoContabilidad, TipoIdentificacionComprador, CodDocModificado', 'length', 'max' => 2),
            array('Establecimiento, PuntoEmision', 'length', 'max' => 3),
            array('Secuencial', 'length', 'max' => 15),
            array('Rise', 'length', 'max' => 40),
            array('NumDocModificado', 'length', 'max' => 20),
            array('TotalSinImpuesto, ValorModificacion', 'length', 'max' => 19),
            array('Moneda', 'length', 'max' => 10),
            array('EstadoDocumento', 'length', 'max' => 25),
            array('CodigoError', 'length', 'max' => 4),
            array('SecuencialERP', 'length', 'max' => 30),
            array('FechaAutorizacion, FechaEmision, FechaEmisionDocModificado', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdNotaCredito, AutorizacionSRI, FechaAutorizacion, Ambiente, TipoEmision, RazonSocial, NombreComercial, Ruc, ClaveAcceso, CodigoDocumento, Establecimiento, PuntoEmision, Secuencial, DireccionMatriz, FechaEmision, DireccionEstablecimiento, ContribuyenteEspecial, ObligadoContabilidad, TipoIdentificacionComprador, RazonSocialComprador, IdentificacionComprador, Rise, CodDocModificado, NumDocModificado, FechaEmisionDocModificado, TotalSinImpuesto, ValorModificacion, MotivoModificacion, Moneda, UsuarioCreador, EmailResponsable, EstadoDocumento, DescripcionError, CodigoError, DirectorioDocumento, NombreDocumento, GeneradoXls, SecuencialERP, Estado, IdLote, CodigoTransaccionERP', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'nubeDatoAdicionalNotaCreditos' => array(self::HAS_MANY, 'NubeDatoAdicionalNotaCredito', 'IdNotaCredito'),
            'nubeDetalleNotaCreditos' => array(self::HAS_MANY, 'NubeDetalleNotaCredito', 'IdNotaCredito'),
            'nubeNotaCreditoImpuestos' => array(self::HAS_MANY, 'NubeNotaCreditoImpuesto', 'IdNotaCredito'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IdNotaCredito' => 'Id Nota Credito',
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
            'FechaEmision' => 'Fecha Emision',
            'DireccionEstablecimiento' => 'Direccion Establecimiento',
            'ContribuyenteEspecial' => 'Contribuyente Especial',
            'ObligadoContabilidad' => 'Obligado Contabilidad',
            'TipoIdentificacionComprador' => 'Tipo Identificacion Comprador',
            'RazonSocialComprador' => 'Razon Social Comprador',
            'IdentificacionComprador' => 'Identificacion Comprador',
            'Rise' => 'Rise',
            'CodDocModificado' => 'Cod Doc Modificado',
            'NumDocModificado' => 'Num Doc Modificado',
            'FechaEmisionDocModificado' => 'Fecha Emision Doc Modificado',
            'TotalSinImpuesto' => 'Total Sin Impuesto',
            'ValorModificacion' => 'Valor Modificacion',
            'MotivoModificacion' => 'Motivo Modificacion',
            'Moneda' => 'Moneda',
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
            'CodigoTransaccionERP' => 'Codigo Transaccion Erp',
        );
    }

    public function mostrarDocumentos($control) {
        $page = new VSValidador;
        $rawData = array();
        $limitrowsql = $page->paginado($control);

        $tipoUser = Yii::$app->session->get('RolId', FALSE);
        $usuarioErp = $this->concatenarUserERP(Yii::$app->session->get('PB_iduser', false));
        //echo $usuarioErp;
        //$fecInifact=Yii::$app->params['dateStartFact'];//Fecha Inicial de Facturacion Electronica
        $fecInifact = date(Yii::$app->params['dateByDefault']);
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.IdNotaCredito IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                        A.FechaAutorizacion,A.AutorizacionSRI,
                        CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                        A.FechaEmision,A.IdentificacionComprador,A.RazonSocialComprador,A.NumDocModificado,A.FechaEmisionDocModificado,
                        A.TotalSinImpuesto,A.ValorModificacion,A.MotivoModificacion,
                        'NOTA DE CREDITO' NombreDocumento,A.AutorizacionSri,A.ClaveAcceso,A.FechaAutorizacion
                        FROM " . $con->dbname . ".NubeNotaCredito A
                WHERE A.CodigoDocumento='$this->tipoDoc' AND A.Estado NOT IN (5) ";
        //Usuarios Vendedor con * es privilegiado y puede ver lo que factura el resta
        $sql .= ($usuarioErp != '1') ? "AND A.UsuarioCreador IN ('$usuarioErp')" : ""; //Para Usuario Vendedores.


        if (!empty($control)) {//Verifica la Opcion op para los filtros
            $sql .= ($control[0]['TIPO_APR'] != "0") ? " AND A.Estado = '" . $control[0]['TIPO_APR'] . "' " : " AND A.Estado NOT IN (5) ";
            $sql .= ($control[0]['CEDULA'] > 0) ? "AND A.IdentificacionComprador = '" . $control[0]['CEDULA'] . "' " : "";
            //$sql .= ($control[0]['COD_PACIENTE'] != "0") ? "AND CDOR_ID_PACIENTE='".$control[0]['COD_PACIENTE']."' " : "";
            //$sql .= ($control[0]['PACIENTE'] != "") ? "AND CONCAT(B.PER_APELLIDO,' ',B.PER_NOMBRE) LIKE '%" . $control[0]['PACIENTE'] . "%' " : "";
            if($control[0]['F_INI']!='' AND $control[0]['F_FIN']!=''){//Si vienen valores en blanco en las fechas muestra todos
                $sql .= "AND DATE(A.FechaEmision) BETWEEN '" . date("Y-m-d", strtotime($control[0]['F_INI'])) . "' AND '" . date("Y-m-d", strtotime($control[0]['F_FIN'])) . "'  ";
            }
        }
        //$sql .= "ORDER BY A.IdNotaCredito DESC  $limitrowsql";
        //echo $sql;

        $rawData = $con->createCommand($sql)->queryAll();

        return new ArrayDataProvider(array(
            'key' => 'IdDoc',
            'allModels' => $rawData, 
            'sort' => array(
                'attributes' => array(
                    'IdDoc', 'Estado', 'CodigoTransaccionERP', 'SecuencialERP', 'UsuarioCreador',
                    'FechaAutorizacion', 'AutorizacionSRI', 'NumDocumento', 'FechaEmision', 'IdentificacionComprador',
                    'RazonSocialComprador', 'ValorModificacion', 'NombreDocumento',
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
        $UERPId = "";
        $rawData = explode(",", $str);
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $UERPId .= ($i == 0) ? $rawData[$i] : "','" . $rawData[$i];
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
                $condicion .=" AND RazonSocialComprador LIKE '%$aux[$i]%' ";
            }
        }
        $sql = "SELECT A.IdentificacionComprador,A.RazonSocialComprador
                    FROM " . $con->dbname . ".NubeNotaCredito A
                  WHERE A.Estado<>0	GROUP BY IdentificacionComprador ";

        switch ($op) {
            case 'CED':
                $sql .=" AND IdentificacionComprador LIKE '%$valor%' ";
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

    public function mostrarCabNc($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        
         /* SELECT IdNotaCredito,AutorizacionSRI,FechaAutorizacion,Ambiente,TipoEmision,RazonSocial,NombreComercial,Ruc,ClaveAcceso,
          CodigoDocumento,Establecimiento,PuntoEmision,Secuencial,DireccionMatriz,FechaEmision,DireccionEstablecimiento,
          ContribuyenteEspecial,ObligadoContabilidad,TipoIdentificacionComprador,RazonSocialComprador,IdentificacionComprador,
          Rise,CodDocModificado,NumDocModificado,FechaEmisionDocModificado,TotalSinImpuesto,ValorModificacion,MotivoModificacion,
          Moneda,UsuarioCreador,EmailResponsable,EstadoDocumento,DescripcionError,CodigoError,DirectorioDocumento,NombreDocumento,
          GeneradoXls,SecuencialERP,Estado,IdLote,FechaCarga,CodigoTransaccionERP,USU_ID FROM VSSEAINTERMEDIA.NubeNotaCredito; */
        
        $sql = "SELECT A.IdNotaCredito IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                        A.FechaAutorizacion,A.AutorizacionSRI,A.DireccionMatriz,A.DireccionEstablecimiento,
                        CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                        A.ContribuyenteEspecial,A.ObligadoContabilidad,A.TipoIdentificacionComprador,
                        A.CodigoDocumento,A.Establecimiento,A.PuntoEmision,A.Secuencial,
                        A.FechaEmision,A.IdentificacionComprador,A.RazonSocialComprador,
                        A.CodDocModificado,A.NumDocModificado,A.FechaEmisionDocModificado,
                        A.TotalSinImpuesto,A.ValorModificacion,A.MotivoModificacion,
                        'NOTA DE CREDITO' NombreDocumento,A.AutorizacionSri,A.ClaveAcceso,A.FechaAutorizacion,
                        A.Ambiente,A.TipoEmision,A.Moneda,A.Ruc,A.CodigoError, A.RazonSocial
                        FROM " . $con->dbname . ".NubeNotaCredito A
                WHERE A.CodigoDocumento='$this->tipoDoc' AND A.IdNotaCredito =$id ";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }

    public function mostrarDetNc($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDetalleNotaCredito WHERE IdNotaCredito=$id";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $rawData[$i]['impuestos'] = $this->mostrarDetNcImp($rawData[$i]['IdDetalleNotaCredito']); //Retorna el Detalle del Impuesto
        }
        return $rawData;
    }

    private function mostrarDetNcImp($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDetalleNotaCreditoImpuesto WHERE IdDetalleNotaCredito=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }

    public function mostrarNcImp($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeNotaCreditoImpuesto WHERE IdNotaCredito=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }

    public function mostrarNcDataAdicional($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDatoAdicionalNotaCredito WHERE IdNotaCredito=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    
    public function mostrarRutaXMLAutorizado($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT EstadoDocumento,DirectorioDocumento,NombreDocumento FROM " . $con->dbname . ".NubeNotaCredito WHERE "
                . "IdNotaCredito=$id AND EstadoDocumento='AUTORIZADO'";
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }
    
  
}
