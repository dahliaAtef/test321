<?php

namespace backend\controllers\base;

use Yii;
use yii\web\NotFoundHttpException;
use backend\components\BaseController;

/**
 * TreeController implements the CRUD actions for Tree model.
 */
class TreeController extends BaseController {

    public $defaultAction = 'manage';

    public $baseViewPath = '/base/tree';
    public $model = '\common\models\base\Tree';
    public $searchModel = '\common\models\base\search\Tree';
   
    /**
     * Tree manager
     * @return mixed
     */
    public function actionManage() {
        $model = $this->model;
        return $this->render('manage', [
            'query' => $model::find()->addOrderBy('root, lft'),
            'displayValue' => $model::ROOT,
        ]);
    }

    /**
     * Lists all Tree models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new $this->searchModel;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tree model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tree model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new $this->model;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tree model.
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

    /**
     * Finds the Tree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tree the loaded model
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