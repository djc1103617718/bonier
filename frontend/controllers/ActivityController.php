<?php

namespace frontend\controllers;

use frontend\models\Product;
use Yii;
use frontend\models\Activity;
use frontend\models\searches\ActivitySearch;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends BaseController
{
    /**
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPreview($id)
    {
        return $this->redirect(Yii::$app->urlManagerActivity->createUrl(['site/index', 'id' => $id]));
    }

    /**
     * Displays a single Activity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'productList' => $model->productList(),
                'promotionList' => $model->promotionList(),
                'bottomImgList' => $model->bottomImgList(),
                'model' => $model,
                'carousels' => $model->carouselsList(),
                'backend_musics' => $model->backendMusicList(),
            ]);
        }
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->updateActivity()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $products = Product::find()->select('name')->where(['act_id' => $model->id])->indexBy('id')->column();
            $productList = $model->productList() + $products;
            return $this->render('update', [
                'productList' => $productList,
                'model' => $model,
                'carousels' => $model->carouselsList(),
                'backend_musics' => $model->backendMusicList(),
                'promotionList' => $model->promotionList(),
                'bottomImgList' => $model->bottomImgList(),
            ]);
        }
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->deleteActivity()) {
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', '删除失败!');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * 发布活动
     *
     * @param $id
     * @return \yii\web\Response
     */
    public function actionPublic($id)
    {
        $model = $this->findModel($id);
        $model->status = Activity::STATUS_PUBLIC;

        $now = date('Y-m-d', time());
        $activity = Activity::find()
            ->where(['user_id' => Yii::$app->user->id, 'status' => Activity::STATUS_PUBLIC])
            ->andWhere(['>=', 'end_time', $now])
            ->one();

        if (!empty($activity) || ($model->update(false) === false)) {
            Yii::$app->session->setFlash('error', '发布活动失败!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->urlManagerActivity->createUrl(['site/index', 'id' => $id]));
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
