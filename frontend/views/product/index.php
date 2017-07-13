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
            [
                'attribute' => 'act_id',
                'label' => '活动名称',
                'value' => function ($model) {
                    $act = \frontend\models\Activity::findOne($model->act_id);
                    if (!empty($act)) {
                        return $act['name'];
                    }
                }
            ],
            // 'media_id',
            [
                'attribute' => 'reserve_price',
                'value' => function ($model) {
                    return $model->reserve_price/100;
                }
            ],
            'total',
            [
                'attribute' => 'start_price',
                'value' => function ($model) {
                    return $model->start_price/100;
                }
            ],
            'bargain_num',
            //'lave_num',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'common\components\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['product/update', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-edit">编辑</span>', $url, ['title' => '预览活动页面']);
                    },

                ]
            ],
        ],
    ]); ?>
</div>
