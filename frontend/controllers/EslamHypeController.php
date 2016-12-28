<?php

namespace frontend\controllers;

use Yii;
use common\models\custom\User;
use common\models\custom\search\User as UserSearch;
use frontend\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EslamHypeController implements the CRUD actions for User model.
 */
class EslamHypeController extends BaseController
{
  
        /**
     * @inheritdoc
     */
    public function actions() {
        return [
            
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'except' => ['auth'],
                'rules' => [
                  
                    [
                        'actions' => ['index', '/change-password', 'dashboard', 'facebook', 'twitter', 'instagram', 'youtube', 'google-plus', 'linkedin', 'support', 'home', 'testmail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
  
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        //$model->scenario = 'update';
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
            return $this->render("update", [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
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
