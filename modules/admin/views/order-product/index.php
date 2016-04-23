<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单详情';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'order_id',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return isset($model->user) ? $model->user->username : '-';
                }
            ],
            'id',
            // 'order_id',
            [
                'attribute' => 'product_id',
                'value' => function ($model) {
                    return isset($model->product) ? $model->product->name : '-';
                }
            ],
            // 'sku',
            // 'name',
            'number',
            // 'market_price',
            'price',
            'color',
            'type',
            'created_at:date',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} ',

            ],
        ],
    ]); ?>

</div>
