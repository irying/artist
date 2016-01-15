<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $create_time
 * @property string $update_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'tags'], 'string'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => '作者',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    public function beforeSave($insert)
    {
            if(parent::beforeSave($insert))
                {
                    $this->author_id=1;
                    if($insert)
                    {
                        $this->create_time=time();
                        $this->update_time=time();
                    }
                    else
                        $this->update_time=time();
                    return true;
                }
            else
                return false;
    }

     public function getAuthor()
    {
        // return $this->hasOne(User2::className(), ['id' => 'author_id']);
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
