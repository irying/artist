<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Region;
use app\models\YesNo;
/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'user_id')->textInput() ?> 
    <?php } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'consignee')->textInput(['maxlength' => 64]) ?>

    <?php 
        $dataCountry = ArrayHelper::map(Region::find()->asArray()->where(['parent_id' => 0])->all(), 'id', 'name');
        echo $form->field($model, 'country')->dropDownList(
                $dataCountry,
                [
                    'prompt' => Yii::t('app','Please Select'),
                    'onchange' => '$.post( "'.Yii::$app->urlManager->createUrl('region/ajax-list-child?id=').'"+$(this).val(), function( data ){
                        $( "select#address-province" ).html( data );
                    });'
                ]); 
        $dataProvince = ArrayHelper::map(Region::find()->asArray()->where(['parent_id' => $model->country])->all(), 'id', 'name');
        echo $form->field($model, 'province')->dropDownList(
                $model->city ? $dataProvince : [],
                [
                    // 'prompt' => Yii::t('app','Please Select'),
                    'onchange' => '$.post( "'.Yii::$app->urlManager->createUrl('region/ajax-list-child?id=').'"+$(this).val(), function( data ){
                        $( "select#address-city" ).html( data );
                    });'
                ]); 

        $dataCity = ArrayHelper::map(Region::find()->asArray()->where(['parent_id' => $model->province])->all(), 'id', 'name');
        echo $form->field($model, 'city')->dropDownList(
                $model->city ? $dataCity : [],
                [
                    // 'prompt' => Yii::t('app','Please Select'),
                    'onchange' => '$.post( "'.Yii::$app->urlManager->createUrl('region/ajax-list-child?id=').'"+$(this).val(), function( data ){
                        $( "select#address-district" ).html( data );
                    });'
                ]);

        $dataDistrict = ArrayHelper::map(Region::find()->asArray()->where(['parent_id' => $model->city])->all(), 'id', 'name');
        echo $form->field($model, 'district')->dropDownList(
                $model->district ? $dataDistrict : []);
    ?>


    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default')->dropDownList(YesNo::labels()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
