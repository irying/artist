<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\article;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $model = new Article;
        return $this->render('index', [
            'model' => $model,
        ]);
    }

 //    public function actions(){
	//     return [
	//         'upload'=>[
	//             'class' => 'app\components\ueditor\UeditorAction',
	//             'config'=>[
	//                 //上传图片配置
	//                 'imageUrlPrefix' => "", /* 图片访问路径前缀 */
	//                 'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
	//             ]
	//         ]
	//     ];
	// }
}
