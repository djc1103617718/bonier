<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PromotionShop */

$this->title = '添加推荐商家';
$this->params['breadcrumbs'][] = ['label' => '推荐商家列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
