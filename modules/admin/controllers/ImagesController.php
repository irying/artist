<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Images;
use app\models\ImagesSearch;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller
{
    public $source;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Images();
        if ($model->load(Yii::$app->request->post())) {
            $this->isUploaded($model);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->isUploaded($model);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function isUploaded($model)
    {
        $up = new UploadForm();
        $up->cover= UploadedFile::getInstance($model, 'cover');
        $up->carousel  = UploadedFile::getInstances($model, 'carousel');
        if ($this->source = $up->upload()) {
            $arr = $this->source;
            $model->cover = $arr['0']; 
            $model->one = $arr['1']; 
            $model->two = $arr['2']; 
            $model->three = $arr['3']; 
            $model->four = $arr['4'];
            $model->five = $arr['5'];     
            // 封面图片处理，有首页大图小图，期刊页列表图缩略图
            $big = Yii::getAlias('@app').'/uploads/big'.pathinfo($arr['0'])['basename'];
            $small = Yii::getAlias('@app').'/uploads/small'.pathinfo($arr['0'])['basename'];
            $list = Yii::getAlias('@app').'/uploads/list'.pathinfo($arr['0'])['basename'];
            $thumb = Yii::getAlias('@app').'/uploads/thumb'.pathinfo($arr['0'])['basename'];
            Image::thumbnail($arr['0'], 640, 426)->save($big, ['quality' =>80]);
            Image::thumbnail($arr['0'], 303, 202)->save($small, ['quality' =>80]);
            Image::thumbnail($arr['0'], 540, 393)->save($list, ['quality' =>80]);
            Image::thumbnail($arr['0'], 46, 30)->save($thumb, ['quality' =>80]); 
        }
            if ( $model->save()) 
            return $this->redirect(['view', 'id' => $model->id]);
        
    }
}
