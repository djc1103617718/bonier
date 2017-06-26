<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Admin;

/* @var $this yii\web\View */
/* @var $searchModel backend\authManagement\models\searchs\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Auth Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Auth Assignment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_name',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Admin::findOne(['id' => $model->user_id, 'status' => Admin::STATUS_ACTIVE])->username;
                }
            ],
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
