<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\authManagement\models\AuthItem */

$this->title = Yii::t('app', '更新角色:') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '角色权限列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', '更新角色');
?>
<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_role_form', [
        'model' => $model,
        'ruleNameList' => $ruleNameList,
    ]) ?>

</div>
