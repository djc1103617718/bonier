<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Activity */

$this->title = '更新活动: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productList' => $productList,
        'carousels' => $carousels,
        'backend_musics' => $backend_musics,
        'promotionList' => $model->promotionList(),
        'bottomImgList' => $model->bottomImgList(),
    ]) ?>

</div>
