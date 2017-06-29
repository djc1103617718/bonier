<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Media;
use frontend\models\Upload;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UploadController extends  BaseController
{
    /**
     * Displays a single FileUpdateUpload model.
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
     * @return string|\yii\web\Response
     * 单文件上传
     */
    public function actionProductImg(){
        $model= new Upload();
        $web_rout = Yii::getAlias('@frontend') . '/web';
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, 'file');
            $user_id = Yii::$app->user->id;
            $rand = rand(0,9) . $user_id . rand(10, 99);
            $model->url = 'upload/' . date("YmdHis",time()) . $rand . '.' . $file->getExtension();
            if ($file && $model->validate()) {
                $fileName = $web_rout . '/' . $model->url;
                if ($file->saveAs($fileName)) {
                    if ($media = $model->saveProductImg()) {
                        Yii::$app->session->setFlash('success','上传成功！');
                        return $this->redirect(['view', 'id' => $media->id]);
                    }
                }
            }
        }

        return $this->render('create',[
            'model'=>$model,
            'title' => '商品图片上传',
            'action' => 'upload/product-img'
        ]);
    }


    /**
     * @return string|\yii\web\Response
     * 单文件上传
     */
    public function actionAddressImg(){
        $model= new Upload();
        $web_rout = Yii::getAlias('@frontend') . '/web';
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, 'file');
            $user_id = Yii::$app->user->id;
            $rand = rand(0,9) . $user_id . rand(10, 99);
            $model->url = 'upload/' . date("YmdHis",time()) . $rand . '.' . $file->getExtension();
            if ($file && $model->validate()) {
                $fileName = $web_rout . '/' . $model->url;
                if ($file->saveAs($fileName)) {
                    if ($media = $model->saveAddressImg()) {
                        Yii::$app->session->setFlash('success','上传成功！');
                        return $this->redirect(['view', 'id' => $media->id]);
                    }
                }
            }
        }

        return $this->render('create',[
            'model'=>$model,
            'title' => '店铺地址图片上传',
            'action' => 'upload/address-img'
        ]);
    }

    public function actionTopCarousel(){
        $model= new Upload();
        $web_rout = Yii::getAlias('@frontend') . '/web';
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, 'file');
            $user_id = Yii::$app->user->id;
            $rand = rand(0,9) . $user_id . rand(10, 99);
            $model->url = 'upload/' . date("YmdHis",time()) . $rand . '.' . $file->getExtension();
            if ($file && $model->validate()) {
                $fileName = $web_rout . '/' . $model->url;
                if ($file->saveAs($fileName)) {
                    if ($media = $model->saveTopCarousel()) {
                        Yii::$app->session->setFlash('success','上传成功！');
                        return $this->redirect(['view', 'id' => $media->id]);
                    }
                }
            }
        }

        return $this->render('create',[
            'model'=>$model,
            'title' => '顶部轮播图上传',
            'action' => 'upload/top-carousel'
        ]);
    }

    /**
     * 多文件上传
     *
     * @return string|\yii\web\Response
     */
    /*public function actionCreate(){
        $post = Yii::$app->request->post();
        $model = new Upload();
        if (Yii::$app->request->isPost && $model->load($post)) {
            $file = UploadedFile::getInstances($model, 'file');
            $model->file = $file[0];
            if ($model->file && $model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $baseRoute = Yii::getAlias('@backend');
                    $route = $baseRoute . '/runtime/upload/';
                    FileHelper::createDirectory($route);
                    $fileRoute = $route . $model->file->name;
                    $model->file->saveAs($fileRoute);
                    $model->path = $fileRoute;
                    $model->original_name = $model->file->name;
                    $model->created_time = date('Y-m-d H:i:s', time());
                    if (!$model->save()) {
                        throw new Exception('入库失败!');
                    }
                    Yii::$app->session->setFlash('success','上传成功！');
                    $transaction->commit();
                    return $this->redirect(['index']);
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            Yii::$app->session->setFlash('error', '上传失败!');
        }
        return $this->render('create', ['model' => $model]);
    }*/

    /**
     * Finds the FileUpdateUpload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Media::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}