<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artist_product".
 *
 * @property integer $id
 * @property integer $aid
 * @property string $name
 * @property integer $stock
 * @property string $price
 * @property string $color
 * @property string $size
 * @property string $front
 * @property string $back
 * @property string $keywords
 * @property string $description
 * @property integer $sales
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Article $a
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'name'], 'required'],
            [['aid', 'stock', 'sales', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['color'], 'string', 'max' => 100],
            [['size'], 'string', 'max' => 50],
            [['front', 'back', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aid' => 'Aid',
            'name' => 'Name',
            'stock' => 'Stock',
            'price' => 'Price',
            'color' => 'Color',
            'size' => 'Size',
            'front' => 'Front',
            'back' => 'Back',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'sales' => 'Sales',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
            {
                if($insert)
                {
                    $this->created_at=time();
                    $this->updated_at=time();
                    $this->created_by = 1;
                    $this->updated_by = 1;

                }
                else{
                    $this->updated_by = 1;
                    $this->updated_at=time();
                }
                return true;
            }
        else
            return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getA()
    {
        return $this->hasOne(Article::className(), ['id' => 'aid']);
    }
}
