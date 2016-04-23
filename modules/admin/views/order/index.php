<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($model){
                    return $model->user ? $model->user->username : '-';
                }
            ],
            'sn',
            'consignee',
            // 'country',
            // 'province',
            // 'city',
            // 'district',
            [
                'attribute' => 'region',
                'value' => function ($model){
                    return (isset($model->province0) ? $model->province0->name : '-') . (isset($model->city0) ? $model->city0->name : '-') . (isset($model->district0) ? $model->district0->name : '-');
                }
            ],
            'address',
            // 'zipcode',
            'phone',
            // 'mobile',
            // 'email:email',
            // 'remark',
            // 'payment_method',
            [
                'attribute' => 'payment_status',
                'format' => 'html',
                'value' => function ($model){
                    if ($model->payment_status === Order::PAYMENT_STATUS_PAID) {
                        $class = 'label-success';
                    }else if ($model->payment_status === Order::PAYMENT_STATUS_COD){
                        $class = 'label-warning';
                    }else if ($model->payment_status === Order::PAYMENT_STATUS_UNPAID)
                        $class = 'label-danger';
                    else
                        $class = 'label-info';

                    return '<span class="label '.$class.'">'. ($model->payment_status ? Order::getPaymentStatusLabels($model->payment_status) : '-') .'</span>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'payment_status',
                    Order::getPaymentStatusLabels(),
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'PROMPT_STATUS')]
                ) 
            ],
            // 'payment_id',
            // 'payment_name',
            // 'payment_fee',
            [
                'attribute' => 'shipment_status',
                'format' => 'html',
                'value' => function ($model){
                    if ($model->shipment_status === Order::SHIPMENT_STATUS_RECEIVED) {
                        $class = 'label-success';
                    }else if ($model->shipment_status === Order::SHIPMENT_STATUS_SHIPPED){
                        $class = 'label-warning';
                    }else if ($model->shipment_status === Order::SHIPMENT_STATUS_PREPARING)
                        $class = 'label-danger';
                    else
                        $class = 'label-info';

                    return '<span class="label '.$class.'">'. ($model->shipment_status ? Order::getShipmentStatusLabels($model->shipment_status) : '-') .'</span>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'shipment_status',
                    Order::getShipmentStatusLabels(),
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'PROMPT_STATUS')]
                ) 
            ],
            // 'shipment_id',
            // 'shipment_name',
            // 'shipment_fee',
            'amount',
            // 'tax',
            // 'invoice',
            // 'status',
            // 'paid_at',
            // 'shipped_at',
            'created_at:date',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
