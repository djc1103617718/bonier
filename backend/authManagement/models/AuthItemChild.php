<?php

namespace backend\authManagement\models;

use Yii;
use yii\base\Exception;

class AuthItemChild extends \common\models\AuthItemChild
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['parent', 'child'], 'relationValidate'];
        $rules[] = [['parent', 'child'], 'relationUnique'];
        return $rules;
    }

    /**
     * 检查权限是否包含角色或者父子级是否同一个选项
     *
     * @param $attribute
     * @param $param
     * @return bool
     */
    public function relationValidate($attribute, $param)
    {
        $parentType = AuthItem::findOne(['name' => $this->parent])->type;
        if (in_array($this->parent, $this->child)) {
            $this->addError($attribute, '权限不能包含角色或者父子级不能是同一个选项');
            return false;
        }
        if ($parentType === AuthItem::TYPE_PERMISSION) {
            $childList = AuthItem::findAll(['name' => $this->child]);
            foreach ($childList as $child) {
                if ($child['type'] === AuthItem::TYPE_ROLE) {
                    $this->addError($attribute, '权限不能包含角色或者父子级不能是同一个选项');
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 检查是否唯一
     *
     * @param $attribute
     * @param $param
     * @return bool
     */
    public function relationUnique($attribute, $param)
    {
        $obj = AuthItemChild::find()->select('child')->where(['parent' => $this->parent])->asArray()->column();
        if (!empty($obj)) {
            foreach ($obj as $item) {
                if (in_array($item, $this->child)) {
                    $this->addError($attribute, $this->parent . '和' . $item . '已经存在父子级关系!');
                    return false;
                }
            }
        }
        return true;
    }

    public static function itemList()
    {
        return AuthItem::find()->select('name')->indexBy('name')->asArray()->column();
    }

    /**
     * 批量插入关系并检查
     *
     * @return bool
     */
    public function createRelation()
    {
        $insertData = [];
        foreach ($this->child as $item) {
            $insertData[] = [$this->parent, $item];
        }
        if ($this->validate()) {
            $conn = Yii::$app->db;
            $transaction = $conn->beginTransaction();
            try {
                $res = $conn->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], $insertData)->execute();
                if (!$res) {
                    throw new Exception('创建关系失败!');
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
}