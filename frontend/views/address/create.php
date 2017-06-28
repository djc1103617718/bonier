<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Address */

$this->title = '添加店铺信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'addressImgList' => $addressImgList
    ]) ?>

</div>
