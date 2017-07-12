<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\searches\PromotionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '推荐商家列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-shop-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('添加推荐商家', 'btn btn-success', 'add')->link('promotion-shop/create');
    $btn::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'url:url',
            'created_at',
            'updated_at',

            ['class' => 'common\components\grid\ActionColumn'],
        ],
    ]); ?>
</div>
