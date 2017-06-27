<?php

namespace backend\models;

use Yii;

class User extends \common\models\User
{
    public function rules()
    {
        return [
            [['deadline', 'shop_name'], 'required'],
            [['deadline', 'shop_name', 'referrals'], 'string'],
            ['referrals', 'string', 'max' => 64],
            ['phone', 'number'],
            ['phone', 'string', 'min' => 11],
            ['phone', 'string', 'max' => 11],
            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号已被使用'],
        ];
    }

    /**
     * @return bool
     */
    public function create()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->username = $this->generateUsername();
        $this->password = $this->generatePassword();
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        if (!$this->save()) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    private function generatePassword()
    {
        $length = rand(6, 12);
        return $this->random_str($length);
    }


    /**
     * @return string
     */
    private function generateUsername()
    {
        $length = rand(5,12);
        $tempUsername = $this->random_str($length);
        $existUser = User::findOne(['username' => $tempUsername]);
        if ($existUser) {
           $this->generateUsername();
        } else {
            return $tempUsername;
        }
    }

    /**
     * @param $length
     * @return string
     */
    private function random_str($length)
    {
        //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
        $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

        $str = '';
        $arr_len = count($arr);
        for ($i = 0; $i < $length; $i++)
        {
            $rand = mt_rand(0, $arr_len-1);
            $str.=$arr[$rand];
        }

        return $str;
    }
}