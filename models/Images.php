<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artist_images".
 *
 * @property integer $id
 * @property integer $aid
 * @property string $cover
 * @property string $thumb
 * @property string $spare
 * @property string $one
 * @property string $two
 * @property string $three
 * @property string $four
 * @property string $five
 */
class Images extends \yii\db\ActiveRecord
{
    public $carousel;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['aid', 'cover', 'thumb', 'spare', 'one', 'two', 'three', 'four', 'five'], 'required'],
            [['aid'], 'integer'],
            [['cover','one', 'two', 'three', 'four', 'five'], 'string', 'max' => 100]
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
            'cover' => 'Cover',
            'carousel' => '轮播图',
        ];
    }
}
