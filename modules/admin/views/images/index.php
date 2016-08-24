<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '轮播图';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建轮播图', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'aid',
            'cover',
            'one:ntext',
            'two:ntext',
            'three',
            'four',
            'five',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
