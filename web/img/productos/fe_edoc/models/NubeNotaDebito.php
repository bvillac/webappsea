<?php

/**
 * This is the model class for table "NubeNotaDebito".
 *
 * The followings are the available columns in table 'NubeNotaDebito':
 * @property string $IdNotaDebito
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
 * @property string $ValorTotal
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
 * @property NubeDatoAdicionalNotaDebito[] $nubeDatoAdicionalNotaDebitos
 * @property NubeNotaDebitoImpuesto[] $nubeNotaDebitoImpuestos
 * @property NubeNotaDebitoMotivos[] $nubeNotaDebitoMotivoses
 */

namespace app\modules\fe_edoc\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;

class NubeNotaDebito extends \app\modules\fe_edoc\components\CActiveRecord {

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Ambiente, TipoEmision, ContribuyenteEspecial, GeneradoXls, Estado', 'numerical', 'integerOnly' => true),
            array('AutorizacionSRI, EmailResponsable, DirectorioDocumento', 'length', 'max' => 100),
            array('RazonSocial, NombreComercial, DireccionMatriz, DireccionEstablecimiento, RazonSocialComprador, UsuarioCreador, DescripcionError, NombreDocumento', 'length', 'max' => 300),
            array('Ruc, IdentificacionComprador', 'length', 'max' => 13),
            array('ClaveAcceso, IdLote', 'length', 'max' => 50),
            array('CodigoDocumento, ObligadoContabilidad, TipoIdentificacionComprador, CodDocModificado', 'length', 'max' => 2),
            array('Establecimiento, PuntoEmision', 'length', 'max' => 3),
            array('Secuencial', 'length', 'max' => 15),
            array('Rise', 'length', 'max' => 40),
            array('NumDocModificado', 'length', 'max' => 20),
            array('TotalSinImpuesto, ValorTotal', 'length', 'max' => 19),
            array('EstadoDocumento', 'length', 'max' => 25),
            array('CodigoError', 'length', 'max' => 4),
            array('SecuencialERP', 'length', 'max' => 30),
            array('FechaAutorizacion, FechaEmision, FechaEmisionDocModificado', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdNotaDebito, AutorizacionSRI, FechaAutorizacion, Ambiente, TipoEmision, RazonSocial, NombreComercial, Ruc, ClaveAcceso, CodigoDocumento, Establecimiento, PuntoEmision, Secuencial, DireccionMatriz, FechaEmision, DireccionEstablecimiento, ContribuyenteEspecial, ObligadoContabilidad, TipoIdentificacionComprador, RazonSocialComprador, IdentificacionComprador, Rise, CodDocModificado, NumDocModificado, FechaEmisionDocModificado, TotalSinImpuesto, ValorTotal, UsuarioCreador, EmailResponsable, EstadoDocumento, DescripcionError, CodigoError, DirectorioDocumento, NombreDocumento, GeneradoXls, SecuencialERP, Estado, IdLote', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'nubeDatoAdicionalNotaDebitos' => array(self::HAS_MANY, 'NubeDatoAdicionalNotaDebito', 'IdNotaDebito'),
            'nubeNotaDebitoImpuestos' => array(self::HAS_MANY, 'NubeNotaDebitoImpuesto', 'IdNotaDebito'),
            'nubeNotaDebitoMotivoses' => array(self::HAS_MANY, 'NubeNotaDebitoMotivos', 'IdNotaDebito'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IdNotaDebito' => 'Id Nota Debito',
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
            'ValorTotal' => 'Valor Total',
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

}
