<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Landline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <div class="form-group field-product-bargain_num required">
        <p><label class="control-label">请选择店铺地址图片</label></p>
        <div style="border: 1px solid #997100; padding:10px; margin-bottom: 20px;">
            <?php
            if (empty($addressImgList)) {
                echo '请先上传图片';
            } else {
                foreach ($addressImgList as $id => $url) {
                    $str = "<label for='checkbox-01' class='label_check c_on'>";
                    $str .= "<input type='radio' checked='checked' value='$id' id='checkbox-01' name='Address[media_id]' /><img style='height: 100px; width:100px; margin:5px' src='$url'></label>";
                    echo $str;
                }
            }
            ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
