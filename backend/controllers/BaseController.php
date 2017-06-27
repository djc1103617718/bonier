<?php

namespace backend\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\UnauthorizedHttpException;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $user_id = Yii::$app->user->id;
        if (!$user_id) {
            return $this->redirect(['site/login']);
        }
        // 方便开发,预设超级管理员
        if (Yii::$app->user->id <= 2) {
            return parent::beforeAction($action);
        }

        // 权限验证
        $module = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $actionId = Yii::$app->controller->action->id;

        if (empty($module) || empty($controller) || empty($actionId)) {
            throw new Exception('路由参数缺失!');
        }

        if ($module != 'app-backend') {
            $module_request_route = Yii::$app->params['authModules'][$module]['module_request_route'];
            $route = $module_request_route . '/' . $controller . '/' . $actionId;
        } else {
            $route = $controller . '/' . $actionId;
        }

        if (Yii::$app->user->can($route)) {
            return parent::beforeAction($action);
        } else {
            throw new UnauthorizedHttpException('你没有操作权限');
        }
    }
}