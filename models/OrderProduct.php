<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
// use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "order_product".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $sku
 * @property string $name
 * @property integer $number
 * @property string $market_price
 * @property string $price
 * @property string $thumb
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Order $order
 * @property Product $product
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            // BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name'], 'required'],
            [['order_id', 'product_id', 'number', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            // [['sku'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'user_id' => Yii::t('app','User ID'),
            'order_id' => Yii::t('app','Order ID'),
            'product_id' => Yii::t('app','Product ID'),
            'sku' => Yii::t('app','Sku'),
            'name' => Yii::t('app','Name'),
            'number' => Yii::t('app','Number'),
            'market_price' => Yii::t('app','Market Price'),
            'price' => Yii::t('app','Price'),
            'color' => Yii::t('app','Color'),
            'type' => Yii::t('app','Type'),
            'created_at' => Yii::t('app','Created At'),
            'updated_at' => Yii::t('app','Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
