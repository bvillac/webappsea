<?php

/**
 * This is the model class for table "VSProceso".
 *
 * The followings are the available columns in table 'VSProceso':
 * @property string $Id
 * @property string $IdCompania
 * @property string $ClaveAcceso
 * @property integer $Ambiente
 * @property string $NumeroComprobantes
 * @property string $Estado
 * @property string $RUC
 * @property string $RazonSocial
 * @property string $Email
 * @property string $TipoIdentificacionReceptor
 * @property string $TotalFactura
 * @property string $AutorizacionSRI
 * @property string $FechaAutorizacion
 * @property string $Ruta
 * @property string $FechaEmision
 * @property integer $TipoDocumento
 * @property string $NumDocumento
 * @property string $FechaIngreso
 * @property integer $EstadoEDOC
 * @property integer $EstadoNotificacion
 * @property string $Error
 * @property string $ErrorCodigo
 * @property string $FechaSincCliente
 * @property integer $EstadoSincCliente
 * @property string $ErrorSincCliente
 * @property string $IVA
 * @property string $SubTotalSinImpuesto
 * @property string $UsuarioProceso
 * @property string $UsuarioTransaccionERP
 * @property string $CodigoTransaccionERP
 * @property string $SecuencialERP
 *
 * The followings are the available model relations:
 * @property VSAutorizacion[] $vSAutorizacions
 * @property VSComprobante[] $vSComprobantes
 * @property VSCompania $idCompania
 */
namespace app\modules\fe_edoc\models;

use Yii;
use yii\base\Exception;

class VSProceso extends \app\modules\fe_edoc\components\CActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Ambiente, TipoDocumento, EstadoEDOC, EstadoNotificacion, EstadoSincCliente', 'numerical', 'integerOnly'=>true),
			array('IdCompania, TotalFactura', 'length', 'max'=>19),
			array('ClaveAcceso, Email, AutorizacionSRI, Error, ErrorSincCliente, UsuarioProceso, UsuarioTransaccionERP', 'length', 'max'=>100),
			array('NumeroComprobantes, ErrorCodigo', 'length', 'max'=>10),
			array('Estado', 'length', 'max'=>25),
			array('RUC, NumDocumento, CodigoTransaccionERP', 'length', 'max'=>50),
			array('RazonSocial', 'length', 'max'=>150),
			array('TipoIdentificacionReceptor', 'length', 'max'=>5),
			array('Ruta', 'length', 'max'=>500),
			array('IVA, SubTotalSinImpuesto', 'length', 'max'=>18),
			array('SecuencialERP', 'length', 'max'=>30),
			array('FechaAutorizacion, FechaEmision, FechaIngreso, FechaSincCliente', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, IdCompania, ClaveAcceso, Ambiente, NumeroComprobantes, Estado, RUC, RazonSocial, Email, TipoIdentificacionReceptor, TotalFactura, AutorizacionSRI, FechaAutorizacion, Ruta, FechaEmision, TipoDocumento, NumDocumento, FechaIngreso, EstadoEDOC, EstadoNotificacion, Error, ErrorCodigo, FechaSincCliente, EstadoSincCliente, ErrorSincCliente, IVA, SubTotalSinImpuesto, UsuarioProceso, UsuarioTransaccionERP, CodigoTransaccionERP, SecuencialERP', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'vSAutorizacions' => array(self::HAS_MANY, 'VSAutorizacion', 'IdProceso'),
			'vSComprobantes' => array(self::HAS_MANY, 'VSComprobante', 'IdProceso'),
			'idCompania' => array(self::BELONGS_TO, 'VSCompania', 'IdCompania'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'IdCompania' => 'Id Compania',
			'ClaveAcceso' => 'Clave Acceso',
			'Ambiente' => 'Ambiente',
			'NumeroComprobantes' => 'Numero Comprobantes',
			'Estado' => 'Estado',
			'RUC' => 'Ruc',
			'RazonSocial' => 'Razon Social',
			'Email' => 'Email',
			'TipoIdentificacionReceptor' => 'Tipo Identificacion Receptor',
			'TotalFactura' => 'Total Factura',
			'AutorizacionSRI' => 'Autorizacion Sri',
			'FechaAutorizacion' => 'Fecha Autorizacion',
			'Ruta' => 'Ruta',
			'FechaEmision' => 'Fecha Emision',
			'TipoDocumento' => 'Tipo Documento',
			'NumDocumento' => 'Num Documento',
			'FechaIngreso' => 'Fecha Ingreso',
			'EstadoEDOC' => 'Estado Edoc',
			'EstadoNotificacion' => 'Estado Notificacion',
			'Error' => 'Error',
			'ErrorCodigo' => 'Error Codigo',
			'FechaSincCliente' => 'Fecha Sinc Cliente',
			'EstadoSincCliente' => 'Estado Sinc Cliente',
			'ErrorSincCliente' => 'Error Sinc Cliente',
			'IVA' => 'Iva',
			'SubTotalSinImpuesto' => 'Sub Total Sin Impuesto',
			'UsuarioProceso' => 'Usuario Proceso',
			'UsuarioTransaccionERP' => 'Usuario Transaccion Erp',
			'CodigoTransaccionERP' => 'Codigo Transaccion Erp',
			'SecuencialERP' => 'Secuencial Erp',
		);
	}

}
