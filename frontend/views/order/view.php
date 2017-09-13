<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Order;

/* @var $this yii\web\View */
/* @var $model frontend\models\Order */

$this->title = '订单详情:' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    //$btn->buttonDefault('更新', 'btn btn-primary', 'update')->link(['activity/update', 'id' => $model->id]);
    $btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['order/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除订单',
        'content' => '删除以后将不能恢复,你确定要删除商户吗?'
    ]);
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'order_number',
            'product_id',
            'open_id',
            [
                'label' => '客户名称',
                'attribute' => 'customer_name',
            ],
            'bargained_num',
            [
                'attribute' => 'price',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function($model) {
                    return $model->price/100;
                })
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return \common\helper\views\ColumnDisplay::displayStatus($model->status, [
                        Order::STATUS_DELETE => ['删除', 'label label-default'],
                        Order::STATUS_TEMP => ['临时订单', 'label label-default'],
                        Order::STATUS_VALID => ['正常', 'label label-success'],
                        Order::STATUS_FINISH => ['已完成', 'label label-primary'],
                    ], 1);
                })
            ],
            'created_at',
        ],
    ]) ?>

</div>
