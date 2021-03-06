<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Product;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post())) {
           // var_dump($_POST);
            $this->isUploaded($model);
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function isUploaded($model)
    {
        $up = new UploadForm();
        $up->scenario = 'productUpload';
        $up->front= UploadedFile::getInstance($model, 'front');
        $up->back= UploadedFile::getInstance($model, 'back');
        if ($this->source = $up->productUpload()) {
            $arr = $this->source;
            $model->front = '/uoploads/'.basename($arr['0']); 
            $model->back = '/uoploads/'.basename($arr['1']); 
            // 封面图片处理，正面反面
            $frontName = Yii::getAlias('@app').'/uploads/'.pathinfo($arr['0'])['basename'];
            $backName = Yii::getAlias('@app').'/uploads/'.pathinfo($arr['1'])['basename'];
            Image::thumbnail($arr['0'], 240, 240)->save($frontName, ['quality' =>80]);
            Image::thumbnail($arr['1'], 240, 240)->save($backName, ['quality' =>80]);
            if ( $model->save()) 
            return $this->redirect(['view', 'id' => $model->id]);
        
        }
    } 
}
