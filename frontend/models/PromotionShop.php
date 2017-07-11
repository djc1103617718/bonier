<?php

namespace frontend\models;

use Yii;

/**
 * @property int|string user_id
 */
class PromotionShop extends \common\models\PromotionShop
{
    public function create()
    {
        $this->user_id = Yii::$app->user->id;
        if (!$this->save()) {
            return false;
        }
        return true;
    }
}