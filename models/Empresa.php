<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $emp_id
 * @property string $emp_nombre
 * @property string $emp_ruc
 * @property string $emp_descripcion
 * @property string $emp_direccion
 * @property string $emp_telefono
 * @property string $emp_est_log
 * @property string $emp_fec_cre
 * @property string $emp_fec_mod
 *
 * @property UsuarioEmpresa[] $usuarioEmpresas
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_fec_cre', 'emp_fec_mod'], 'safe'],
            [['emp_nombre'], 'string', 'max' => 50],
            [['emp_ruc'], 'string', 'max' => 15],
            [['emp_descripcion', 'emp_direccion'], 'string', 'max' => 100],
            [['emp_telefono'], 'string', 'max' => 20],
            [['emp_est_log'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => Yii::t('app', 'Emp ID'),
            'emp_nombre' => Yii::t('app', 'Emp Nombre'),
            'emp_ruc' => Yii::t('app', 'Emp Ruc'),
            'emp_descripcion' => Yii::t('app', 'Emp Descripcion'),
            'emp_direccion' => Yii::t('app', 'Emp Direccion'),
            'emp_telefono' => Yii::t('app', 'Emp Telefono'),
            'emp_est_log' => Yii::t('app', 'Emp Est Log'),
            'emp_fec_cre' => Yii::t('app', 'Emp Fec Cre'),
            'emp_fec_mod' => Yii::t('app', 'Emp Fec Mod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioEmpresas()
    {
        return $this->hasMany(UsuarioEmpresa::className(), ['emp_id' => 'emp_id']);
    }
}
