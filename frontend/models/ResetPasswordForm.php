<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use frontend\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    public $rePassword;

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
            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 12],
            [['rePassword', 'password'], 'equalPassword', 'skipOnError' => false, 'skipOnEmpty'=> false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', '新密码'),
            'rePassword' => Yii::t('app', '确认密码'),
        ];
    }

    public function equalPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->rePassword) {
                $this->addError($attribute, '两次输入的密码不一致');
            }
        }
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
