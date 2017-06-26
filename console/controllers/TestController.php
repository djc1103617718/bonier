<?php

namespace console\controllers;

use yii\console\Controller;

class TestController extends Controller
{
    public function actionFile()
    {
        var_dump(dirname(__DIR__));
    }
}