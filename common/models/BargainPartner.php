<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bargain_partner".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $open_id
 * @property integer $decrease_price
 * @property string $created_at
 */
class BargainPartner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bargain_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'open_id'], 'required'],
            [['order_id', 'decrease_price'], 'integer'],
            ['open_id', 'string', 'max' => 128],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单',
            'open_id' => '微信用户',
            'decrease_price' => '减掉的价格',
            'created_at' => '创建时间',
        ];
    }
}
