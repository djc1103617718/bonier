<?php

namespace frontend\controllers;

use frontend\models\UpdateUserForm;
use Yii;
use frontend\models\ResetPasswordForm;
use frontend\models\ResetRequestForm;
use frontend\models\User;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{

    /**
     * Displays a single User model.
     * @return mixed
     */
    public function actionView()
    {
        $model = User::findOne(Yii::$app->user->id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionResetRequest($type=null)
    {
        $model = new ResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            if ($type) {
                return $this->redirect(['update', 'token' => $model->token]);
            } else{
                return $this->redirect(['reset-password', 'token' => $model->token]);
            }
        }
        return $this->render('resetRequest', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate($token)
    {
        $model = new UpdateUserForm($token);

        if ($model->load(Yii::$app->request->post()) && $model->updateUser()) {
            return $this->redirect(['user/view']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $token
     * @return mixed
     */
    public function actionResetPassword($token)
    {
        $model = new ResetPasswordForm($token);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->resetPassword()) {
                Yii::$app->session->setFlash('success', '新密码设置成功');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', '密码重设失败');
            }
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
