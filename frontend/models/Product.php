<?php
namespace frontend\models;

use common\helper\IdBuilder;
use Yii;

/**
 * Signup form
 */
class Product extends \common\models\Product
{
    public function create()
    {
        $this->product_number = IdBuilder::getUniqueId();
        $this->reserve_price = $this->reserve_price * 100;
        $this->start_price = $this->start_price * 100;
        $this->lave_num = $this->total;
        $this->user_id = Yii::$app->user->id;
        if (!$this->save()) {
            return false;
        }
        return true;
    }

    public function updateProduct()
    {
        $this->reserve_price = $this->reserve_price * 100;
        $this->start_price = $this->start_price * 100;
        $this->lave_num = $this->total;
        if ($this->update() === false) {
            return false;
        }
        return true;
    }
}