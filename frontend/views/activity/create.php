<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Activity */

$this->title = '创建活动';
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productList' => $productList,
    ]) ?>

</div>
