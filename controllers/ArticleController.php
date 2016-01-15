<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Comment;
use app\models\LoginForm;
use app\models\Article;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class ArticleController extends Controller
{
	 public $layout = 'column';
	// 文章列表
 	public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $article = $this-> findModel($id);
        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        		Yii::$app->request->referrer;
        }

        return $this->render('view', ['model' => $model]);
    }

    // 删除评论
    public function actionDel($id)
    {
  
    	$model = new Comment();
    	$cond = ['or', ['id' => $id], ['pid' => $id]];
		$model->deleteAll($cond);
		// Yii::$app->request->referrer;
       return $this->redirect(Yii::$app->request->referrer);
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