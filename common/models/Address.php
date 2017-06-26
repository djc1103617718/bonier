<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $address
 * @property string $Landline
 * @property integer $phone
 * @property string $media_id
 * @property string $created_at
 * @property string $updated_at
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'address'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['address', 'media_id'], 'string', 'max' => 256],
            ['phone', 'string', 'max' => 11],
            [['Landline'], 'string', 'max' => 36],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户',
            'address' => '线下门店地址',
            'Landline' => '座机号',
            'phone' => '手机号',
            'media_id' => '门店图片',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
