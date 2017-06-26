<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = '更新商品: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productImgList' => $productImgList
    ]) ?>

</div>
