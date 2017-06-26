<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\authManagement\models\AuthItemChild */

$this->title = Yii::t('app', '更新角色/权限关系:') . $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '角色/权限关系'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itemList' => $itemList,
    ]) ?>

</div>
