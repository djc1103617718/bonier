<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * 媒体文件的分类
 *
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $order_number
 * @property integer $product_id
 * @property string $open_id
 * @property integer $bargained_num
 * @property integer $price
 * @property integer $status
 * @property string $created_at
 */
class Category extends Model
{
    // 用于商品图片的文件
    const CATEGORY_PRODUCT_IMG = '商品图片';
    // 店铺地址图片
    const CATEGORY_ADDRESS_IMG = '店铺地址图片';
    // 顶部轮播图
    const CATEGORY_TOP_CAROUSEL = '顶部轮播图';
    // 背景音乐
    const CATEGORY_BACKEND_MUSIC = '背景音乐';
    // 底部图片
    const CATEGORY_BOTTOM_IMG = '底部图片';

    /**
     * 媒体文件分类list
     * @return array
     */
    public static function categoryList()
    {
        return [
            1 => self::CATEGORY_PRODUCT_IMG,
            2 => self::CATEGORY_TOP_CAROUSEL,
            3 => self::CATEGORY_ADDRESS_IMG,
            4 => self::CATEGORY_BACKEND_MUSIC,
        ];
    }

}