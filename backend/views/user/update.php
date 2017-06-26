<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '更新商户: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '商户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '商户详情:' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
