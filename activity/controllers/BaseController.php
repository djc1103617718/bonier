<?php
namespace activity\controllers;

use common\helper\IdBuilder;
use common\models\Wechat;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class BaseController extends Controller
{
    public function beforeAction($action)
    {
        // 检查用户是否已经登录
        $session = Yii::$app->session;
        if (!$session->get('open_id')) {
            // 检查session是否开启
            if (!$session->isActive) {
                $session->open();
            }
            // 保存登录信息并写入session为会话访问验证用户是否登录
            // 生成模拟微信登录用户入库和session
            $wechat = new Wechat();
            $wechat->username = $this->generateUsername();
            $length = rand(5,12);
            $wechat->nickname = $this->random_str($length);
            $wechat->created_at = date('Y-m-d H:i:s', time());
            $wechat->open_id = IdBuilder::getUniqueId();
            if (!$wechat->save()) {
                throw new Exception('error');
            }
            $session->set('open_id', $wechat->open_id);
        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub

    }


    private function generateUsername()
    {
        $length = rand(5,12);
        $tempUsername = $this->random_str($length);
        $existUser = Wechat::findOne(['username' => $tempUsername]);
        if ($existUser) {
            $this->generateUsername();
        } else {
            return $tempUsername;
        }
    }

    /**
     * @param $length
     * @return string
     */
    private function random_str($length)
    {
        //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
        $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

        $str = '';
        $arr_len = count($arr);
        for ($i = 0; $i < $length; $i++)
        {
            $rand = mt_rand(0, $arr_len-1);
            $str.=$arr[$rand];
        }

        return $str;
    }
}