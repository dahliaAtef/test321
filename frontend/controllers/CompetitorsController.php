<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\custom\Competitors;
use frontend\models\CompetitorTest;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * User controller
 */
class CompetitorsController extends \frontend\components\BaseController {

    public function actions() {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            
        ];
    }
	
  	public function actionIndex(){
    	$oCompetitors = Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
      if(Yii::$app->request->isAjax){
      return $this->renderAjax('index', ['oCompetitors' => $oCompetitors]);
      }else{
      return $this->renderAjax('index', ['oCompetitors' => $oCompetitors]);
      }
    }
  
  	public function actionUpdate($id){
    	$oCompetitorTest = new CompetitorTest();
      	if($oCompetitorTest->load(Yii::$app->request->post()) && $oCompetitorTest->validate()){
          	//var_dump($oCompetitorTest); die;
          	$oCompetitorTest->compid = $id;
          	Competitors::checkAndUpdateChannels($oCompetitorTest);
        }
      
          	return $this->redirect(Yii::$app->request->referrer);
    }
  
    public function actionDelete($id) {
        Competitors::findOne($id)->delete();
      	return $this->actionIndex();
        //if (Yii::$app->request->isAjax) {
      		//return $this->redirect(Yii::$app->request->referrer);
            //return $this->redirect(Url::to(['/dashboard']));
        //}
        //return $this->redirect(['index']);
    }

}
