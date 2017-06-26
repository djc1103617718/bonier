<?php

namespace activity\models;

use common\models\Category;
use yii\web\NotFoundHttpException;

class Activity extends \common\models\Activity
{
    /**
     * 所有商品页面的活动数据
     *
     * @param $act_id
     * @return array
     * @throws NotFoundHttpException
     */

    public static function getMoldData($act_id)
    {
        $activity = Activity::findOne($act_id)->toArray();
        if (empty($activity)) {
            throw new NotFoundHttpException('您访问的页面不存在!');
        }
        $products = Product::find()
            ->where(['user_id' => $activity['user_id'], 'act_id' => $act_id])
            ->asArray()
            ->all();
        $activity['products'] = $products;
        $topCarousels = Media::find()
            ->select('url')
            ->where(['user_id' => $activity['user_id'], 'category' => Category::CATEGORY_TOP_CAROUSEL])
            ->column();
        $activity['top_carousels'] = $topCarousels;
        return $activity;
    }

    /**
     * 参加活动时的数据
     * @param $act_id
     * @param $product_id
     * @return array
     * @throws NotFoundHttpException
     */
    public static function joinActivityData($act_id, $product_id)
    {
        $activity = Activity::findOne($act_id)->toArray();
        if (empty($activity)) {
            throw new NotFoundHttpException('您访问的页面不存在!');
        }
        $product = Product::find()->where(['id' => $product_id])->asArray()->one();
        $activity['product'] = $product;
        $topCarousels = Media::find()
            ->select('url')
            ->where(['user_id' => $activity['user_id'], 'category' => Category::CATEGORY_TOP_CAROUSEL])
            ->column();
        $activity['top_carousels'] = $topCarousels;
        return $activity;
    }

    public static function userProductImgList($user_id)
    {
        return  Media::find()
            ->select('url')
            ->where(['user_id' => $user_id, 'type' => Media::TYPE_IMG, 'category' => Category::CATEGORY_PRODUCT_IMG])
            ->indexBy('id')
            ->column();
    }
}