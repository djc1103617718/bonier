<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\authManagement\models\AuthItem */

$this->title = Yii::t('app', '创建权限');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '角色/权限列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_permission_form', [
        'model' => $model,
        'items' => $items,
        'ruleNameList' => $ruleNameList,
    ]) ?>

</div>
