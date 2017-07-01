<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\User;

/**
 * Password reset request form
 */
class ResetRequestForm extends Model
{
    public $password;
    public $token;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'validatePSD'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
        ];
    }

    public function validatePSD($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findIdentity(Yii::$app->user->id);
            if (empty($user) || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '密码错误!');
            }
        }
    }


    /**
     * 生成 password_reset_token
     *
     * @return bool
     */
    public function send()
    {
        if (!$this->validate()) {
            return false;
        }
        /* @var $user User */
        $user = User::findIdentity(Yii::$app->user->id);
        if (empty($user) || ($user->status != User::STATUS_ACTIVE) || (!$user->validatePassword($this->password))) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
        $this->token = $user->password_reset_token;
        return true;
    }
}
