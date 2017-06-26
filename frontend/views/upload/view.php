<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FileUpdateUpload */

$this->title = 'ID:'.$model->id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '上传文件列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-update-upload-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return "<img src='$model->url'/>";
                })
            ],
            'created_at',
            //'updated_at'
        ],
    ]) ?>

</div>
