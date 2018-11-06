<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usu_id
 * @property int $per_id
 * @property string $usu_username
 * @property string $usu_password
 * @property string $usu_sha
 * @property string $usu_session
 * @property string $usu_last_login
 * @property string $usu_link_activo
 * @property string $usu_estado_activo
 * @property string $usu_alias
 * @property string $usu_est_log
 * @property string $usu_fec_cre
 * @property string $usu_fec_mod
 *
 * @property Log[] $logs
 * @property Persona $per
 * @property UsuarioEmpresa[] $usuarioEmpresas
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['per_id', 'usu_estado_activo'], 'required'],
            [['per_id'], 'integer'],
            [['usu_last_login', 'usu_fec_cre', 'usu_fec_mod'], 'safe'],
            [['usu_link_activo'], 'string'],
            [['usu_username'], 'string', 'max' => 45],
            [['usu_password', 'usu_sha', 'usu_session'], 'string', 'max' => 255],
            [['usu_estado_activo', 'usu_est_log'], 'string', 'max' => 1],
            [['usu_alias'], 'string', 'max' => 60],
            [['per_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['per_id' => 'per_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => Yii::t('app', 'Usu ID'),
            'per_id' => Yii::t('app', 'Per ID'),
            'usu_username' => Yii::t('app', 'Usu Username'),
            'usu_password' => Yii::t('app', 'Usu Password'),
            'usu_sha' => Yii::t('app', 'Usu Sha'),
            'usu_session' => Yii::t('app', 'Usu Session'),
            'usu_last_login' => Yii::t('app', 'Usu Last Login'),
            'usu_link_activo' => Yii::t('app', 'Usu Link Activo'),
            'usu_estado_activo' => Yii::t('app', 'Usu Estado Activo'),
            'usu_alias' => Yii::t('app', 'Usu Alias'),
            'usu_est_log' => Yii::t('app', 'Usu Est Log'),
            'usu_fec_cre' => Yii::t('app', 'Usu Fec Cre'),
            'usu_fec_mod' => Yii::t('app', 'Usu Fec Mod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPer()
    {
        return $this->hasOne(Persona::className(), ['per_id' => 'per_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioEmpresas()
    {
        return $this->hasMany(UsuarioEmpresa::className(), ['usu_id' => 'usu_id']);
    }
}
