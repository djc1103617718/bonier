<?php

namespace backend\authManagement\models;

use Yii;
use backend\models\Admin;
use common\models\User;
use yii\base\Exception;

class AuthAssignment extends \common\models\AuthAssignment
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['item_name', 'user_id'], 'uniqueRecord'];
        return $rules;
    }

    public function uniqueRecord($attribute, $param)
    {
        foreach ($this->item_name as $item) {
            $list = AuthAssignment::find()->select('user_id')->where(['item_name' => $item])->asArray()->column();
            if (!empty($list)) {
                foreach ($list as $user_id) {
                    if (in_array($user_id, $this->user_id)) {
                        $username = User::findOne($user_id)->username;
                        $this->addError($attribute, $username . '和' . $item . '的授权关系已经存在,不能重复建立!');
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function createAssignment()
    {
        $insertData = [];
        foreach ($this->item_name as $item) {
            foreach ($this->user_id as $user_id) {
                $insertData[] = [$item, $user_id, time(), time()];
            }
        }
        if ($this->validate()) {
            $conn = Yii::$app->db;
            $transaction = $conn->beginTransaction();
            try {
                $res = $conn->createCommand()->batchInsert('{{%auth_assignment}}', ['item_name', 'user_id', 'created_at', 'updated_at'], $insertData)->execute();
                if (!$res) {
                    throw new Exception('分配权限失败!');
                }
                $transaction->commit();
                return true;
            } catch (Exception $e) {
                $transaction->rollBack();
                return false;
            }
        }
        return false;
    }

    public static function userList()
    {
        return Admin::find()->select('username')->indexBy('id')->asArray()->column();
    }

    public static function itemList()
    {
        return AuthItem::find()->select('name')->indexBy('name')->asArray()->column();
    }
}