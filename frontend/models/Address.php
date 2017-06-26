<?php

namespace frontend\models;

use Yii;
use yii\base\Exception;

class Address extends \common\models\Address
{
    /**
     * @inheritdoc
     */
    public function create()
    {
        $this->user_id = Yii::$app->user->id;
        if (!$this->validate()) {
            return false;
        }
        if (!$this->save()) {
            return false;
        }
        return true;
    }
}