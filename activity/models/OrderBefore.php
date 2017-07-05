<?php

namespace activity\models;

use yii\base\Model;

class OrderBefore extends Model
{
    public $phone;
    public $name;

    public function rules()
    {
        return [
          [['phone', 'name'], 'safe']
        ];
    }
}