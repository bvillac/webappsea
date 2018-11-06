<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property int $mod_id
 * @property int $apl_id
 * @property string $mod_nombre
 * @property string $mod_dir_imagen
 * @property string $mod_url
 * @property int $mod_orden
 * @property string $mod_lang_file
 * @property string $mod_estado_activo
 * @property string $mod_fecha_creacion
 * @property string $mod_fecha_modificacion
 * @property string $mod_estado_logico
 *
 * @property Aplicacion $apl
 * @property ObjetoModulo[] $objetoModulos
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apl_id', 'mod_estado_activo', 'mod_estado_logico'], 'required'],
            [['apl_id', 'mod_orden'], 'integer'],
            [['mod_fecha_creacion', 'mod_fecha_modificacion'], 'safe'],
            [['mod_nombre'], 'string', 'max' => 50],
            [['mod_dir_imagen', 'mod_url'], 'string', 'max' => 100],
            [['mod_lang_file'], 'string', 'max' => 60],
            [['mod_estado_activo', 'mod_estado_logico'], 'string', 'max' => 1],
            [['apl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aplicacion::className(), 'targetAttribute' => ['apl_id' => 'apl_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mod_id' => Yii::t('app', 'Mod ID'),
            'apl_id' => Yii::t('app', 'Apl ID'),
            'mod_nombre' => Yii::t('app', 'Mod Nombre'),
            'mod_dir_imagen' => Yii::t('app', 'Mod Dir Imagen'),
            'mod_url' => Yii::t('app', 'Mod Url'),
            'mod_orden' => Yii::t('app', 'Mod Orden'),
            'mod_lang_file' => Yii::t('app', 'Mod Lang File'),
            'mod_estado_activo' => Yii::t('app', 'Mod Estado Activo'),
            'mod_fecha_creacion' => Yii::t('app', 'Mod Fecha Creacion'),
            'mod_fecha_modificacion' => Yii::t('app', 'Mod Fecha Modificacion'),
            'mod_estado_logico' => Yii::t('app', 'Mod Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApl()
    {
        return $this->hasOne(Aplicacion::className(), ['apl_id' => 'apl_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetoModulos()
    {
        return $this->hasMany(ObjetoModulo::className(), ['mod_id' => 'mod_id']);
    }
}
