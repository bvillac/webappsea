<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $per_id
 * @property string $per_ced_ruc
 * @property string $per_nombre
 * @property string $per_apellido
 * @property string $per_genero
 * @property string $per_fecha_nacimiento
 * @property string $per_estado_civil
 * @property string $per_correo
 * @property string $per_tipo_sangre
 * @property string $per_foto
 * @property string $per_estado_activo
 * @property string $per_est_log
 * @property string $per_fec_cre
 * @property string $per_fec_mod
 *
 * @property DataPersona[] $dataPersonas
 * @property Usuario[] $usuarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['per_fecha_nacimiento', 'per_fec_cre', 'per_fec_mod'], 'safe'],
            [['per_estado_activo'], 'required'],
            [['per_ced_ruc'], 'string', 'max' => 15],
            [['per_nombre', 'per_apellido', 'per_correo', 'per_foto'], 'string', 'max' => 100],
            [['per_genero', 'per_estado_civil', 'per_estado_activo', 'per_est_log'], 'string', 'max' => 1],
            [['per_tipo_sangre'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'per_id' => Yii::t('app', 'Per ID'),
            'per_ced_ruc' => Yii::t('app', 'Per Ced Ruc'),
            'per_nombre' => Yii::t('app', 'Per Nombre'),
            'per_apellido' => Yii::t('app', 'Per Apellido'),
            'per_genero' => Yii::t('app', 'Per Genero'),
            'per_fecha_nacimiento' => Yii::t('app', 'Per Fecha Nacimiento'),
            'per_estado_civil' => Yii::t('app', 'Per Estado Civil'),
            'per_correo' => Yii::t('app', 'Per Correo'),
            'per_tipo_sangre' => Yii::t('app', 'Per Tipo Sangre'),
            'per_foto' => Yii::t('app', 'Per Foto'),
            'per_estado_activo' => Yii::t('app', 'Per Estado Activo'),
            'per_est_log' => Yii::t('app', 'Per Est Log'),
            'per_fec_cre' => Yii::t('app', 'Per Fec Cre'),
            'per_fec_mod' => Yii::t('app', 'Per Fec Mod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataPersonas()
    {
        return $this->hasMany(DataPersona::className(), ['per_id' => 'per_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['per_id' => 'per_id']);
    }
}
