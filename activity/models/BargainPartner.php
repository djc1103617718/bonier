<?php

namespace activity\models;

use Yii;
use yii\web\NotFoundHttpException;

class BargainPartner extends \common\models\BargainPartner
{
    public static function bargainList($order_number)
    {
        $order = Order::findOne(['order_number' => $order_number]);
        if (empty($order)) {
            throw new NotFoundHttpException();
        }
        $sql = "SELECT w.*, b.decrease_price FROM bargainPartner b INNER JOIN wechat w ON w.open_id = b.open_id WHERE b.order_id=$order->id";
        $response = Yii::$app->db->createCommand($sql)->queryAll();
        return $response;

    }
}