<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $sn
 * @property string $consignee
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $remark
 * @property integer $payment_method
 * @property integer $payment_status
 * @property integer $payment_id
 * @property string $payment_name
 * @property string $payment_fee
 * @property integer $shipment_status
 * @property integer $shipment_id
 * @property string $shipment_name
 * @property string $shipment_fee
 * @property string $amount
 * @property string $tax
 * @property string $invoice
 * @property integer $status
 * @property integer $paid_at
 * @property integer $shipped_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sn', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['user_id', 'country', 'province', 'city', 'district', 'payment_method', 'payment_status', 'payment_id', 'shipment_status', 'shipment_id', 'status', 'paid_at', 'shipped_at', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['payment_fee', 'shipment_fee', 'amount', 'tax'], 'number'],
            [['sn', 'phone', 'mobile', 'email'], 'string', 'max' => 32],
            [['consignee'], 'string', 'max' => 64],
            [['address', 'remark', 'shipment_name', 'invoice'], 'string', 'max' => 255],
            [['zipcode'], 'string', 'max' => 16],
            [['payment_name'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sn' => 'Sn',
            'consignee' => 'Consignee',
            'country' => 'Country',
            'province' => 'Province',
            'city' => 'City',
            'district' => 'District',
            'address' => 'Address',
            'zipcode' => 'Zipcode',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'remark' => 'Remark',
            'payment_method' => 'Payment Method',
            'payment_status' => 'Payment Status',
            'payment_id' => 'Payment ID',
            'payment_name' => 'Payment Name',
            'payment_fee' => 'Payment Fee',
            'shipment_status' => 'Shipment Status',
            'shipment_id' => 'Shipment ID',
            'shipment_name' => 'Shipment Name',
            'shipment_fee' => 'Shipment Fee',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'invoice' => 'Invoice',
            'status' => 'Status',
            'paid_at' => 'Paid At',
            'shipped_at' => 'Shipped At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
