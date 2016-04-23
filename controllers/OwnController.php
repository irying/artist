<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
// use yii\filters\VerbFilter;

class OwnController extends Controller
{
    public $layout = 'column';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],

            ],
        ];
    }
    // 个人中心
    public function actionIndex()
    {
        return $this->render('index');
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !==  null) {
            return $model;
        }else{
            throw new NotFoundException("The requested page does not exist");
            
        }
    }

}

?>