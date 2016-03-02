<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $path
 * @property string $language
 * @property integer $grade
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'grade'], 'integer'],
            [['name', 'language'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['path'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'path' => 'Path',
            'language' => 'Language',
            'grade' => 'Grade',
        ];
    }
}
