<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use common\helpers\GoogleChartHelper;
use digi\authclient\clients\Facebook;
use digi\authclient\clients\Twitter;
use digi\authclient\clients\Instagram;
use digi\authclient\clients\Youtube;
use digi\authclient\clients\GooglePlus;
use digi\authclient\clients\Foursquare;
use digi\authclient\clients\LinkedIn;
use common\models\custom\User;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;

/**
 * Site controller
 */
class SaveController extends \frontend\components\BaseController {


    public function behaviors()
    {
        return [
          'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'except' => ['auth'],
                'rules' => [
                    [
                        'actions' => ['/signup', '/login', 'subscribe', 'mobile-login', 'contact-us', 'home'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['/logout', '/change-password', 'dashboard', 'facebook', 'twitter', 'instagram', 'youtube', 'google-plus', 'linkedin', 'support', 'home'],
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
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            // page action renders "static" pages stored under 'frontend/views/site/pages'
            // They can be accessed via: site/static?view=FileName
            'static' => [
                'class' => \yii\web\ViewAction::className(),
            ],
        ];
    }

    public function actionLinkedin(){
        $session = Yii::$app->session;
        $linkedin = new LinkedIn ();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'linkedin']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null){
                //check stored token
                LinkedIn::setClient( unserialize($oAuthclient->source_data));
                $ReturnData = $linkedin->getUserAdminCompanies() ;
                if( $ReturnData == null){
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    LinkedIn::setClient( null);
                }
            }
        }

        if($session->has('linkedin')){
            if($oAuthclient){
                if($oAuthclient->source_data == null){
                    $oAuthclient->source_data =serialize($client);;
                    $oAuthclient->save();
                }
                $oModel = $oAuthclient->model;
                if($oModel){
                  if(date('d M', time()) == date('d M', strtotime('first day of this month'))){
                    $since = (strtotime('first day of last month'))*1000;
                  }else{
                      $since = (strtotime('first day of this month'))*1000;
                  }
                    $linkedin->saveAccountInsights($oModel[0], $since);
                    return $this->render('/cron/cron');
                }
            }
        }else{
            return $this->render('/linkedin/linkedinAuth');
        }
    }
	
    public function actionGooglePlus(){ 
        $session = Yii::$app->session;
        $gPlus = new GooglePlus();

        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'google_plus']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null){
                GooglePlus::setClient( unserialize($oAuthclient->source_data));
                $ReturnData =$gPlus->getAccountDetails();
                if( $ReturnData == null){
                   $oAuthclient->source_data =null;
                   $oAuthclient->save();
                   GooglePlus::setClient( null);
                }
            }

        if($session->has('google_plus')){
          //$gPlus->saveAccountInsights();
            $client = $gPlus->getClient();
            //save the auth client data
            if(!$oAuthclient or ($oAuthclient->source_data==null)) {
                $oAuthclient = !$oAuthclient ? new Authclient() : $oAuthclient;
                $oAuthclient->user_id = Yii::$app->user->getId();
                $oAuthclient->source = $client->name;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->source_id = $client->getUserAttributes()["id"];
                $oAuthclient->save();
                $account = $gPlus->getAccountDetails();
                $gPlus->firstTimeToLog($account);
            }
            $oAccountModel = Model::findOne(['authclient_id' => $oAuthclient->id, 'parent_id' => null]);
          	$gPlus->saveAccountInsights($oAccountModel);
          	$gPlus->updateCompetitorsValues();
            return $this->render('/cron/cron');
        }
      }
    }
  
    public function actionYoutube(){
        $session = Yii::$app->session;
        $youtube = new Youtube();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'youtube']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null){
                //check stored token
                Youtube::setClient( unserialize($oAuthclient->source_data));
              $ReturnData = $youtube->getChannelData() ;
                if( $ReturnData == null){   // this case will hapen only when user revoke the access
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    Youtube::setClient( null);
                }
            }
        }

        if($session['youtube']){
            if($oAuthclient){
                if($oAuthclient->source_data==null) $youtube->UpdateAuthclient($oAuthclient);
            }
            $models = $oAuthclient->model;
            if($models){
              if((date('d M', time()) == date('d M', strtotime('first day of this month'))) || (date('d', time()) == '02')){
                $since = date('Y-m-d', strtotime('first day of last month'));
              }else{
                  $since = date('Y-m-d', strtotime('first day of this month'));
              }
                $youtube->saveAccountInsights($oAuthclient->model[0]->id, $since);
              	$youtube->updateCompetitorsValues();
            }
            return $this->render('/cron/cron');

        }
    }

    public function actionInstagram(){
        $session = Yii::$app->session;
        $insta = new Instagram ();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'instagram']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null){
                //check stored token
                Instagram::setClient( unserialize($oAuthclient->source_data));
                $ReturnData = $insta->getUserData() ;
                if( $ReturnData == null){
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    Instagram::setClient( null);
                }
            }
        }
        if($session->has('instagram')){
            $oModels = $oAuthclient->model;
            if($oModels){
				$insta->saveAccountInsights($oModels[0]);
              	$insta->updateCompetitorsValues();
            }
            return $this->render('/cron/cron');
        }
    }
    
    public function actionTwitter(){
        //check if the save access is working
        ini_set('max_execution_time', 900000);
        $twitter = new Twitter();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'twitter']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null){
                Twitter::setClient( unserialize($oAuthclient->source_data));
                $ReturnData = $twitter->getAccountData() ;
                if( $ReturnData == null){
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    Twitter::setClient( null);
                }
            }
        }

        $session = Yii::$app->session;
	if($session->has('twitter')){
            $oModels = $oAuthclient->model;
            if($oModels){
				$twitter->saveAccountInsights($oModels[0]);
              	$twitter->updateCompetitorsValues();
            }
            return $this->render('/cron/cron');
        }
    }
    
    public function actionFacebook(){
        ini_set('max_execution_time', 900000);
        $session = Yii::$app->session;
        $fb = new Facebook();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null){
                Facebook::setClient( unserialize($oAuthclient->source_data));
               $client = $fb->getClient();
               $ReturnData = $client->getUserAttributes() ;
                if( $ReturnData == null){
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    Facebook::setClient( null);
                }
            }else{
                $client = Facebook::getClient();
                //$client->getUserAttributes() ;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->save();
            }
          if($session->has('facebook')){
              $oModel = $oAuthclient->model;
            if($oModel){
            	$page = $fb->getPageData($oModel[0]->entity_id);
              	$fb->saveAccountInsights($oModel[0], $page['likes']);
              	$fb->updateCompetitorsValues();
              	return $this->render('/cron/cron');
            }
          }
        }
    }
}