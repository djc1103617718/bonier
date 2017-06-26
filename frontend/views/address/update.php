<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */

$this->title = '更新店铺信息' ;
$this->params['breadcrumbs'][] = ['label' => '店铺详情', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="address-form">

        <?php $form = \yii\widgets\ActiveForm::begin(); ?>

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
            <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>

</div>
