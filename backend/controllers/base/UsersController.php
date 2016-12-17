<?php

namespace backend\controllers\base;

use Yii;
use backend\components\BaseController;
use yii\web\NotFoundHttpException;
use common\models\custom\User;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends BaseController {
    
    public $baseViewPath = '/base/users';
    public $model = '\common\models\base\User';
    public $searchModel = '\common\models\base\search\User';
    
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel =  new $this->searchModel;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model =  new $this->model;
        if ($model->load(Yii::$app->request->post())) {
            //$model->status = $model::STATUS_VERIFIED;
            $model->setPassword($model->password);
            $model->generateAuthKey();
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else
            return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          if($model->status == User::STATUS_VERIFIED){
                    if(\common\helpers\MailHelper::sendActivationResponse($model)){
                        Yii::$app->getSession()->setFlash('success', "Activation mail has been sent successfully.");
                    }else{
                        Yii::$app->getSession()->setFlash('error', "Activation mail couldn't be sent.");
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
          }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
            $this->actionIndex();
        }
        return $this->redirect(['index']);
    }

    public function actionChangePassword($id) {
        $oUser = $this->findModel($id);
        $oChangePasswordForm = new \common\models\base\form\ChangePassword();

        if ($oChangePasswordForm->load(Yii::$app->request->post())) {
            $oChangePasswordForm->oUser = $oUser;
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \digi\metronic\widgets\ActiveForm::validate($oChangePasswordForm);
            }
            // ... respond to non-AJAX request ...
            if ($oChangePasswordForm->validate() && $oUser->resetPassword($oChangePasswordForm->new_password)) {
                $this->redirect(['view', 'id' => $oUser->id]);
            }
        }

        return $this->render('changePassword', [
                    'model' => $oUser,
                    'oChangePasswordForm' => $oChangePasswordForm,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $model = $this->model;
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
