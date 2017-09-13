<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Order;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\searches\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $searchWidget =  \common\components\searchWidget\SearchWidget::begin();
    $searchWidget->setDropdownlistAttributes(\frontend\models\searches\OrderSearch::searchAttributes());
    $searchWidget->setSearchModelName('OrderSearch');
    $searchWidget->setSearchColor('gray');
    $searchWidget->setSearchBoxLength(4);
    $searchWidget->setRequestUrl(\yii\helpers\Url::to(['order/index']));
    $searchWidget::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'order_number',
            'product_id',
            [
                'attribute' => 'open_id',
                'label' => '微信昵称',
                'value' => function ($model) {
                    $wechat = \common\models\Wechat::findOne(['open_id' => $model->open_id]);
                    if ($wechat) {
                        return $wechat->nickname;
                    }
                }
            ],
            [
                'label' => '客户名称',
                'attribute' => 'customer_name',
            ],
            'bargained_num',
            [
                'attribute' => 'phone',
                'label' => '联系电话',
            ],
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return $model->price/100;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return \common\helper\views\ColumnDisplay::displayStatus($model->status, [
                        Order::STATUS_DELETE => ['删除', 'label label-default'],
                        Order::STATUS_TEMP => ['临时订单', 'label label-default'],
                        Order::STATUS_VALID => ['正常', 'label label-success'],
                        Order::STATUS_FINISH => ['已完成', 'label label-primary'],
                    ], 1);
                }
            ],
            // 'created_at',

            [
                'class' => 'common\components\grid\ActionColumn',
                'template' => '{view}{finish}',
                'buttons' => [
                    'finish' => function ($url, $model, $key) {
                        return \common\helper\views\ColumnDisplay::operatingDelete(
                            [
                                'url'=> ['order/finish', 'id' => $model->id],
                                'method' => 'post',
                                'title' => '确认订单已经完成',
                                'content' => '您确认该订单已经完成吗?',
                            ],
                            '完成',
                            'fa fa-check-square'
                        );
                        //return Html::a('<span class="fa fa-check-square-o">完成</span>', $url, ['title' => '确认订单完成']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
