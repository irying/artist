<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payment_status')->dropDownList(Order::getPaymentStatusLabels()) ?>

    <?= $form->field($model, 'shipment_status')->dropDownList(Order::getShipmentStatusLabels()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
