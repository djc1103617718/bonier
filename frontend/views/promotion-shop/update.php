<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PromotionShop */

$this->title = '更新推荐商家: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '推荐商家列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-shop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
