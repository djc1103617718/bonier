<?php
namespace activity\controllers;

use activity\models\Activity;
use activity\models\Address;
use activity\models\AppWechat;
use activity\models\Product;
use activity\models\Wechat;
use common\components\HttpQuery;
use common\models\User;
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
        //var_dump(date('Y-m-d H:i:s', 1500794668845));die;
        $this->layout = false;
        $activity = Activity::findOne($id);
        if (empty($activity)) {
            throw new NotFoundHttpException('找不到该页面!');
        }
        $activity['pageviews'] += 1;
        $activity->update();
        $mold = Activity::getMoldData($id);
        $userProductImgList = Activity::userProductImgList($mold['user_id']);
        $user = User::findOne($mold['user_id']);
        if (!isset($user['shop_name']) || empty($user['shop_name'])) {
            Yii::$app->session->setFlash('error', '您还没有设置店铺名称');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $address = Address::find()->where(['user_id' => $mold['user_id']])->one();
        if (empty($address)) {
            Yii::$app->session->setFlash('error', '请完善店铺信息');
            return $this->redirect(Yii::$app->request->referrer);
        }
        //print_r($userProductImgList);die;
        return $this->render('index', [
            'mold' => $mold,
            'userProductImgList' => $userProductImgList,
            'allProductUrl' => Url::to(['site/index', 'id' => $id]),
            'shop_name' => $user['shop_name'],
            'address' => $address
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
        $request_url = sprintf($model::PUBLIC_CODE_URL, $model->app_id, $redirect_url, $scope);
        return $this->redirect($request_url);
    }

    public function actionLoginProcess()
    {
        $data = Yii::$app->request->get();
        //var_dump($data);die;
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
                return $this->redirect(Yii::$app->session->get('pre_page_url'));
            }
            //var_dump($user_info);die;
            // 新用户入库
            $wechat = new Wechat();
            $wechat->open_id = $response['openid'];
            $wechat->access_token = $response['access_token'];
            $wechat->refresh_token = $response['refresh_token'];
            $wechat->expires_in = $response['expires_in'];
            //$wechat->unionid = $user_info['unionid'];
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
            return $this->redirect(Yii::$app->session->get('pre_page_url'));
        } catch (Exception $e) {
            return $this->redirect(['login']);
        }
    }

    public function actionDetail($id)//product id
    {
        $product = Product::findOne($id);
        var_dump($product->toArray());die;
    }

    /**
     * Displays about page
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
