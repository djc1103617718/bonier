<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searches\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('新增商户', 'btn btn-success', 'add')->link('user/create');
    $btn::end();
    ?>
    <?php
    $searchWidget =  \common\components\searchWidget\SearchWidget::begin();
    $searchWidget->setDropdownlistAttributes(\backend\models\searches\UserSearch::searchAttributes());
    $searchWidget->setSearchModelName('UserSearch');
    $searchWidget->setSearchColor('gray');
    $searchWidget->setSearchBoxLength(4);
    $searchWidget->setRequestUrl(\yii\helpers\Url::to(['user/index']));
    $searchWidget::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'shop_name',
            'username',
            //'password',
            //'password_hash',
            // 'password_reset_token',
            'email:email',
            'phone',
            'deadline',
            // 'auth_key',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return \common\helper\views\ColumnDisplay::disPlayStatus($model->status, [
                        10 => ['正常', 'success'],
                        0 => ['删除', 'default'],
                    ]);
                }
            ],
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'common\components\grid\ActionColumn',
                'template' => '{view}{update}{delete}{unlock}',
                'buttons' => [
                    'unlock' => function ($url, $model, $key) {
                        return \common\helper\views\ColumnDisplay::operatingDelete(
                            [
                                'url'=> ['user/unlock', 'id' => $model->id],
                                'method' => 'post',
                                'title' => '确认解锁该商户',
                                'content' => '您确认要解锁该商户吗?',
                            ],
                            '解锁',
                            'fa fa-unlock'
                        );
                        //return Html::a('<span class="fa fa-check-square-o">完成</span>', $url, ['title' => '确认订单完成']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
