<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//引入百度编辑器
$this->registerJsFile('@web/public/ueditor/jquery-1.11.2.min.js');//注册自定义js
// $this->registerJsFile('@web/public/ueditor/ueditor.config.js');//注册自定义js
// $this->registerJsFile('@web/public/ueditor/ueditor.all.min.js');
$this->registerJsFile('@web/public/ueditor/lang/zh-cn/zh-cn.js');
?>
<script type="text/javascript"></script>
<script type="text/javascript">

    // var ue = UE.getEditor('editor');

</script>
<style>
    .inline .radio,.inline .checkbox{display: inline-block;margin: 0 5px;}
    #editor{margin-top: 20px;padding:0;margin:20px 0;width:100%;height:auto;border: none;}
    
</style>
<?php $form=ActiveForm::begin([
        'id'=>'upload',
        'enableAjaxValidation' => false,
        'options'=>['enctype'=>'multipart/form-data']
    ]);
?>
    <?= $form->field($model,'title')->textInput();?>
    <?= $form->field($model, 'tags')->fileInput();?>
    <?= $form->field($model,'content')->textarea(['rows'=>6,'id'=>'editor','class'=>'col-sm-1 col-md-12']);?>
    <?=  Html::submitButton('提交', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>

<?php ActiveForm::end();?>