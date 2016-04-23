<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Role;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $token
 * @property string $access_token
 * @property string $password
 * @property string $email
 * @property integer $point
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = -1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $password;
    public $repassword;
    private $_statusLabel;
    private $_role;
    private $_roleLabel;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /*return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'auth_key','email'], 'required'],
            [['username', 'email'], 'unique'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 30],
            [['username', 'access_token', 'password'], 'string', 'max' => 255],
            ['email', 'string', 'max' => 100],
            ['email', 'email'],
            [['auth_key'], 'string', 'max' => 32],
            [['token'], 'string', 'max' => 64]
        ];*/
        return [
            [['username','email'],'required','on' => ['admin-create', 'admin-update']],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            [['username', 'email', 'password', 'repassword'], 'trim', 'on' => ['admin-create', 'admin-update']],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30, 'on' => ['admin-create']],
            [['username', 'email'], 'unique', 'on' => ['admin-create', 'admin-update','signup']],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'on' => ['admin-create', 'admin-update', 'signup']],
            ['username', 'string', 'min' => 3, 'max' => 30, 'on' => ['admin-create', 'admin-update', 'signup']],
            // E-mail
            ['email', 'string', 'max' => 100, 'on' => ['admin-create', 'admin-update', 'signup']],
            ['email', 'email', 'on' => ['admin-create', 'admin-update', 'signup']],
            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            // ['status', 'default', 'value' => self::STATUS_ACTIVE],
            // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username', 'auth_key','email'], 'required', 'on'=> ['signup']],
            [['username', 'password'], 'string', 'max' => 255, 'on'=> ['signup']],
            // [['auth_key'], 'string', 'max' => 32, 'on'=> ['signup']],
            // [['token'], 'string', 'max' => 64, 'on'=> ['signup']]
        ];
    }

    public function scenarios()
    {
        return [
            'admin-create' => ['username', 'email', 'password', 'repassword', 'status', 'role'],
            'admin-update' => ['username', 'email', 'password', 'repassword', 'status', 'role'],
            'signup' => ['username', 'email', 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'role' => '角色',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'password' => Yii::t('app', 'Password'),
            'repassword' => Yii::t('app', 'Repassword'),
        ];
    }

     /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken" is not implemented.');
        
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAuthKey()
    {
         return $this->auth_key;
    }
    
    public function validateAuthKey($authKey)
    {
         return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                // $this->generatePasswordResetToken();
            }
            if($insert){
                $this->created_at=time();
                $this->updated_at=time();
            }
            else
                $this->updated_at=time();
            return true;
        }
        return false;
    }

    // 注册时生成密码哈希
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function findByUserName($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    // 登录时验证密证哈希
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function getArrayRole()
    {
        return ArrayHelper::map(Role::find()->all(),'id','name');
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role']);
    }

    public function getRoleLabel()
    {

        if ($this->_roleLabel === null) {
            $roles = self::getArrayRole();
            $this->_roleLabel = $this->_role ? $roles[$this->role] : '-';
        }
        return $this->_roleLabel;
    }

    public function getStatusLabel()
    {
        if($this->_statusLabel === null){
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }

        return $this->_statusLabel;
    }

    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => '启用',
            self::STATUS_INACTIVE => '禁用',
            self::STATUS_DELETED => '删除',
        ];
    }


}
