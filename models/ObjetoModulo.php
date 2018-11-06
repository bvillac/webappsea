<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objeto_modulo".
 *
 * @property int $omod_id
 * @property int $mod_id
 * @property int $omod_padre_id
 * @property string $omod_nombre
 * @property string $omod_tipo
 * @property string $omod_tipo_boton
 * @property string $omod_accion
 * @property string $omod_function
 * @property string $omod_dir_imagen
 * @property string $omod_entidad
 * @property int $omod_orden
 * @property int $omod_estado_visible
 * @property string $omod_lang_file
 * @property string $omod_estado_activo
 * @property string $omod_fecha_creacion
 * @property string $omod_fecha_modificacion
 * @property string $omod_estado_logico
 *
 * @property Modulo $mod
 * @property ObjetoModulo $omodPadre
 * @property ObjetoModulo[] $objetoModulos
 * @property OmoduloRol[] $omoduloRols
 */
class ObjetoModulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objeto_modulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mod_id', 'omod_estado_activo', 'omod_estado_logico'], 'required'],
            [['mod_id', 'omod_padre_id', 'omod_orden', 'omod_estado_visible'], 'integer'],
            [['omod_fecha_creacion', 'omod_fecha_modificacion'], 'safe'],
            [['omod_nombre', 'omod_accion'], 'string', 'max' => 50],
            [['omod_tipo', 'omod_lang_file'], 'string', 'max' => 60],
            [['omod_tipo_boton', 'omod_estado_activo', 'omod_estado_logico'], 'string', 'max' => 1],
            [['omod_function', 'omod_dir_imagen', 'omod_entidad'], 'string', 'max' => 100],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modulo::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
            [['omod_padre_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjetoModulo::className(), 'targetAttribute' => ['omod_padre_id' => 'omod_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'omod_id' => Yii::t('app', 'Omod ID'),
            'mod_id' => Yii::t('app', 'Mod ID'),
            'omod_padre_id' => Yii::t('app', 'Omod Padre ID'),
            'omod_nombre' => Yii::t('app', 'Omod Nombre'),
            'omod_tipo' => Yii::t('app', 'Omod Tipo'),
            'omod_tipo_boton' => Yii::t('app', 'Omod Tipo Boton'),
            'omod_accion' => Yii::t('app', 'Omod Accion'),
            'omod_function' => Yii::t('app', 'Omod Function'),
            'omod_dir_imagen' => Yii::t('app', 'Omod Dir Imagen'),
            'omod_entidad' => Yii::t('app', 'Omod Entidad'),
            'omod_orden' => Yii::t('app', 'Omod Orden'),
            'omod_estado_visible' => Yii::t('app', 'Omod Estado Visible'),
            'omod_lang_file' => Yii::t('app', 'Omod Lang File'),
            'omod_estado_activo' => Yii::t('app', 'Omod Estado Activo'),
            'omod_fecha_creacion' => Yii::t('app', 'Omod Fecha Creacion'),
            'omod_fecha_modificacion' => Yii::t('app', 'Omod Fecha Modificacion'),
            'omod_estado_logico' => Yii::t('app', 'Omod Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod()
    {
        return $this->hasOne(Modulo::className(), ['mod_id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmodPadre()
    {
        return $this->hasOne(ObjetoModulo::className(), ['omod_id' => 'omod_padre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetoModulos()
    {
        return $this->hasMany(ObjetoModulo::className(), ['omod_padre_id' => 'omod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmoduloRols()
    {
        return $this->hasMany(OmoduloRol::className(), ['omod_id' => 'omod_id']);
    }
}
