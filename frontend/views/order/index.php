<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'open_id',
            'bargained_num',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return $model->price/100;
                }
            ],
            // 'status',
            // 'created_at',

            [
                'class' => 'common\components\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
