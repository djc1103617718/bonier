<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helper\views\ButtonGroup;

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '文件列表'), 'url' => ['index']];
?>

<h1><?= Html::encode($this->title) ?></h1>
<?php $form=ActiveForm::begin([
    'action' => [$action],
    'method' => 'post',
    'id'=>'upload',
    'options'=>['enctype' => "multipart/form-data"]
]);
?>
<?= $form->field($model, 'file')->fileInput();?>
<?=  Html::submitButton('上传', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    /*$(function() {
        var new_line = '<div class="help-block"></div>'+
            '</div><div class="form-group field-uploadform-file">'+
            '<input type="hidden" name="UploadForm[file][]" value=""><input type="file" name="UploadForm[file][]" multiple>'+
            '<div class="help-block"></div>';
        $('#add-line').click(function () {
            $('.field-uploadform-file:last').after(new_line);
        });
        $('#delete-line').click(function () {
            if ($('.field-uploadform-file').length == 1) {
                return false;
            }
            $('.field-uploadform-file:last').remove();
        })
    })*/
</script>

