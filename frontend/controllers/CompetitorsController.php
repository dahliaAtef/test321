<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\custom\Competitors;
use common\models\custom\Authclient;
use common\models\custom\Dashboard;
use frontend\models\CompetitorsForm;
use frontend\models\CompetitorTest;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * User controller
 */
class CompetitorsController extends \frontend\components\BaseController {

    public $defaultAction = 'edit';
    
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
  
    public function actionEdit(){
    	$oCompetitorTest = new CompetitorTest();
        if(Yii::$app->request->post() && array_key_exists('del-comp', $_POST) && (!empty($_POST['del-comp']))){
            Competitors::deleteCompetitors($_POST['del-comp']);
        }elseif($oCompetitorTest->load(Yii::$app->request->post()) && $oCompetitorTest->validate()){
            if($_POST['CompetitorTest']['compid']){
                Dashboard::checkAndUpdateChannels($_POST['CompetitorTest']['compid'], $oCompetitorTest);
            }else{
          	Dashboard::createNewCompetitor($oCompetitorTest);
            }
        }
        
        return $this->render('edit', [
            'oCompetitorTest' => $oCompetitorTest,
            'oCompetitors' => Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all(), 
            'admin_accounts' => Authclient::find()->where(['user_id' =>2])->all()
        ]);
    }
    
    
    public function actionCreate(){
        $oCompetitorsForm = new CompetitorsForm();
        $dashboard = new Dashboard();
        if($oCompetitorsForm->load(Yii::$app->request->post()) && $oCompetitorsForm->validate()){
            if($dashboard->saveCompetitors($oCompetitorsForm)){
                return $this->redirect('/dashboard');
            }else{
                
            }
	}
        return $this->render('create', [
            'oCompetitorsForm' => $oCompetitorsForm,
            'oCompetitors' => Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all(), 
            'admin_accounts' => Authclient::find()->where(['user_id' =>2])->all()
        ]);
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
