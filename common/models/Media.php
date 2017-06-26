<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "media".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $category
 * @property integer $type
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 */
class Media extends \yii\db\ActiveRecord
{
    const TYPE_IMG = 1;
    const TYPE_MUSIC = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
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
            [['user_id', 'url'], 'required'],
            [['user_id', 'type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['url'], 'string', 'max' => 256],
            [['category'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            //'name' => 'Name',
            //'description' => 'Description',
            'user_id' => '商户名称',
            'category' => '媒体类别',
            'type' => '文件类型',
            'url' => '图片',
            'created_at' => '上传时间',
            //'updated_at' => 'Updated At',
        ];
    }
}
