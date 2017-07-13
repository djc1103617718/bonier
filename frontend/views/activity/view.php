<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Activity */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('预览', 'btn btn-info', 'view')->link(['activity/preview', 'id' => $model->id]);
    $btn->button('发布', 'btn btn-warning', null, 'fa fa-share-square-o')->confirm([
        'url' => ['activity/public', 'id' => $model->id],
        'method' => 'post',
        'title' => '发布活动',
        'content' => '发布之前请您确定已经预览了活动,一旦发布该活动,用户将可以下订单,该活动将不可修改和删除,你确定要发布活动吗?'
    ]);
    $btn->buttonDefault('更新', 'btn btn-primary', 'update')->link(['activity/update', 'id' => $model->id]);
    $btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['activity/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除活动',
        'content' => '删除以后将不能恢复,你确定要删除商户吗?'
    ]);
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'start_time',
            'end_time',
            'announcement',
            //'promotion_shop',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return \common\helper\views\ColumnDisplay::displayStatus($model->status, [
                        1 => ['正常', 'info'],
                        2 => ['已发布', 'success'],
                        0 => ['删除', 'default'],
                    ]);
                })
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
