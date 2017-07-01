<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use frontend\models\User;

/**
 * Password reset form
 */
class UpdateUserForm extends Model
{
    public $username;

    public $email;

    public $phone;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['phone', 'string', 'max' => 11, 'min' => 11],
            [['username'], 'string', 'max' => 50],
            [['phone'], 'isUniquePhone', 'skipOnError' => false, 'skipOnEmpty'=> false],
            [['username'], 'isUniqueUsername', 'skipOnError' => false, 'skipOnEmpty'=> false],
            [['email'], 'isUniqueEmail', 'skipOnError' => false, 'skipOnEmpty'=> false],
         ];
    }

    public function isUniquePhone($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $onePhone = User::find()
                ->where(['phone' => $this->phone])
                ->andWhere(['<>', 'id', $this->_user->id])
                ->one();
            if (!empty($onePhone)) {
                $this->addError($attribute, '该手机号已经占用');
            }
        }
    }

    public function isUniqueUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $oneUsername = User::find()
                ->where(['username' => $this->username])
                ->andWhere(['<>', 'id', $this->_user->id])
                ->one();
            if (!empty($oneUsername)) {
                $this->addError($attribute, '该用户名已经占用');
            }

        }
    }

    public function isUniqueEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $oneEmail = User::find()
                ->where(['email' => $this->email])
                ->andWhere(['<>', 'id', $this->_user->id])
                ->one();
            if (!empty($oneEmail)) {
                $this->addError($attribute, '该邮箱已经占用');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'phone' => Yii::t('app', '手机号'),
            'username' => Yii::t('app', '用户名'),
            'email' => Yii::t('app', '邮箱'),
        ];
    }

    public function updateUser()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = $this->_user;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->username = $this->username;
        if ($user->update() === false) {
            return false;
        }
        return true;
    }
}
