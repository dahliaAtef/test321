<?php

namespace backend\controllers;

use Yii;
use backend\components\BaseController;
use common\models\custom\form\BackLogin;
use common\models\custom\User;
use common\models\custom\Order;
use common\models\custom\Comment;
use common\models\custom\Product;

/**
 * Site controller
 */
class SiteController extends BaseController {

    public $defaultAction = 'index';
  
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        return $this->redirect(['/users']);
    }
    
    public function actionComponents() {
        return $this->render('components');
    }
    
    public function actionAnalytics() {
        return $this->render('analytics');
    }
    
    public function actionLogin() {
        $this->layout = 'login';
        
        if (!\Yii::$app->user->isGuest) {
            return $this->actionIndex();
        }

        $model = new BackLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/users']);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
