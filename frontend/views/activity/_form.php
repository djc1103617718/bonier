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
    <?= $form->field($model, 'announcement')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'products')->dropDownList($productList, ['multiple' => 'multiple'])->label('参加活动的商品(选择多个商品,windows系统请按住ctrl再选择商品,苹果系统按住command再选择商品)') ?>
    <?= $form->field($model, 'promotion_shop')->dropDownList($promotionList, ['multiple' => 'multiple'])->label('推荐商家(选择多个推荐商家,windows系统请按住ctrl再选择推荐商家,苹果系统按住command再选择推荐商家)') ?>

    <div class="form-group field-product-bargain_num required">
        <p><label class="control-label">请选择活动背景音乐</label></p>
        <div style="border: 1px solid #997100; padding:10px; margin-bottom: 20px;">
            <?php
            if (empty($backend_musics)) {
                echo '请先上传音频文件';
            } else {
                foreach ($backend_musics as $name => $url) {
                    $str = "<label for='checkbox-01' class='label_check c_on'>";
                    $str .= "<input type='radio' checked='checked' value='$url' id='checkbox-01' name='Activity[music]' />$name</label>";
                    echo $str;
                }
            }
            ?>

        </div>
    </div>


    <div class="form-group field-product-bargain_num required">
        <p><label class="control-label">请选择活动顶部轮播图(选择多个轮播图,windows系统请按住ctrl再选择轮播图,苹果系统按住command再选择轮播图)</label></p>
        <div style="border: 1px solid #997100; padding:10px; margin-bottom: 20px;">
            <?php
            if (empty($carousels)) {
                echo '请先上传图片';
            } else {
                foreach ($carousels as $id => $url) {
                    $str = "<label for='checkbox-01' class='label_check c_on'>";
                    $str .= "<input type='checkbox' checked='checked' value='$id' id='checkbox-01' name='Activity[carousels][]' /><img style='height: 100px; width:100px; margin:5px' src='$url'></label>";
                    echo $str;
                }
            }
            ?>

        </div>
    </div>

    <div class="form-group field-product-bargain_num required">
        <p><label class="control-label">请选择活动底部图片</label></p>
        <div style="border: 1px solid #997100; padding:10px; margin-bottom: 20px;">
            <?php
            if (empty($bottomImgList)) {
                echo '请先上传底部图片';
            } else {
                foreach ($bottomImgList as $url) {
                    $str = "<label for='checkbox-01' class='label_check c_on'>";
                    $str .= "<input type='radio' checked='checked' value='$url' id='checkbox-01' name='Activity[bottom_img]' /><img style='height: 100px; width:100px; margin:5px' src='$url'></label>";
                    echo $str;
                }
            }
            ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '确定', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
