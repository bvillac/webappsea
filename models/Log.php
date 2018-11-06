<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $log_id
 * @property int $usu_id
 * @property int $log_registro
 * @property string $log_accion
 * @property string $log_table
 * @property string $log_fecha
 *
 * @property Usuario $usu
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usu_id', 'log_registro'], 'required'],
            [['usu_id', 'log_registro'], 'integer'],
            [['log_fecha'], 'safe'],
            [['log_accion', 'log_table'], 'string', 'max' => 60],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => Yii::t('app', 'Log ID'),
            'usu_id' => Yii::t('app', 'Usu ID'),
            'log_registro' => Yii::t('app', 'Log Registro'),
            'log_accion' => Yii::t('app', 'Log Accion'),
            'log_table' => Yii::t('app', 'Log Table'),
            'log_fecha' => Yii::t('app', 'Log Fecha'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
}
