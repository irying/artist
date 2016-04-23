<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            // 'auth_key',
            // 'token',
            // 'access_token',
            // 'password_hash',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function ($model){
                                return ($model->role === '1') ? '超级管理员' : (($model->role === '2') ? '普通管理员' : '-');
                            },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'role',
                        User::getArrayRole(),
                        ['class' => 'form-control', 'prompt' => '请筛选']
                        )
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model){
                    if ($model->status === $model::STATUS_ACTIVE) {
                        $class = 'label-success';
                    }elseif ($model->status === $model::STATUS_INACTIVE) {
                            $class = 'label-warning';
                        } else {
                            $class = 'label-danger';
                        }

                        return '<span class="label '.$class. '">'.$model->statusLabel.'</span>';
                },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        $arrayStatus,
                        ['class' => 'form-control', 'prompt' => '请筛选']
                    )

            ],
            // 'point',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
