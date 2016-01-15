<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\imagine\Image;
/* @var $this yii\web\View */
/* @var $model app\models\Images */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Image::thumbnail(Yii::getAlias('@app/uploads/a201512131.jpg'), 640, 426)
// ->save(Yii::getAlias('@app/uploads/a201512134.jpg'), ['quality' => 100]);

?>
<div class="images-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'cover',
            'one',
            'two',
            'three',
            'four',
            'five',
        ],
    ]) ?>

</div>
