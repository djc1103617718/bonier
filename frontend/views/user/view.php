<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = '用户详情';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'shop_name',
            'username',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'phone',
            'deadline',
            //'referrals',
            //'auth_key',
            //'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
