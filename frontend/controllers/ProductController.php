<?php

namespace frontend\controllers;

use common\models\Category;
use frontend\models\Media;
use Yii;
use frontend\models\Product;
use frontend\models\searches\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $productImgList = Media::find()
                ->select('url')
                ->indexBy('id')
                ->where(['type' => Media::TYPE_IMG, 'category' => Category::CATEGORY_PRODUCT_IMG, 'user_id' => Yii::$app->user->id])
                ->column();
            return $this->render('create', [
                'model' => $model,
                'productImgList' => $productImgList,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->updateProduct()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $productImgList = Media::find()
                ->select('url')
                ->indexBy('id')
                ->where(['type' => Media::TYPE_IMG, 'category' => Category::CATEGORY_PRODUCT_IMG, 'user_id' => Yii::$app->user->id])
                ->column();
            $model->start_price = $model->start_price/100;
            $model->reserve_price = $model->reserve_price/100;
            //var_dump($productImgList);die;
            return $this->render('update', [
                'model' => $model,
                'productImgList' => $productImgList,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
