<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_time
 * @property string $end_time
 * @property integer $user_id
 * @property integer $status
 * @property string $announcement
 * @property string $promotion_shop
 * @property string $bottom_img
 * @property string $music
 * @property string $carousels
 * @property string $created_at
 * @property string $updated_at
 */
class Activity extends \yii\db\ActiveRecord
{
    // 正式发布活动
    const STATUS_PUBLIC = 2;
    const STATUS_NORMAL = 1;
    const STATUS_DELETE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
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
            [['start_time', 'end_time', 'carousels'], 'required'],
            [['start_time', 'end_time', 'created_at', 'updated_at', 'music'], 'safe'],
            [['user_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 128],
            ['announcement', 'string', 'max' => 356],
            ['bottom_img', 'string', 'max' => 256],
            ['promotion_shop', 'string', 'max' => 456],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '活动名称',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'user_id' => '创建活动的用户',
            'status' => '状态',
            'announcement' => '公告',
            'promotion_shop' => '推荐商家',
            'bottom_img' => '底部图片',
            'carousels' => '顶部轮播图',
            'music' => '背景音乐',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
