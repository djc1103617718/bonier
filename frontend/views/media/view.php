<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Media */

$this->title = '图片详情:' . $model->category;
$this->params['breadcrumbs'][] = ['label' => '图片列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['media/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除文件',
        'content' => '删除以后将不能恢复,你确定要删除吗?'
    ]);
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'category',
            //'type',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return "<img src='{$model->url}'/>";
                })
            ],
            'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
