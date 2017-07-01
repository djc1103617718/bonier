<?php

namespace frontend\models;

use Yii;
use common\helper\IdBuilder;
use yii\base\Exception;

class Order extends \common\models\Order
{
    public function finish()
    {
        $this->status = self::STATUS_FINISH;
        if ($this->update() === false) {
            return false;
        }
        return true;
    }
}