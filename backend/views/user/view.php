<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '商户详情:' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '商户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $btn = \common\helper\views\ButtonGroup::begin();
    $btn->buttonDefault('更新', 'btn btn-primary', 'update')->link(['user/update', 'id' => $model->id]);
    $btn->buttonDefault('删除', 'btn btn-danger', 'delete')->confirm([
        'url' => ['user/delete', 'id' => $model->id],
        'method' => 'post',
        'title' => '删除商户',
        'content' => '删除以后将不能恢复,你确定要删除商户吗?'
    ]);
    $btn::end();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'shop_name',
            'username',
            'password',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'phone',
            'deadline',
            'referrals',
            //'auth_key',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => \yii\helpers\ArrayHelper::getValue($model, function ($model) {
                    return \common\helper\views\ColumnDisplay::disPlayStatus($model->status, [
                        10 => ['正常', 'success'],
                        0 => ['删除', 'default'],
                    ]);
                })
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
