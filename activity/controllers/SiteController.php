<?php
namespace activity\controllers;

use activity\models\Activity;
use activity\models\AppWechat;
use activity\models\Wechat;
use common\components\HttpQuery;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @param int $id act_id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        $this->layout = false;

        $mold = Activity::getMoldData($id);
        $userProductImgList = Activity::userProductImgList($mold['user_id']);
        //print_r($userProductImgList);die;
        return $this->render('index', [
            'mold' => $mold,
            'userProductImgList' => $userProductImgList,
            'allProductUrl' => Url::to(['site/index', 'id' => $id]),
        ]);
    }

    /**
     * 客户通过微信登陆平台
     *
     */
    public function actionLogin()
    {
        $model = new AppWechat();
        $redirect_url = urlencode('http://' . $model->host . '/bonier/activity/web/index.php?r=site/login-process');
        $scope = 'snsapi_login';
        $request_url = sprintf($model::LOGIN_API, $model->app_id, $redirect_url, $scope);
        return $this->redirect($request_url);




    }

    public function actionLoginProcess()
    {
        $data = Yii::$app->request->get();
        if (!isset($data['code'])) {
            return $this->redirect(['login']);
        }
        $code = $data['code'];
        $model = new AppWechat();
        $request_url = sprintf($model::ACCESS_TOKEN_API, $model->app_id, $model->app_secret, $code);
        try {
            // 获取access_token
            $response = json_decode(file_get_contents($request_url));
            $response = ArrayHelper::toArray($response);
            // 获取用户信息
            $request_user_info_url = sprintf($model::USER_INFO_API, $response['access_token'], $response['openid']);
            $user_info = ArrayHelper::toArray(json_decode(file_get_contents($request_user_info_url)));
            // 已经备案用户只需登陆不需入库操作
            $originWechat = Wechat::findOne(['open_id' => $response['openid']]);
            if (!empty($originWechat)) {
                Yii::$app->session->set('open_id', $response['openid']);
                //var_dump($data['state']);die;
               echo '11111';var_dump(Yii::$app->request->referrer);die;
                return $this->redirect(Yii::$app->request->referrer);
            }
            // 新用户入库
            $wechat = new Wechat();
            $wechat->open_id = $response['openid'];
            $wechat->access_token = $response['access_token'];
            $wechat->refresh_token = $response['refresh_token'];
            $wechat->expires_in = $response['expires_in'];
            $wechat->unionid = $response['unionid'];
            $wechat->avatar = $user_info['headimgurl'];
            $wechat->nickname = $user_info['nickname'];
            $wechat->country = $user_info['country'];
            $wechat->city = $user_info['city'];
            $wechat->province = $user_info['province'];
            $wechat->created_at = date('Y-m-d H:i:s', time());
            if (!$wechat->save()) {
                throw new Exception();
            }
            Yii::$app->session->set('open_id', $wechat->open_id);
            return $this->redirect(Yii::$app->request->referrer);
        } catch (Exception $e) {
            return $this->redirect(['login']);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
