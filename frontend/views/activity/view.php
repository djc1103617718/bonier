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
            //'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
