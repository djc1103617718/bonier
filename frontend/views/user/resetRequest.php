<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '密码验证';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset" style="clear: both; margin-top: 25px">

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-request-form']); ?>

            <?= $form->field($model, 'password')->textInput(['autofocus' => true, 'placeholder' => '请输入密码'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
