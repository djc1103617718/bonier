<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */

$this->title = '店铺详情';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('更新', 'btn btn-primary', 'update')->link(['address/update', 'id' => $model->id]);
    /*$btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['address/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除活动',
        'content' => '删除以后将不能恢复,你确定要删除商户吗?'
    ]);*/
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'address',
            'Landline',
            'phone',
            [
                'label' => '店铺地址图片',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    $media = \frontend\models\Media::findOne($model->media_id);
                    if ($media) {
                        return "<img style='height: 100px; width: 100px' src='$media->url'/>";
                    }
                })
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
