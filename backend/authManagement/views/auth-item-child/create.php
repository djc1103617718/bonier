<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\authManagement\models\AuthItemChild */

$this->title = Yii::t('app', '创建关系');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '权限/角色关系'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itemList' => $itemList,
    ]) ?>

</div>
