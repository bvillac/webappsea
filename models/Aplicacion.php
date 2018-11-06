<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aplicacion".
 *
 * @property int $apl_id
 * @property string $apl_nombre
 * @property string $apl_tipo
 * @property string $apl_lang_file
 * @property string $apl_est_log
 * @property string $apl_fec_cre
 * @property string $apl_fec_mod
 *
 * @property Modulo[] $modulos
 */
class Aplicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aplicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apl_fec_cre', 'apl_fec_mod'], 'safe'],
            [['apl_nombre'], 'string', 'max' => 50],
            [['apl_tipo'], 'string', 'max' => 45],
            [['apl_lang_file'], 'string', 'max' => 100],
            [['apl_est_log'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apl_id' => Yii::t('app', 'Apl ID'),
            'apl_nombre' => Yii::t('app', 'Apl Nombre'),
            'apl_tipo' => Yii::t('app', 'Apl Tipo'),
            'apl_lang_file' => Yii::t('app', 'Apl Lang File'),
            'apl_est_log' => Yii::t('app', 'Apl Est Log'),
            'apl_fec_cre' => Yii::t('app', 'Apl Fec Cre'),
            'apl_fec_mod' => Yii::t('app', 'Apl Fec Mod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulo::className(), ['apl_id' => 'apl_id']);
    }
}
