<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = '商品详情:' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('更新', 'btn btn-primary', 'update')->link(['product/update', 'id' => $model->id]);
    $btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['product/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除商品',
        'content' => '删除以后将不能恢复,你确定要删除商户吗?'
    ]);
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'product_number',
            'name',
            'description',
            'act_id',
            [
                'label' => '商品图片',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    $url = \frontend\models\Media::findOne($model->media_id)->url;
                    return "<img style='height: 100px; width: 100px' src='$url'/>";
                })
            ],
            [
                'attribute' => 'reserve_price',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return $model->reserve_price/100;
                })
            ],
            'total',
            [
                'attribute' => 'start_price',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return $model->start_price/100;
                })
            ],
            'bargain_num',
            'lave_num',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
