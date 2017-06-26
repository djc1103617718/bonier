<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\authManagement\models\AuthItem */

$this->title = Yii::t('app', '更新权限:') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '角色/权限列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', '更新权限');
?>
<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_permission_form', [
        'model' => $model,
        'items' => $items,
        'ruleNameList' => $ruleNameList,
    ]) ?>

</div>
