<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderProduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '订单详情', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // [
            //     'label' => 'user_id',
            //     'value' => function ($model) {
            //         return $model->user->username;
            //     }
            // ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            'order_id',
            'product_id',
            // 'sku',
            'name',
            'number',
            // 'market_price',
            'price',
            'color',
            'type',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
