<?php
namespace activity\controllers;

use Yii;
use activity\models\Product;
use common\models\BargainPartner;
use common\models\Category;
use activity\models\Activity;
use activity\models\Media;
use activity\models\Order;
use common\helper\IdBuilder;
use common\models\Wechat;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class JoinController extends BaseController
{
    /**
     * 参加活动
     * Displays homepage.
     *
     * @param int $id act_id
     * @param int $product_id
     * @return mixed
     * @throws Exception
     */
    public function actionIndex($id, $product_id)
    {
        $this->layout = false;
        $mold = Activity::joinActivityData($id, $product_id);
        $open_id = Yii::$app->session->get('open_id');
        $wechat = Wechat::findOne(['open_id' => $open_id]);

        // 检查活动是否已经发布以及是否已经结束
        $activity = Activity::findOne($id);
        if (($activity->status != Activity::STATUS_PUBLIC) || (strtotime($activity->end_time) < time())) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $order = new Order();
        $order->open_id = $open_id;
        $order->bargained_num = 0;
        $order->product_id = $product_id;
        $order->order_number = IdBuilder::getUniqueId();
        $order->price = $mold['product']['start_price'];
        $order->act_id = $id;
        if (!$order->save()) {
            throw new Exception('error');
        }

        $userProductImgList = Activity::userProductImgList($mold['user_id']);

        return $this->render('index', [
            'mold' => $mold,
            'order' => $order,
            'userProductImgList' => $userProductImgList,
            'wechat' => $wechat,
        ]);
    }

    /**
     * 确认参加活动(立即提交)
     *
     * @param string $id order_number
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionConfirm($id)
    {
        $order = Order::findOne(['order_number' => $id]);
        if (empty($order)) {
            throw new NotFoundHttpException('找不到对应的页面');
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $order->status = Order::STATUS_VALID;
            if ($order->update() === false) {
                throw new Exception('error');
            }

            $product = Product::findOne($order->product_id);
            $product->participants +=1;
            $product->lave_num = $product->total -1;
            if ($product->update() === false) {
                throw new Exception('error');
            }
            $transaction->commit();
            // 帮忙砍价的页面
            return $this->redirect(['share/index', 'id' => $id]);
        } catch (Exception $e) {
            $transaction->rollBack();
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    /**
     * 帮忙砍价
     *
     * @param string $id order_number
     * @return \yii\web\Response
     */
    public function actionHelpBargain($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $order = Order::findOne(['order_number' => $id]);
            if (empty($order)) {
                throw new NotFoundHttpException('找不到对应的页面');
            }
            // 检查是否活动已经结束
            $activity = Activity::find()
                ->where(['id' => $order->act_id])
                ->one();
            if (empty($activity) || (strtotime($activity->end_time) < time())) {
                return $this->redirect(Yii::$app->request->referrer);
            }

            // 检查是否已经为他减少过价格
            $open_id = Yii::$app->session->get('open_id');
            $bp = BargainPartner::findOne(['open_id' => $open_id, 'order_id' => $order->id]);
            if (!empty($bp)) {
                return $this->redirect(Yii::$app->request->referrer);
            }

            // 新人参与帮忙减价并入库
            $bargainPartner = new BargainPartner();
            $bargainPartner->open_id = $open_id;
            $bargainPartner->created_at = date('Y-m-d H:i:s', time());
            $bargainPartner->order_id = $order->id;
            $bargained_num = $order->bargained_num;
            $product = Product::findOne($order->product_id);
            $remained_bargained_num = $product->bargain_num - $bargained_num;
            $remained_price = $order->price - $product->reserve_price;
            $bargainPartner->decrease_price = $this->randBargain($remained_bargained_num, $remained_price);
            if (!$bargainPartner->save()) {
                throw new Exception('error');
            }

            $order->bargained_num += 1;
            $order->price -= $bargainPartner->decrease_price;
            if (!$order->update()) {
                throw new Exception('error');
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->redirect(['share/index', 'id' => $order->order_number]);

    }

    /**
     * 购物车
     *
     * @param int $id act_id
     * @return string
     */
    public function actionMyProduct($id)
    {
        $this->layout = false;
        $activity = Activity::findOne($id)->toArray();
        $open_id = Yii::$app->session->get('open_id');
        $orders = Order::find()
            ->where(['open_id' => $open_id, 'status' => Order::STATUS_VALID, 'act_id' => $id])
            ->indexBy('product_id')
            ->asArray()
            ->all();
        $myProductIds = Order::find()
            ->select('id')
            ->where(['open_id' => $open_id, 'status' => Order::STATUS_VALID, 'act_id' => $id])
            ->column();
        $myProducts = Product::find()
            ->where(['id' => $myProductIds])
            ->asArray()
            ->all();
        $topCarousels = Media::find()
            ->select('url')
            ->where(['user_id' => $activity['user_id'], 'category' => Category::CATEGORY_TOP_CAROUSEL])
            ->column();
        $userProductImgList = Activity::userProductImgList($activity['user_id']);
        //var_dump($myProducts);die;
        return $this->render('my-product', [
            'activity' => $activity,
            'userProductImgList' => $userProductImgList,
            'orders' => $orders,
            'myProducts' => $myProducts,
            'topCarousels' => $topCarousels

        ]);
    }

    private function randBargain($remained_num, $remained_price)
    {
        $arr = $this->randomDivInt($remained_num, $remained_price);
        $rand_key = rand(0, $remained_num-1);
        return $arr[$rand_key];
    }

    /**
     * 将总数分成若干份
     *
     * @param integer $div 分成的份数
     * @param integer $total 总数
     * @return array
     */
    private function randomDivInt($div,$total){
        $remain=$total;
        $max_sum=($div-1)*$div/2;
        $p=$div; $min=0;
        $a=array();
        for($i=0; $i<$div-1; $i++){
            $max=($remain-$max_sum)/($div-$i);
            $e=rand($min,$max);
            $min=$e+1; $max_sum-=--$p;
            $remain-=$e;
            $a[$e]=true;
        }
        $a=array_keys($a);
        $a[]=$remain;
        return $a;
    }
}