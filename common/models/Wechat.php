<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wechat".
 *
 * @property integer $id
 * @property string $open_id
 * @property string $username
 * @property string $nickname
 * @property string $created_at
 */
class Wechat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open_id'], 'required'],
            [['created_at'], 'safe'],
            [['open_id', 'username', 'nickname'], 'string', 'max' => 128],
            ['avatar', 'string', 'max' => 256],
            [['open_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'open_id' => '微信用户ID',
            'username' => '用户名',
            'nickname' => '呢称',
            'avatar' => '头像',
            'created_at' => 'Created At',
        ];
    }
}
