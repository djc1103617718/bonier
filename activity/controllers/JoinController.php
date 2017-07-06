<?php
namespace activity\controllers;

use Yii;
use activity\models\OrderBefore;
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
 * 参与活动前填写客户信息
 *
 * Site controller
 */
class JoinController extends BaseController
{
    public function actionOrderBefore($id, $product_id)
    {
        $this->layout = false;
        $model = new OrderBefore();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $mold = Activity::joinActivityData($id, $product_id);
            $open_id = Yii::$app->session->get('open_id');

            // 检查活动是否已经发布以及是否已经结束
            $activity = Activity::findOne($id);
            if (($activity->status != Activity::STATUS_PUBLIC) || (strtotime($activity->end_time) < time())) {
                return $this->redirect(Yii::$app->request->referrer);
            }

            $order = new Order();
            $order->open_id = $open_id;
            $order->customer_name = $model->name;
            $order->phone = $model->phone;
            $order->bargained_num = 0;
            $order->product_id = $product_id;
            $order->order_number = IdBuilder::getUniqueId();
            $order->price = $mold['product']['start_price'];
            $order->act_id = $id;
            if (!$order->save()) {
                throw new Exception('error');
            }

            return $this->redirect(['index', 'id' => $order->order_number]);
        }
        $mold = Activity::joinActivityData($id, $product_id);
        $userProductImgList = Activity::userProductImgList($mold['user_id']);
        return $this->render('order-before',[
            'model' => $model,
            'mold' => $mold,
            'userProductImgList' => $userProductImgList,
        ]);
    }

    /**
     * 参加活动
     * Displays homepage.
     *
     * @param @sting $id order_id
     * @return mixed
     * @throws Exception
     */
    public function actionIndex($id)
    {
        $this->layout = false;
        $order = Order::findOne(['order_number' => $id]);
        if (empty($order)) {
            throw new NotFoundHttpException();
        }

        $mold = Activity::joinActivityData($order['act_id'], $order['product_id']);
        $open_id = Yii::$app->session->get('open_id');
        $wechat = Wechat::findOne(['open_id' => $open_id]);

        // 检查活动是否已经发布以及是否已经结束
        $activity = Activity::findOne($order['act_id']);
        if (($activity->status != Activity::STATUS_PUBLIC) || (strtotime($activity->end_time) < time())) {
            return $this->redirect(Yii::$app->request->referrer);
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
     * 确认参加活动(立即提交),生成分享页面
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

    /***
     *  价格变动明细
     *
     * @param string $id order_number
     */
    public function actionBargainDetail($id)
    {
        $order = Order::findOne(['order_number' => $id]);
        if (empty($order)) {
            throw new NotFoundHttpException('找不到对应的页面');
        }

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