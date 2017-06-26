<?php

namespace backend\authManagement\models;

use yii\base\Exception;

class AuthItem extends \common\models\AuthItem
{
    const TYPE_ROLE = 1;
    const TYPE_PERMISSION = 2;

    public static function typeList()
    {
        return [
            self::TYPE_ROLE => '角色',
            self::TYPE_PERMISSION => ' 权限',
        ];
    }

    public static function ruleNameList()
    {
        return AuthRule::find()->select('name')->indexBy('name')->asArray()->column();
    }

    public function itemSave($type)
    {
        if (in_array($type, [self::TYPE_ROLE, self::TYPE_PERMISSION])) {
            $this->type = $type;
        } else {
            throw new Exception('param type error!');
        }
        return $this->save();
    }
}