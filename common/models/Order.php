<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $act_id
 * @property string $order_number
 * @property integer $product_id
 * @property string $open_id
 * @property integer $bargained_num
 * @property integer $price
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    // 删除
    const STATUS_DELETE = 0;
    // 临时,未确认提交
    const STATUS_TEMP = 1;
    // 已经提交
    const STATUS_VALID = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
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
            [['order_number', 'product_id', 'open_id', 'bargained_num', 'price', 'act_id'], 'required'],
            [['product_id', 'bargained_num', 'price', 'status', 'act_id'], 'integer'],
            [['created_at', 'updated'], 'safe'],
            [['order_number'], 'string', 'max' => 64],
            [['open_id'], 'string', 'max' => 128],
            [['order_number'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_number' => '订单编号',
            'product_id' => '产品',
            'act_id' => '活动',
            'open_id' => '微信用户',
            'bargained_num' => '砍价次数',
            'price' => '当前价格',
            'status' => '订单状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间'
        ];
    }
}
