<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reserve_price')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'start_price')->textInput() ?>

    <?= $form->field($model, 'bargain_num')->textInput() ?>

    <div class="form-group field-product-bargain_num required">
        <p><label class="control-label">请选择商品图片</label></p>
        <div style="border: 1px solid #997100; padding:10px; margin-bottom: 20px;">
            <?php
            if (empty($productImgList)) {
                echo '请先上传商品图片';
            } else {
                foreach ($productImgList as $id => $url) {
                    $str = "<label for='checkbox-01' class='label_check c_on'>";
                    $str .= "<input type='radio' checked='checked' value='$id' id='checkbox-01' name='Product[media_id]' /><img style='height: 100px; width:100px; margin:5px' src='$url'></label>";
                    echo $str;
                }
            }
            ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
