<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'aid') ?>

    <?= $form->field($model, 'cover') ?>

    <?= $form->field($model, 'thumb') ?>

    <?= $form->field($model, 'spare') ?>

    <?php // echo $form->field($model, 'one') ?>

    <?php // echo $form->field($model, 'two') ?>

    <?php // echo $form->field($model, 'three') ?>

    <?php // echo $form->field($model, 'four') ?>

    <?php // echo $form->field($model, 'five') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
