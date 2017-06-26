<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = '添加商品';
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productImgList' => $productImgList
    ]) ?>

</div>
