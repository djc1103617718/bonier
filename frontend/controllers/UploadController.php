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
        if (Yii::$app->request->isPost && !empty($_FILES)) {
            $this->saveFiles('saveProductImg');
        }

        return $this->render('create',[
            'title' => '商品图上传',
            'action' => 'upload/product-img'
        ]);
    }


    /**
     * @return string|\yii\web\Response
     * 单文件上传
     */
    public function actionAddressImg(){
        if (Yii::$app->request->isPost && !empty($_FILES)) {
            $this->saveFiles('saveAddressImg');
        }

        return $this->render('create',[
            'title' => '店铺地址图上传',
            'action' => 'upload/address-img'
        ]);
    }

    /**
     * @return string
     */
    public function actionTopCarousel(){
        if (Yii::$app->request->isPost && !empty($_FILES)) {
            $this->saveFiles('saveTopCarousel');
        }

        return $this->render('create',[
            'title' => '顶部轮播图上传',
            'action' => 'upload/top-carousel'
        ]);
    }

    /**
     * @return string
     */
    public function actionBackendMusic()
    {
        if (Yii::$app->request->isPost && !empty($_FILES)) {
            var_dump($_FILES);die;
            $this->saveFiles('saveMusic');
        }

        return $this->render('music-create',[
            'title' => '背景音乐上传',
            'action' => 'upload/backend-music'
        ]);
    }

    /**
     * @param $saveType
     * @return \yii\web\Response
     */
    private function saveFiles($saveType)
    {
        $web_rout = Yii::getAlias('@frontend') . '/web';
        $user_id = Yii::$app->user->id;
        $files = $_FILES['upload'];

        $fileNum = count($files['name']);
        for ($i = 0; $i < $fileNum; $i++) {
            if ($files['size'][$i] > 8048000) {
                Yii::$app->session->setFlash('error', '文件大小不能超过2M');
                return $this->redirect(Yii::$app->request->referrer);
            }

            $tmpFile = $files['tmp_name'][$i];
            $nameArr = explode('.', $files['name'][$i]);
            if (!isset($nameArr[1])) {
                Yii::$app->session->setFlash('error', '没有上传文件');
                return $this->redirect(Yii::$app->request->referrer);
            }
            $extension = $nameArr[1];
            $rand = rand(0,9) . $user_id . rand(10, 99);
            $url = 'upload/' . date("YmdHis",time()) . $rand . '.' . $extension;
            $saveUrl = $web_rout . '/' . $url;
            if (move_uploaded_file($tmpFile, $saveUrl)) {
                $upload = new Upload();
                if (!$upload->$saveType($files['name'][$i], $url)) {
                    Yii::$app->session->setFlash('error', '文件:' . $files['name'][$i] . '上传失败!');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {
                Yii::$app->session->setFlash('error', '文件:' . $files['name'][$i] . '上传失败!');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        if ($saveType === 'saveMusic') {
            return $this->redirect(['media/music-index']);
        }
        return $this->redirect(['media/index']);
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