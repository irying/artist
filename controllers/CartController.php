<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Product;
use app\models\LoginForm;
use app\models\Article;
use app\models\Cart;
use app\models\Address;
use app\models\Order;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\Request;

class CartController extends Controller
{
	public $layout = 'column';

	public function actionIndex()
	{
		// $this->layout = '';
		$products = Cart::find()->where(['or', 'session_id = "' . Yii::$app->session->id . '"', 'user_id = ' . (Yii::$app->user->id ? Yii::$app->user->id : -1)])->all();
		 return $this->render('index', [
                'products' => $products,
            ]);
	}

	public function actionShop()
	{
		// $this->layout = false;
		$products = Cart::find()->where(['or', 'session_id = "' . Yii::$app->session->id . '"', 'user_id = ' . (Yii::$app->user->id ? Yii::$app->user->id : -1)])->all();
		 return $this->render('shop', [
                'products' => $products,
            ]);
	}

	public function actionCheckout()
	{
		$userId = Yii::$app->user->id;
		$addresses = Address::find()->where(['user_id' => $userId])->all();
		$model = new Order();
		$products = Cart::find()->where(['session_id' => Yii::$app->session->id])->all();
		if (!count($products)) {
            return $this->redirect('/cart');
        } if (count($addresses)) {
            return $this->render('checkout', [
                'model' => $model,
                'addresses' => $addresses,
                'products' => $products,
            ]);
        } else {
            return $this->redirect(['cart/address']);
        }

	}

	public function actionAddress($id = null)
    {
        if ($id) {
            $model = Address::findOne($id);
            if ($model === null)
                throw new NotFoundHttpException('model does not exist.');
        } else {
            $model = new Address();
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if ($model->save())
                return $this->redirect(['cart/checkout']);
        }

        return $this->render('address', [
            'model' => $model,
        ]);
    }

	public function actionAddToCart($id)
	{
		// echo $id;
		// die;
		// return $this->render('add-to-cart');
		return $this->render('add-to-cart', [
            'id' => $id,
        ]);
	}


	public function actionAjaxAdd()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;
		$id = $request->get('id');  
		$color = $request->get('color');  
		$size = $request->get('size'); 
		$number = $request->get('num');  
		$model = Product::findOne($id);
		if (!Yii::$app->session->isActive)
            Yii::$app->session->open();
     	$cart = new Cart();
        $cart->session_id = Yii::$app->session->id;
        $cart->user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->id;
        $cart->product_id = $id;
        $cart->name = $model->name;
        $cart->color = $color;
        $cart->size = $size;
        $cart->number = $number;
        $cart->price = $model->price;
        if($cart->save())
			return [
	            'status' => 1,
	            'productId' => $id,
	            'size' => $size,
	            'color' => $color,
	            ];
	    else
	    	return [
	            'status' => -2,
	            'productId' => $id,
	            'size' => $size,
	            'color' => $color,
	            ];
	}

}