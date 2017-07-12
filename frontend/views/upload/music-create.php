<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helper\views\ButtonGroup;

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '文件列表'), 'url' => ['index']];
?>

<h1><?= Html::encode($this->title) ?></h1>


<form action="<?=\yii\helpers\Url::to([$action])?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->getCsrfToken()?>"/>
    <br/>
    请选择文件：<br/><input type="file" id="input" name="upload" onchange="onc()" multiple="multiple" />
    <br/>
    <p id='fileTips'> </p>
    <br/>
    <input type="submit" />
</form>

<script type="text/javascript">
    function onc(){
        var files = document.getElementById("input").files;
        var fileNames = '';
        for(var i=0; i< files.length; i++){
            if (fileNames == '') {
                fileNames += '您上传的文件:' + input.files[i].name;
            } else {
                fileNames += ',' + input.files[i].name;
            }
            $('#fileTips').text(fileNames);
            //alert(input.files[i].name);
        }
    }
</script>


