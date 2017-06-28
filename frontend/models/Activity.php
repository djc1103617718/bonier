<?php

namespace frontend\models;

use Yii;
use common\helper\IdBuilder;
use yii\base\Exception;

class Activity extends \common\models\Activity
{
    public $products;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['products', 'required'];
        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['products'] ='参加活动的商品';
        return $labels;
    }

    public function productList()
    {
        return Product::find()
            ->select('name')
            ->indexBy('id')
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['act_id' => NULL])
            ->column();
    }

    public function create()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->products = array_unique($this->products);
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $this->user_id = Yii::$app->user->id;
            if (!$this->save()) {
                throw new Exception('创建失败!');
            }
            $product = Product::updateAll(['act_id' => $this->id], ['id' => $this->products]);
            if (!$product) {
                throw new Exception('更新失败! ');
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    public function updateActivity()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->products = array_unique($this->products);
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($this->update() === false) {
                throw new Exception('创建失败!');
            }
            $oldProducts = Product::updateAll(['act_id' => NULL], ['act_id' => $this->id]);
            if (!$oldProducts) {
                throw new Exception('更新失败! ');
            }


            $product = Product::updateAll(['act_id' => $this->id], ['id' => $this->products]);
            if (!$product) {
                throw new Exception('更新失败! ');
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            //var_dump($e->getMessage());die;
            $transaction->rollBack();
            return false;
        }
    }

    public function deleteActivity()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $product = Product::updateAll(['act_id' => NULL], ['act_id' => $this->id]);
            if (!$product) {
                throw new Exception('更新失败!');
            }
            if (!$this->delete()) {
                throw new Exception('删除失败!');
            };
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

}