<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $article_id
 * @property string $content
 * @property integer $point
 * @property integer $up
 * @property integer $down
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Article $article
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'content'], 'required'],
            [['user_id', 'article_id', 'point', 'up', 'down', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['username'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' =>'pid',
            'user_id' => 'User ID',
            'username' => '用户',
            'article_id' => '文章编号',
            'content' => '评论',
            'point' => 'Point',
            'up' => 'Up',
            'down' => 'Down',
            'status' => 'Status',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
            {
                if($insert)
                {
                    $this->pid=0;
                    $this->created_at=time();
                    $this->updated_at=time();
                }
                else
                    $this->updated_at=time();
                return true;
            }
        else
            return false;
    }
}
