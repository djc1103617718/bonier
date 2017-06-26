<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\authManagement\models\AuthItem */

$this->title = Yii::t('app', '创建角色');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '角色/权限列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_role_form', [
        'model' => $model,
        'ruleNameList' => $ruleNameList,
    ]) ?>

</div>
