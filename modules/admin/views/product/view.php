<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Status;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($model->front) {
   $file = Yii::getAlias('@app' .$model->front);
   // var_dump($file);die;
   $fileType = \yii\helpers\FileHelper::getMimeType($file);
   $data = base64_encode(file_get_contents($file));
}

?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'aid',
            'name',
            'stock',
            'price',
            'color',
            'size',
            [
                'attribute' => 'front',
                'format' => 'image',
                'value' => isset($data) ? "data:" . $fileType .";base64," . $data . "" : ($model->front ? $model->front : ''),
                'options' => ['style' => 'width:100px' ],
                'visible' => isset($model->front),
            ],
            [
                'attribute' => 'back',
                'format' => 'image',
                'value' => isset($data) ? "data:" . $fileType .";base64," . $data . "" : ($model->back ? $model->back : ''),
                'options' => ['style' => 'width:100px' ],
                'visible' => isset($model->back),
            ],
            'keywords',
            'description:ntext',
            'sales',
            [
                'attribute' => 'status',
                'value' => Status::labels($model->status),
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->username,
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy->username,
            ],
        ],
    ]) ?>

</div>
