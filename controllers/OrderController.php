<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrderController extends Controller
{
	public $layout = 'column';

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@']
					]
				]
			],
		];
	}

	public function actionView($id)
	{
		return  $this->render('view', [
			'model' => $this->findModel($id),
			]);
	}

	protected function findModel($id)
	{
		if (($model = Order::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}


