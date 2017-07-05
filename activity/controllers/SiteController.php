<?php
namespace activity\controllers;

use activity\models\Activity;
use activity\models\AppWechat;
use common\components\HttpQuery;
use Yii;
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
        $response = HttpQuery::getQuickCurlQuery($request_url);



    }

    public function actionLoginProcess()
    {
        $data = Yii::$app->request->get();
        var_dump($data);
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
