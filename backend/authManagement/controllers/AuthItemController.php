<?php

namespace backend\authManagement\controllers;

use Yii;
use backend\controllers\BaseController;
use backend\authManagement\models\AuthItem;
use backend\authManagement\models\searchs\AuthItemSearch;
use common\helpers\FileAide;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @param $updateUrl
     * @return mixed
     */
    public function actionView($id, $updateUrl)
    {
        return $this->render('view', [
            'updateUrl' => $updateUrl,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPermissionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->itemSave(AuthItem::TYPE_PERMISSION)) {
            return $this->redirect(['view', 'id' => $model->name, 'updateUrl' => 'permission-update']);
        } else {
            $items = static::allNewRoutes();
            $items = array_combine($items, $items);
            $ruleNameList = AuthItem::ruleNameList();

            return $this->render('permission-create', [
                'model' => $model,
                'items' => $items,
                'ruleNameList' => $ruleNameList,
            ]);
        }
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRoleCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->itemSave(AuthItem::TYPE_ROLE)) {
            return $this->redirect(['view', 'id' => $model->name, 'updateUrl' => 'role-update']);
        } else {
            $ruleNameList = AuthItem::ruleNameList();
            return $this->render('role-create', [
                'model' => $model,
                'ruleNameList' => $ruleNameList,
            ]);
        }
    }

    /**
     * 获取所有未入库的routes并排序
     *
     * @return array
     */
    private static function allNewRoutes()
    {
        $items = AuthItem::find()->select('name')->asArray()->column();
        $routes = static::getAllRoutes();
        foreach ($items as $item) {
            $key = array_search($item, $routes);
            if ($key !== false) {
                unset($routes[$key]);
            }
        }
        asort($routes);
        return $routes;
    }

    /**
     * 获取所有routes
     *
     * @return array
     */
    private static function getAllRoutes()
    {
        $backend_path = dirname(dirname(__DIR__));
        $modules = Yii::$app->params['authModules'];
        // backend下的所有routes
        $routes = static::backendRoutes();
        //遍历modules
        foreach ($modules as $moduleID => $module) {
            $controllerPath = $backend_path . '/' . $module['module_path'] . '/controllers/';
            $fileNames = FileAide::getAllFileName($controllerPath);
            //一个modules下的所有controller name
            $controllerFileNames = static::getControllerNames($fileNames);
            //遍历modules下的controllers下的所有Controller
            if (!empty($controllerFileNames)) {
                foreach ($controllerFileNames as $fileName) {
                    $controllerName = FileAide::upperConvert($fileName);
                    $fileName = $controllerPath . $fileName . 'Controller.php';
                    $actions = static::getActions($fileName);

                    $route = [];
                    //遍历单个controller name下的所有action
                    if (!empty($actions)) {
                        foreach ($actions as $action) {
                            $action = FileAide::upperConvert($action);
                            $route[] = isset($module['module_request_route']) ? $module['module_request_route'] . '/' . $controllerName . '/' . $action : $controllerName . '/' . $action;
                        }
                    }

                    $routes = array_merge($routes, $route);
                }
            }
        }
        return $routes;
    }

    /**
     * 获取backend下的所有的routes
     *
     * @return array
     */
    private static function backendRoutes()
    {
        $routes = [];
        $backend_path = dirname(dirname(__DIR__));
        $controllerPath = $backend_path . '/controllers/';
        $fileNames = FileAide::getAllFileName($controllerPath);
        $controllerFileNames = static::getControllerNames($fileNames);
        if (!empty($controllerFileNames)) {
            foreach ($controllerFileNames as $fileName) {
                $controllerName = FileAide::upperConvert($fileName);
                $fileName = $controllerPath . $fileName . 'Controller.php';
                $actions = static::getActions($fileName);

                $route = [];
                if (!empty($actions)) {
                    foreach ($actions as $action) {
                        $action = FileAide::upperConvert($action);
                        $route[] = $controllerName . '/' . $action;
                    }
                }
                $routes = array_merge($routes, $route);
            }
        }
        return $routes;
    }

    /**
     * 获取controller的名称如Site
     *
     * @param $fileNames
     * @return array
     */
    private static function getControllerNames($fileNames)
    {
        $filenames = [];
        foreach ($fileNames as $fileName) {
            $fileName = static::pregControllers($fileName);
            if (!empty($fileName)) {
                $filenames[] = $fileName;
            }
        }
        return $filenames;
    }

    /**
     * 获取actions
     *
     * @param $fileName
     * @return mixed
     */
    private static function getActions($fileName)
    {
        $fp = fopen($fileName, "r") or die('打开文件有误!请检查文件:' . $fileName);
        $str = fread($fp, filesize($fileName));
        $actions = static::pregActions($str);
        fclose($fp);
        return $actions;
    }

    /**
     * 从文件名中获取前缀作为控制器名
     *
     * @param $str
     * @return string
     */
    private static function pregControllers($str) {
        $rule = '/([A-Z].*?)Controller\.php/';
        preg_match_all($rule, $str, $matches);
        return isset($matches[1][0]) ? $matches[1][0] : '';
    }

    /**
     * 从文件中获取action名称
     *
     * @param $str
     * @return mixed
     */
    private static function pregActions($str) {
        $rule = '/public[\s]+function[\s]+action([A-Z].*?)\(/';
        preg_match_all($rule, $str, $matches);
        return $matches[1];
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionPermissionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name, 'updateUrl' => 'permission-update']);
        } else {
            $items = static::allNewRoutes();
            $items = array_combine($items, $items);
            $ruleNameList = AuthItem::ruleNameList();
            return $this->render('permission-update', [
                'model' => $model,
                'items' => $items,
                'ruleNameList' => $ruleNameList,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionRoleUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name, 'updateUrl' => 'role-update']);
        } else {
            $ruleNameList = AuthItem::ruleNameList();
            return $this->render('permission-update', [
                'model' => $model,
                'ruleNameList' => $ruleNameList,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        $items = static::allNewRoutes();

        $items = array_combine($items, $items);
        var_dump($items);
    }
}
