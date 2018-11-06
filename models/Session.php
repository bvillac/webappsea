<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $id
 * @property int $expire
 * @property resource $data
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'expire' => Yii::t('app', 'Expire'),
            'data' => Yii::t('app', 'Data'),
        ];
    }
}
