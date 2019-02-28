<?php

/**
 * This is the model class for table "VSAlerta".
 *
 * The followings are the available columns in table 'VSAlerta':
 * @property integer $Id
 * @property string $IdCompania
 * @property integer $Valor
 * @property string $Mail
 * @property integer $EsCustomizado
 * @property integer $IdTipoAlerta
 * @property integer $UsuarioCreacion
 * @property string $FechaCreacion
 * @property integer $UsuarioModificacion
 * @property string $FechaModificacion
 * @property integer $UsuarioEliminacion
 * @property string $FechaEliminacion
 *
 * The followings are the available model relations:
 * @property VSCompania $idCompania
 * @property VSTipoAlerta $idTipoAlerta
 */
namespace app\modules\fe_edoc\models;

use Yii;

class VSAlerta extends \app\modules\fe_edoc\components\CActiveRecord
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Valor, EsCustomizado, IdTipoAlerta, UsuarioCreacion, UsuarioModificacion, UsuarioEliminacion', 'numerical', 'integerOnly'=>true),
			array('IdCompania', 'length', 'max'=>19),
			array('Mail', 'length', 'max'=>100),
			array('FechaCreacion, FechaModificacion, FechaEliminacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, IdCompania, Valor, Mail, EsCustomizado, IdTipoAlerta, UsuarioCreacion, FechaCreacion, UsuarioModificacion, FechaModificacion, UsuarioEliminacion, FechaEliminacion', 'safe', 'on'=>'search'),
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
			'idCompania' => array(self::BELONGS_TO, 'VSCompania', 'IdCompania'),
			'idTipoAlerta' => array(self::BELONGS_TO, 'VSTipoAlerta', 'IdTipoAlerta'),
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
			'Valor' => 'Valor',
			'Mail' => 'Mail',
			'EsCustomizado' => 'Es Customizado',
			'IdTipoAlerta' => 'Id Tipo Alerta',
			'UsuarioCreacion' => 'Usuario Creacion',
			'FechaCreacion' => 'Fecha Creacion',
			'UsuarioModificacion' => 'Usuario Modificacion',
			'FechaModificacion' => 'Fecha Modificacion',
			'UsuarioEliminacion' => 'Usuario Eliminacion',
			'FechaEliminacion' => 'Fecha Eliminacion',
		);
	}

}
