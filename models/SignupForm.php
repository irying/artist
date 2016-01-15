<?php
namespace app\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

     /**
     * @inheritdoc
     */
    public function rules()
    {
    	return [
    		[['username', 'email'], 'filter', 'filter' => 'trim'],
    		[['username', 'email', 'password'], 'required'],
    		['username', 'string', 'min' => 2, 'max' => 255],
    		['username', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app', 'This username has already been taken')],
    		['email', 'email'],
    		['email', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app', 'This email has already been taken')],
    		['password', 'string', 'min' => 6],
    	];
    }

     public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

     public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {
            return $user;
        }

    }
}
?>