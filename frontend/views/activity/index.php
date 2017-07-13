<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\searches\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('创建活动', 'btn btn-success', 'add')->link('activity/create');
    $btn::end();
    ?>
    <?php
    $searchWidget =  \common\components\searchWidget\SearchWidget::begin();
    $searchWidget->setDropdownlistAttributes(\frontend\models\searches\ActivitySearch::searchAttributes());
    $searchWidget->setSearchModelName('ActivitySearch');
    $searchWidget->setSearchColor('gray');
    $searchWidget->setSearchBoxLength(4);
    $searchWidget->setRequestUrl(\yii\helpers\Url::to(['activity/index']));
    $searchWidget::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'start_time',
            'end_time',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return \common\helper\views\ColumnDisplay::displayStatus($model->status, [
                        1 => ['正常', 'info'],
                        2 => ['已发布', 'success'],
                        0 => ['删除', 'default'],
                    ]);
                }
            ],
            //'user_id',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'common\components\grid\ActionColumn',
                'template' => '{view}{update}{preview}{public}{delete}',
                'buttons' => [
                    'preview' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['activity/preview', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-eye">预览</span>', $url, ['title' => '预览活动页面']);
                    },
                    'public' => function ($url, $model, $key) {
                        return \common\helper\views\ColumnDisplay::operatingDelete(
                            [
                                'url' => ['activity/public', 'id' => $model->id],
                                'method' => 'post',
                                'title' => '确认发布活动',
                                'content' => '发布之前请您确定已经预览该活动,一旦发布该活动,用户将可以下订单,该活动将不可修改和删除,你确定要发布活动吗?',
                            ],
                            '发布',
                            'fa fa-share-square-o'
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
