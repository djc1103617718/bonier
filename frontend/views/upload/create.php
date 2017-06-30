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
    'options'=>['enctype' => "multipart/form-data", 'multiple' => 'multiple']
]);
?>
<?= $form->field($model, 'file')->fileInput();?>
<?=  Html::submitButton('上传', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
<?php ActiveForm::end(); ?>
<!--
<form action="/example/html5/demo_form.asp" method="get" id="form2">
    选择图片：<input type="file" id="input" name="input" onchange="onc()" multiple="multiple" />
    <p> </p>
    <input type="submit" />
</form>

<script type="text/javascript">
    function onc(){
        var files = document.getElementById("input").files;
        var filenames = '';
        for(var i=0; i< files.length; i++){
            if (filenames == '') {
                filenames += input.files[i].name;
            } else {
                filenames
            }
            alert(input.files[i].name);
        }
    }
</script>-->

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

