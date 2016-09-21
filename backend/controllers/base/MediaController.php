<?php

namespace backend\controllers\base;

use Yii;
use common\models\custom\Media;
use backend\components\BaseController;
use yii\web\NotFoundHttpException;

/**
 * MediaController implements the CRUD actions for Media model.
 */
class MediaController extends BaseController {

    public $baseViewPath = '/base/media';
    public $model = '\common\models\base\Media';
    public $searchModel = '\common\models\base\search\Media';

    public function init() {
        parent::init();
        /**
         * Don't render layout because it will be rendered at iframe
         */
        isset(Yii::$app->request->queryParams['iframe']) and Yii::$app->session['iframe'] = true;
        isset(Yii::$app->request->queryParams['clear']) and Yii::$app->session['Media'] = Yii::$app->session['iframe'] = null;
        Yii::$app->session['iframe'] and $this->layout = 'iframe';
    }

    /**
     * Lists all Media models.
     * Sets model & modelId at session in order to filter/upload media to related model.
     * @return mixed
     * @param strin $model
     * @param int|string $modelId
     * @return mixed
     */
    public function actionIndex($model = '', $modelId = null) {
        ($model && $modelId) and Yii::$app->session['Media'] = ['model' => $model, 'model_id' => $modelId];
        $searchModel = new $this->searchModel;
        $dataProvider = $searchModel->search(array_merge_recursive(Yii::$app->request->queryParams, ['Media' => Yii::$app->session['Media']]));
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Media model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Media model.
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
     * Updates an existing Media model.
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
     * Deletes an existing Media model.
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
     * Handels jQuery Multiple File Upload
     */
    public function actionJqupload() {
        if (Yii::$app->request->isPost || Yii::$app->request->isDelete) {
            new \common\components\JQUploadHandler(Yii::$app->session['Media']);
        }
    }
    
    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Media the loaded model
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
