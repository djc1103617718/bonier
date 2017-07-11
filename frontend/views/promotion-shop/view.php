<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PromotionShop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '推荐商家列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-shop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('添加推荐商家', 'btn btn-success', 'add')->link(['promotion-shop/create']);
    $btn->buttonDefault('更新', 'btn btn-primary', 'update')->link(['promotion-shop/update', 'id' => $model->id]);
    $btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['promotion-shop/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除推荐商家',
        'content' => '删除以后将不能恢复,你确定要删除吗?'
    ]);
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'url:url',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
