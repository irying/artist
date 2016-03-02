<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Region;

class RegionController extends Controller
{
    /**
     * List Region Children for select
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionAjaxListChild($id)
    {
        //'visible' => Yii::$app->user->can('deleteYourAuth'),

        $countChild = Region::find()->where(['parent_id' => $id])->count();
        $children = Region::find()->where(['parent_id' => $id])->all();

        if($countChild > 0)
        {
            echo "<option>" . Yii::t('app', 'Please Select') . "</option>";
            foreach($children as $child)
                echo "<option value='" . $child->id . "'>" . $child->name . "</option>";
        }
        else
        {
            echo "<option>" . Yii::t('app', 'No Option') . "</option>";
        }
    }

}
