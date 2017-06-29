<?php

namespace frontend\controllers;

use common\models\Category;
use frontend\models\Media;
use Yii;
use frontend\models\Address;
use frontend\models\searches\AddressSearch;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressController implements the CRUD actions for Address model.
 */
class AddressController extends BaseController
{
    /**
     * Displays a single Address model.
     * @return mixed
     */
    public function actionView()
    {
        $address = Address::find()->where(['user_id' => Yii::$app->user->id])->one();
        if (empty($address)) {
            Yii::$app->session->setFlash('error', '请完善店铺信息');
            return $this->redirect(['create']);
        }

        return $this->render('view', [
            'model' => $address,
        ]);
    }

    /**
     * Creates a new Address model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Address();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $addressImgList =  Media::find()
                ->select('url')
                ->indexBy('id')
                ->where(['type' => Media::TYPE_IMG, 'category' => Category::CATEGORY_ADDRESS_IMG, 'user_id' => Yii::$app->user->id])
                ->column();
            return $this->render('create', [
                'model' => $model,
                'addressImgList' => $addressImgList
            ]);
        }
    }

    /**
     * Updates an existing Address model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $addressImgList =  Media::find()
                ->select('url')
                ->indexBy('id')
                ->where(['type' => Media::TYPE_IMG, 'category' => Category::CATEGORY_ADDRESS_IMG, 'user_id' => Yii::$app->user->id])
                ->column();
            return $this->render('update', [
                'model' => $model,
                'addressImgList' => $addressImgList
            ]);
        }
    }

    /**
     * Deletes an existing Address model.
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
     * Finds the Address model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Address the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
