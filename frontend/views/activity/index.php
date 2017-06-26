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
            //'user_id',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'common\components\grid\ActionColumn',
                'template' => '{view}{update}{delete}{preview}',
                'buttons' => [
                    'preview' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['activity/preview', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-eye">预览</span>', $url, ['title' => '预览活动页面']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
