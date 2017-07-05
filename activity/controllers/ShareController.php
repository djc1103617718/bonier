<?php
namespace activity\controllers;

use Yii;
use activity\models\Address;
use activity\models\Media;
use common\models\User;
use activity\models\Activity;
use activity\models\Order;
use common\models\Wechat;
use yii\web\Controller;

/**
 * 可以直接分享出去帮忙砍价的页面
 *
 * Site controller
 */
class ShareController extends Controller
{
    /**
     * 可以直接分享出去帮忙砍价的页面
     *
     * @param string $id order_number
     * @return string
     */
    public function actionIndex($id)
    {
        $order = Order::findOne(['order_number' => $id]);
        $this->layout = false;
        $mold = Activity::joinActivityData($order->act_id, $order->product_id);
        $open_id = $order->open_id;
        $wechat = Wechat::findOne(['open_id' => $open_id]);
        $userProductImgList = Activity::userProductImgList($mold['user_id']);
        return $this->render('index', [
            'mold' => $mold,
            'order' => $order,
            'userProductImgList' => $userProductImgList,
            'wechat' => $wechat,
        ]);
    }

    /**
     * @param int $id act_id
     * @return string
     */
    public function actionAddress($id)
    {
        $this->layout = false;
        $activity = Activity::findOne($id);
        $address = Address::findOne(['user_id' => $activity['user_id']]);
        if (empty($address)) {
            echo '该商户没有设置店铺地址,请联系商户';
            exit;
        }
        $address = $address->toArray();
        if ($address['media_id']) {
            $address['media_img'] = Media::findOne($address['media_id'])->url;
        }
        $shop_name = User::findOne($activity->user_id)->shop_name;
        return $this->render('address', [
            'address' => $address,
            'shop_name' => $shop_name,
            'act_id' => $id
        ]);
    }
}
