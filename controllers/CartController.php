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
use app\models\OrderProduct;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\Request;

class CartController extends Controller
{
	public $layout = 'column';

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['shop'],
                'rules' => [
                    [
                        'actions' => ['shop'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],

            ],
        ];
    }

	public function actionIndex()
	{
		// $this->layout = '';
		if (Yii::$app->request->get('type') && Yii::$app->request->get('product_id')) {
			$type = Yii::$app->request->get('type');
			$productId = Yii::$app->request->get('product_id');
			$cartProduct = Cart::find()->where(['session_id' => Yii::$app->session->id, 'product_id' => $productId])->one();

			if ($type == 'minus' && $cartProduct->number >1) 
				Cart::updateAllCounters(['number' => -1], ['session_id' => Yii::$app->session->id, 'product_id' => $productId]);
			elseif ($type == 'add') 
				Cart::updateAllCounters(['number' => 1], ['session_id' => Yii::$app->session->id, 'product_id' => $productId]);
			elseif ($type == 'change' && Yii::$app->request->get('value')){
				// $productId = Yii::$app->request->get('change');
				$value = Yii::$app->request->get('value');
				Cart::updateAll(['number' => $value], ['session_id' => Yii::$app->session->id, 'product_id' => $productId]);
			}

			Cart::deleteAll('number <= 0');
            return;
		}

		$products = Cart::find()->where(['or', 'session_id = "' . Yii::$app->session->id . '"', 'user_id = ' . (Yii::$app->user->id ? Yii::$app->user->id : -1)])->all();
		 return $this->render('index', [
                'products' => $products,
            ]);
	}

	public function actionShop()
	{
		// $this->layout = false;
		$products = Cart::find()->where(['or', 'session_id = "' . Yii::$app->session->id . '"', 'user_id = ' . (Yii::$app->user->id ? Yii::$app->user->id : -1)])->all();
		if(count($products) > 0)
		 	return $this->render('shop', [
                'products' => $products,
            ]);
		else
			return $this->render('cart-no-product', [
                'products' => $products,
            ]);
	}

	public function actionCheckout()
	{
		$userId = Yii::$app->user->id;
		$addresses = Address::find()->where(['user_id' => $userId])->all();
		$model = new Order();

		// 提交订单后处理
		if ($model->load(Yii::$app->request->post())) {
			if (!Yii::$app->request->post('address_id')) {
				return $this->goBack();
			}

			$address = Address::find()->where(['id' => Yii::$app->request->post('address_id'), 'user_id' => $userId])->one();
			$model->user_id = $userId;
			$model->sn = date('YmdHis') . rand(1000, 9999);
			$model->consignee = $address->consignee;
			$model->country = $address->country;
			$model->province = $address->province;
            $model->city = $address->city;
            $model->district = $address->district;
            $model->address = $address->address;
            $model->zipcode = $address->zipcode;
            $model->phone = $address->phone;
            $model->mobile = $address->mobile;
            $model->email = $address->email ? $address->email : Yii::$app->user->identity->email;
            if ($model->payment_method == Order::PAYMENT_METHOD_COD) {
            	$model->payment_status = Order::PAYMENT_STATUS_COD;
            } else {
            	$model->payment_status = Order::PAYMENT_STATUS_UNPAID;
            }

            $model->status = $model->payment_status;

            $products = Cart::find()->where(['session_id' => Yii::$app->session->id])->all();
            if (count($products)) {
            	foreach ($products as $product) {
            		$model->amount += $product->number * $product->price;
            	}
            } else {
            	$this->redirect('/cart/shop');
            }
            $model->amount += floatval($model->shipment_fee);
            // var_dump($model);
            // die;
            // 到保存了
            if ($model->save()) {
            	// echo "<pre>";
            	// print_r($products);
            	// echo "</pre>";
            	// die;
            	foreach ($products as $product ) {
            		$orderProduct = new OrderProduct;
            		$orderProduct->order_id = $model->id;
            		$orderProduct->user_id = $userId;
            		$orderProduct->product_id = $product->product_id;
            		// $orderProduct->sku = $product->sku;
            		$orderProduct->name = $product->name;
            		$orderProduct->number = $product->number;
            		// $orderProduct->market_price = $product->market_price;
            		$orderProduct->price = $product->price;
            		$orderProduct->color = $product->color;
            		$orderProduct->type = $product->size;
            		$orderProduct->save();
            		// 减少商品的库存
            	}
            	// 生成订单后，清空购物车
            	Cart::deleteAll(['session_id' => Yii::$app->session->id]);

            	if ($model->payment_method == Order::PAYMENT_METHOD_COD) {
            		return $this->redirect(['cart/cod', 'id' => $model->id]);
            	} else {
            		return $this->redirect(['cart/pay', 'sn' => $model->sn]);
            	}
            }
		}	

		$products = Cart::find()->where(['session_id' => Yii::$app->session->id])->all();
		if (!count($products)) {
            return $this->redirect('/cart/shop');
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

	public function actionCod($id)
	{
		$model = Order::find()->where(['id' => $id])->one();
		if ($model === null) 
			throw new NotFoundException("model does not exist");

		return $this->render('cod', ['model' => $model]);
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
        $cart->phprice = $model->price;
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

	public function actionDelete($id)
	{
		Cart::deleteAll(['session_id' =>  Yii::$app->session->id, 'product_id' => $id]);
		$this->redirect(['/cart/shop']);
	}

	public function actionDestroy()
	{
		// echo Yii::$app->session->id;
		// die;
		Cart::deleteAll(['session_id' => Yii::$app->session->id]);
		$this->goHome();
	}

}