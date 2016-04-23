<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\YesNo;
    
/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '地址';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建地址', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : '-';
                },
            ],
            // 'user_id',
            'name',
            'consignee',
            // 'country',
            // 'province',
            // 'city',
            // 'district',
            [
                'attribute' => 'region',
                'value' => function ($model){
                    return (isset($model->country0) ? ($model->country0->name) : '-') . (isset($model->province0) ? ($model->province0->name) : '-') . (isset($model->city0) ? ($model->city0->name) : '-') . (isset($model->district0) ? ($model->district0->name) : '-');
                    // var_dump($model->country);
                    // die;
                },
            ],
            'address',
            [
                'attribute' => 'default',
                'format' => 'html',
                'value' => function ($model){
                    if ($model->default === 1){
                        $class = 'label-success';
                    } elseif ($model->default === 0) {
                        $class = 'label-warning';
                    } else {
                        $class = 'label-danger';
                    }

                    return '<span class="label ' . $class . '">' .YesNo::labels($model->default) . '</span>'; 
                },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'default',
                        YesNo::labels(),
                        ['class' => 'form-control', 'prompt' => Yii::t('app', 'PROMPT_STATUS')]
                    )
            ],
            // 'zipcode',
            // 'phone',
            // 'mobile',
            // 'email:email',
            // 'default',
            'created_at:date',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
