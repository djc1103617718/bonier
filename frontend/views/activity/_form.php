<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '活动开始时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
        ]
    ]);
    ?>
    <?= $form->field($model, 'end_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '活动结束时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
        ]
    ]);
    ?>

    <?= $form->field($model, 'products')->dropDownList($productList, ['prompt'=>'请选择参加活动的商品...', 'multiple' => 'multiple'])->label('参加活动的商品') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
