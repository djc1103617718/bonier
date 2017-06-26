<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\searches\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('添加商品', 'btn btn-success', 'add')->link('product/create');
    $btn::end();
    ?>
    <?php
    $searchWidget =  \common\components\searchWidget\SearchWidget::begin();
    $searchWidget->setDropdownlistAttributes(\frontend\models\searches\ProductSearch::searchAttributes());
    $searchWidget->setSearchModelName('ProductSearch');
    $searchWidget->setSearchColor('gray');
    $searchWidget->setSearchBoxLength(4);
    $searchWidget->setRequestUrl(\yii\helpers\Url::to(['Product/index']));
    $searchWidget::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_number',
            'name',
            'description',
            'act_id',
            // 'media_id',
            'reserve_price',
            'total',
            'start_price',
            'bargain_num',
            // 'lave_num',
            // 'created_at',
            // 'updated_at',

            ['class' => 'common\components\grid\ActionColumn'],
        ],
    ]); ?>
</div>
