<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $product_number
 * @property string $name
 * @property string $description
 * @property integer $act_id
 * @property integer $media_id
 * @property integer $reserve_price
 * @property integer $total
 * @property integer $start_price
 * @property integer $bargain_num
 * @property integer $lave_num
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
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
            [['product_number', 'name', 'reserve_price', 'total', 'start_price', 'bargain_num', 'user_id'], 'required'],
            [['act_id', 'media_id', 'reserve_price', 'total', 'start_price', 'bargain_num', 'lave_num', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_number', 'name'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 356],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_number' => '商品编号',
            'name' => '商品名称',
            'description' => '描叙',
            'act_id' => '活动ID',
            'media_id' => '商品图片ID',
            'reserve_price' => '底价',
            'total' => '参与活动数量',
            'start_price' => '零售价',
            'bargain_num' => '砍价总数',
            'lave_num' => '剩余数量',
            'user_id' => '所属商户',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
