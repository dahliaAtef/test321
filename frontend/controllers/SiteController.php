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
use common\models\custom\Dashboard;
use common\models\custom\Competitors;
use frontend\models\ContactForm;
use frontend\models\SubscribeForm;
use frontend\models\UserPagesForm;
use frontend\models\SupportForm;
use frontend\models\RangeForm;
use frontend\models\ExportForm;
use mPDF;


/**
 * Site controller
 */
class SiteController extends \frontend\components\BaseController {

    public $defaultAction = 'home';
    public $Cashed =true;

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
                        'actions' => ['/logout', '/change-password', 'dashboard', 'facebook', 'twitter', 'instagram', 'youtube', 'google-plus', 'linkedin', 'support', 'home', 'testmail', 'delete-competitor', 'admin', 'competitors/index', 'competitors/delete', 'competitors/update', 'export-pdf', 'facebook-pdf'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            [
                'class' => 'yii\filters\PageCache',
                'only' => ['facebook'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                   'sql' => 'SELECT COUNT( id ) FROM authclient where source= "linkedin" and user_id='.Yii::$app->user->getId(),
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['twitter'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "twitter" and user_id='.Yii::$app->user->getId(),
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['linkedin'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "linkedin" and user_id='.Yii::$app->user->getId(),
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['instagram'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "instagram" and user_id='.Yii::$app->user->getId(),
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['youtube'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "youtube" and user_id='.Yii::$app->user->getId(),
                ],
            ],
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['google-plus'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "google-plus" and user_id='.Yii::$app->user->getId(),
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

    
    public function actionFacebookPdf(){
        
        ini_set('max_execution_time', 900000);
        /*$session = Yii::$app->session;
        $fb = new Facebook();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook']);
        if($session->has('facebook')){
            $oModel = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook'])->model;

            if($oModel){
                if(date('d M', time()) == date('d M', strtotime('first day of this month'))){
                    $since = strtotime('first day of last month');
                    $since = strtotime('-1 days', $since);
                    $until = strtotime('last day of last month');
                }else{
                    //$since = strtotime('first day of this month');
                    $since = strtotime('-2 months');
                    $since = strtotime('-1 days', $since);
                    $until = time();
                }
                $page = $fb->getPageData($oModel[0]->entity_id);
                $mpdf=new mPDF();

                $mpdf->WriteHTML($this->renderPartial('/facebook-pf/facebookPage', [
                    'page' => $page,
                    'fb' => $fb,
                    'id' => $oModel[0]->entity_id,
                    'since' => $since,
                    'until' => $until,
                    'model' => $oModel[0],
                    'authclient_created' => strtotime($oAuthclient->created),
                ]));

                $mpdf->Output();

                exit;
                /*return $this->render('/facebook-pf/facebookPage', [
                    'page' => $page,
                    'fb' => $fb,
                    'id' => $oModel[0]->entity_id,
                    'since' => $since,
                    'until' => $until,
                    'model' => $oModel[0],
                    'authclient_created' => strtotime($oAuthclient->created),
                ]);*
            }
        }*/

       $session = Yii::$app->session;
        $fb = new Facebook();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook']);
        $oModel = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook'])->model;
        $oExportForm = new ExportForm();
        if($oExportForm->load(Yii::$app->request->post()) && $oExportForm->validate()){
            $count = 0; $images = []; 
            $images_id = json_decode($oExportForm->images_id, true);
            $images_src = json_decode($oExportForm->images_src, true);
            foreach($images_id as $id){
                $images[$id] = $images_src[$count];
                $count++;
            }
        }
        //$since = strtotime('first day of this month');
        $since = strtotime('-2 months');
        $since = strtotime('-1 days', $since);
        $until = time();
        $page = $fb->getPageData($oModel[0]->entity_id);
        $mpdf = new mPDF();
        $html = mb_convert_encoding($this->render('/facebook-pdf/facebookPage', [
            'page' => $page,
            'fb' => $fb,
            'id' => $oModel[0]->entity_id,
            'since' => $since,
            'until' => $until,
            'model' => $oModel[0],
            'authclient_created' => strtotime($oAuthclient->created),
            'images' => $images
        ]), 'UTF-8', 'UTF-8');
        $mpdf->WriteHTML($html);

        $mpdf->Output('facebook.pdf', 'D');
        exit;
        /*Yii::$app->response->format = 'pdf';

        // Rotate the page
        Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
            'format' => [216, 356], // Legal page size in mm
            'orientation' => 'Landscape', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
            'beforeRender' => function($mpdf, $data) {},
        ]);
                    
        //$this->layout = '//main';
        return $this->render('/facebook-pdf/facebookPage', [
            'page' => $page,
            'fb' => $fb,
            'id' => $oModel[0]->entity_id,
            'since' => $since,
            'until' => $until,
            'model' => $oModel[0],
            'authclient_created' => strtotime($oAuthclient->created),
            'images' => $images
        ]);*/
    }
     
    /**
     * Home page
     */
    public function actionHome() {
        return (Yii::$app->user->isGuest) ? $this->renderPartial('home') : $this->redirect('dashboard');
    }
    
    /**
     * Subscribe page
     */
    public function actionSubscribe() {
        $oSubscribeForm = new SubscribeForm();
        if($oSubscribeForm->load(Yii::$app->request->post()) && $oSubscribeForm->validate()){
            if(Yii::$app->session['error']){
		Yii::$app->session->remove('error');
            }
            $err = null;
            if($oUser = $oSubscribeForm->subscribe()){
              if (\common\helpers\MailHelper::sendSubscriptionResponse($oUser)) {
                    $oSubscribeForm->verifySuccess = 'success';
                    return $this->render('subscribe', ['oUserForm' => $oSubscribeForm, 'err' => null, 'success' => 'success']);
              } else {
                   $oUser->delete();
              }
            }else
		Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, error occurred while subscribing.'));
        }
      $oSubscribeForm->verifySuccess = 'nop';
        return $this->render('subscribe', ['oUserForm' => $oSubscribeForm, 'err' => null, 'success' => 'nop']);
    }
      
    /**
     * Login from Mobile
     */
    public function actionMobileLogin() {
        return $this->render('mobile_login');
    }
    
    /**
     * Support page
     */
    public function actionSupport(){
		
		$oSupportForm = new SupportForm();
		if($oSupportForm->load(Yii::$app->request->post()) && $oSupportForm->validate()){
			//echo '<pre>'; var_dump($oSupportForm); echo '</pre>'; die;
			if($oSupportForm->sendSupportEmail()){
				Yii::$app->session->setFlash('success', Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
			}else{
				Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending this email.'));
			}
		}
        return $this->render('support', ['oSupportForm' => $oSupportForm]);
    }
    
    /**
     * Contact us page
     */
    public function actionContactUs() {
        
		$oContactForm = new ContactForm();
		if($oContactForm->load(Yii::$app->request->post()) && $oContactForm->validate()){
		if($oContactForm->sendEmail(Yii::$app->params['adminEmail'])){
                Yii::$app->session->setFlash('success', Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending this email.'));
            }
        }
        return $this->render('contact-us', ['oContactForm' => $oContactForm]);
    }

    /**
     * Dashboard page
     */
    public function actionDashboard($username=null) {
	    $session= Yii::$app->session;
        $dashboard = new Dashboard();
        $oCompetitors = Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
        $accounts = Authclient::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
        if(!$session->has('dashboard_accounts') || (count($accounts) > count($session['dashboard_accounts']))){
            $dashboard_accounts = [];
            foreach($accounts as $account){
                if($account->model){
                    $dashboard_accounts[$account['source']]['entity_id'] = $account->model[0]['entity_id'];
                    $dashboard_accounts[$account['source']]['model_id'] = $account->model[0]['id'];
                    $dashboard_accounts[$account['source']]['authclient'] = $account;
                }
            } 
            $session->set('dashboard_accounts', $dashboard_accounts);
        }
        $insights = $dashboard->getDashboardAccountsInsights();
        return $this->render('/dashboard/dashboard', ['insights' => $insights, 'growth_per_month' => $dashboard->getGrowthPerMonth($insights), 'oCompetitors' => $oCompetitors, 'oDashboard' => $dashboard, 'dashboard_accounts' => $session['dashboard_accounts']]);
    }
    
    /**
     * Privacy Policy page
     */
    public function actionPrivacyPolicy(){
        return $this->render('privacy-policy');
    }
    
    public function actionLinkedin(){
        $session = Yii::$app->session;
        $linkedin = new LinkedIn ();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'linkedin']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null && (is_object($set_client = unserialize($oAuthclient->source_data)))){
                //check stored token
                LinkedIn::setClient($set_client);
                $ReturnData = $linkedin->getUserAdminCompanies() ;
                if( $ReturnData == null){
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    LinkedIn::setClient( null);
                }
            }
        }

        if($session->has('linkedin')){
            $client = $linkedin->getClient();
            $oUserPagesForm = new UserPagesForm();

            if($oUserPagesForm->load(Yii::$app->request->post()) && $oUserPagesForm->validate()){
                $client = $linkedin->getClient();
                $oAuthclient =  $oAuthclient ? $oAuthclient : new Authclient();
                $oAuthclient->user_id = Yii::$app->user->getId();
                $oAuthclient->source = $client->name;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->source_id = $client->getUserAttributes()["id"];
                $oAuthclient->save();
                $since = strtotime('first day of this month') * 1000;
                $linkedin->firstTimeToLog($oUserPagesForm->id, $oAuthclient->id, $since);
            }
            if($oAuthclient){
                if($oAuthclient->source_data == null){
                    $oAuthclient->source_data =serialize($client);;
                    $oAuthclient->save();
                }

                $oModel = [];
                $oModel = $oAuthclient->model;
                if($oModel){
                    $oRangeForm = new RangeForm();
                    if($oRangeForm->load(Yii::$app->request->post()) && $oRangeForm->validate()){
                        $since = strtotime($oRangeForm->start_date) * 1000;
                        $until = strtotime($oRangeForm->end_date) * 1000;
                    }else{  
                        $since = strtotime('first day of this month') * 1000;
                        //$since = strtotime('-3 months') * 1000;
                        $until = time() * 1000;
                    }
                    $statistics = $linkedin->statistics($oModel[0], $since, $until);
                    //$linkedin->saveAccountInsights($oModel[0], $since);
                    return $this->render('/linkedin/linkedinPage', [
                        'statistics' => $statistics, 
                        'linkedin' => $linkedin, 
                        'oModel' => $oModel[0],
                        'since' => $since,
                        'until' => $until,
                        'oRangeForm' => $oRangeForm,
                        'authclient_created' => strtotime($oAuthclient->created)
                    ]);
                }
            }else{
                return $this->render('/linkedin/linkedin',[
                    'user_pages' => $linkedin->getUserAdminCompanies(), 
                    'oUserPagesForm' => $oUserPagesForm
                ]);
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
            if($oAuthclient->source_data != null && (is_object($set_client = unserialize($oAuthclient->source_data)))){
                GooglePlus::setClient($set_client);
                $ReturnData =$gPlus->getAccountDetails();
                if( $ReturnData == null){
                   $oAuthclient->source_data =null;
                   $oAuthclient->save();
                   GooglePlus::setClient( null);
                }
            }
        }


        if($session->has('google_plus')){
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
          
            $account = $gPlus->getAccountDetails();
            $gPlus->getTimeBasedAccountInsights($oAccountModel->id);
            return $this->render('/google-plus/google-plus', [
                'account' => $account,
                'googleP' => $gPlus,
                'oAccountModel' => $oAccountModel,
                'followers_growth' => $gPlus->getFollowersGrowth(),
                'statistics' => $gPlus->getEngagementStatistics($oAccountModel->id),
              	'model' => $oAccountModel
                    ]);
        }else{
            return $this->render('/google-plus/google-plusAuth');
        }
    }
    
    public function actionYoutube($p = null, $v = null){
        //ini_set('max_execution_time', 300000);
        $session = Yii::$app->session;
        $youtube = new Youtube();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'youtube']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null && (is_object($set_client = unserialize($oAuthclient->source_data)))){
                //check stored token
                Youtube::setClient($set_client);
              $ReturnData = $youtube->getChannelData() ;
                if( $ReturnData == null){   // this case will happen only when user revoke the access
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    Youtube::setClient( null);
                }
            }
        }

        if($p){
            $playlist_videos = $youtube->getPlaylistVideos($p);
            return $this->render('/youtube/channel-videos', ['videos' => $playlist_videos]);
        }else if($v){
            $video_data = $youtube->getVideoData($v);
            return $this->render('/youtube/video-analytics', [
                'video_analytics' => $youtube->getVideoAnalytics($v),
                'title' => $video_data["items"][0]["snippet"]["title"],
                'img' => $video_data["items"][0]["snippet"]["thumbnails"]["default"]["url"].'" alt="'.$video_data["items"][0]["snippet"]["title"]
            ]);
        }else if($session['youtube']){
            $channels = $youtube->getChannelData();
            

            if(!$oAuthclient){
                $oAuthclient = $youtube->createNewAuthclient($channels);
            }else{
                if($oAuthclient->source_data==null) $youtube->UpdateAuthclient($oAuthclient);
                if($oAuthclient->source_id != $channels['items'][0]['id']){
                    Yii::$app->getSession()->setFlash('error', 'Please select the youtube channel you registered with in the First time.');
                    return $this->render('/youtube/youtubeAuth');
                }
            }
            $models = $oAuthclient->model;
            $oRangeForm = new RangeForm();
            if($oRangeForm->load(Yii::$app->request->post()) && $oRangeForm->validate()){
                $since = date('Y-m-d', strtotime($oRangeForm->start_date));
                $until = date('Y-m-d', strtotime($oRangeForm->end_date));
            }elseif((date('d M', time()) == date('d M', strtotime('first day of this month'))) || date('d', time()) == '02'){
                $since = date('Y-m-d', strtotime('first day of last month'));
                $until = date('Y-m-d', strtotime('last day of last month'));
            }else{
              	$since = date('Y-m-d', strtotime('first day of this month'));
                //$since = date('Y-m-d', strtotime('- 3 months', time()));
                $until = date('Y-m-d', time());
            }
          $channel_analytics = $youtube->getChannelAnalytics($since, $until);
            if(!$models){
                $youtube->firstTimeToLog($oAuthclient->id);
            }else{
                //echo '<pre>'; var_dump($youtube->getCompetitorNameAndSubscribers("https://www.youtube.com/channel/UC89jxlRgoiqAnO_0pm-Ug0g")); echo '</pre>'; die;
                //$youtube->updatePostImageActualSize($oAuthclient->model[0]->id);
                //$youtube->saveAccountInsights($oAuthclient->model[0]->id, $since);
            }
            $subscribers = $youtube->getChannelSubscribers();
            return $this->render('/youtube/youtube', [
                'channels' => $channels,
                'channel_analytics' => $channel_analytics,
                'subscribers' => $subscribers,
                'youtube' => $youtube,
                'start_date' => $since,
                'end_date' => $until,
                'model' => $models[0],
                'oRangeForm' => $oRangeForm,
                'authclient_created' => strtotime($oAuthclient->created)
            ]);

        }else{
            return $this->render('/youtube/youtubeAuth');
        }
    }

public function actionInstagram(){
    //ini_set('max_execution_time', 300000);
    $session = Yii::$app->session;
    $insta = new Instagram ();
    $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'instagram']);
    if($oAuthclient ){
        if($oAuthclient->source_data != null && (is_object($set_client = unserialize($oAuthclient->source_data)))){
            //check stored token
            Instagram::setClient($set_client);
            $ReturnData = $insta->getUserData() ;
            if( $ReturnData == null){
                $oAuthclient->source_data =null;
                $oAuthclient->save();
                Instagram::setClient( null);
            }
        }
    }

    $oRangeForm = new RangeForm();
    if($oRangeForm->load(Yii::$app->request->post()) && $oRangeForm->validate()){
        $since = strtotime($oRangeForm->start_date);
        $until = strtotime($oRangeForm->end_date);
    }elseif(date('d M', time()) == date('d M', strtotime('first day of this month'))){
        $since = strtotime('first day of last month');
        $until = strtotime('last day of last month');
    }else{
        $since = strtotime('first day of this month');
        //$since = strtotime('-2 months');
        $until = time();
    }
    $days_in_range = $insta->getDaysInRange($since, $until);
    if($session->has('instagram')){
        $user_data = $insta->getUserData();
        if(!$oAuthclient or ($oAuthclient->source_data ==null )){
            $client = $insta->getClient();
            $oAuthclient= !$oAuthclient ?  new Authclient() : $oAuthclient;
            $oAuthclient->user_id = Yii::$app->user->getId();
            $oAuthclient->source = $client->name;
            $oAuthclient->source_id = $user_data["id"];
            $oAuthclient->source_data = serialize($client);
            $oAuthclient->save();
            $oModel = $insta->firstTimeToLog($user_data, $oAuthclient->id);
        }
        $oModels = $oAuthclient->model;
        if(!$oModels){
            $oModel = $insta->firstTimeToLog($user_data, $oAuthclient->id);
        }else{
            $insta->getTimeBasedAccountInsights($oModels[0]->id, $since, $until);
        }
        return $this->render('/instagram/instagram', [
            'user' => $user_data,
            'insta' => $insta,
            'followers_growth' => $insta->getFollowersGrowth($days_in_range),
            'statistics' => $insta->getEngagementStatistics($oModels[0]->id, $days_in_range, $since, $until),
            'model' => $oModels[0],
            'since' => $since,
            'until' => $until,
            'oRangeForm' => $oRangeForm,
            'authclient_created' => strtotime($oAuthclient->created),
            ]);
    }else{
        return $this->render('/instagram/instagramAuth');
    }
}
    
    public function actionTwitter(){
       //ini_set('max_execution_time', 900000);
        //check if the save access is working
        $twitter = new Twitter();
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'twitter']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null && (is_object($set_client = unserialize($oAuthclient->source_data)))){
                Twitter::setClient($set_client);
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
            $client = $twitter->getClient();
            $user_data = $twitter->getAccountData();
            if(!$oAuthclient or ($oAuthclient->source_data==null)){
                $client = $twitter->getClient();
                $oAuthclient= !$oAuthclient ?  new Authclient() : $oAuthclient;
                $oAuthclient->user_id = Yii::$app->user->getId();
                $oAuthclient->source = $client->name;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->source_id = $user_data["id_str"];
                $oAuthclient->save();
                //$oModel = $insta->firstTimeToLog($user_data, $oAuthclient->id);
            }
            $oModels = $oAuthclient->model;
              $oRangeForm = new RangeForm();
                if($oRangeForm->load(Yii::$app->request->post()) && $oRangeForm->validate()){
                    $since = strtotime($oRangeForm->start_date);
                    $until = strtotime($oRangeForm->end_date);
                }elseif(date('d M', time()) == date('d M', strtotime('first day of this month'))){
                    $since = strtotime('first day of last month');
                	//$since_str = date('Y-m-d H:i:s', $since);
                    $until = strtotime('first day of this month');
                	//$until_str = date('Y-m-d H:i:s', $until);
                }else{
                    //$since = strtotime('2016-08-01');
                    $since = strtotime('first day of this month');
                    //$since = strtotime('-12 months');
                	//$since_str = date('Y-m-d H:i:s', $since);
                    $until = time();
                }
            if(!$oModels){
                $oModels[0] = $twitter->firstTimeToLog($user_data, $oAuthclient->id);
		$twitter->getTimeBasedAccountInsights($oModels[0]->id, $since, $until);
              	$days_in_range = $twitter->getDaysInRange($since, $until);
            }else{
              $twitter->getTimeBasedAccountInsights($oModels[0]->id, $since, $until);
              $days_in_range = $twitter->getDaysInRange($since, $until);
            }
            return $this->render('/twitter/twitter', [
                'user' => $user_data,
                'twitter' => $twitter,
                'followers_growth' => $twitter->getFollowersGrowth($days_in_range),
                'following_growth' => $twitter->getFollowingGrowth($days_in_range),
                'listed_growth' => $twitter->getListedGrowth($days_in_range),
                'statistics' => $twitter->getEngagementStatistics($oModels[0]->id, $days_in_range, $since, $until),
                'top_ten_trends' => $twitter->getPublicTrends(),
                'model' => $oModels[0],
                'since' => $since,
                'until' => $until,
                'oRangeForm' => $oRangeForm,
                'authclient_created' => strtotime($oAuthclient->created),
                    ]);
        }else{
            return $this->render('/twitter/twitterAuth');  
        }
    }
    
    public function actionFacebook(){
        ini_set('max_execution_time', 900000);
        $session = Yii::$app->session;
        $fb = new Facebook();
        $oUserPagesForm = new UserPagesForm();
        //check if the saved access is working
        $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook']);
        if($oAuthclient ){
            if($oAuthclient->source_data != null && (is_object($set_client = unserialize($oAuthclient->source_data)))){
                Facebook::setClient($set_client);
               $client = $fb->getClient();
               $ReturnData = $client->getUserAttributes() ;
                if( $ReturnData == null){
                    $oAuthclient->source_data =null;
                    $oAuthclient->save();
                    Facebook::setClient( null);
                }
            }else{
                $client = Facebook::getClient();
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->save();
            }
        }

        if($session->has('facebook')){
            if($oUserPagesForm->load(Yii::$app->request->post()) && $oUserPagesForm->validate()){
                $client = $fb->getClient();
                $oAuthclient = new Authclient();
                $oAuthclient->user_id = Yii::$app->user->getId();
                $oAuthclient->source = $client->name;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->source_id = $client->getUserAttributes()["id"];
                $oAuthclient->save();
                $fb->firstTimeToLog($oUserPagesForm->id, $oAuthclient->id);
            }
            $oModel = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook'])->model;

            if($oModel){
                $oRangeForm = new RangeForm();
                $oExportForm = new ExportForm();
                if($oRangeForm->load(Yii::$app->request->post()) && $oRangeForm->validate()){
                    $since = strtotime($oRangeForm->start_date);
                    $since = strtotime('-1 days', $since);
                    $until = strtotime($oRangeForm->end_date);
                }elseif(date('d M', time()) == date('d M', strtotime('first day of this month'))){
                    $since = strtotime('first day of last month');
                    $since = strtotime('-1 days', $since);
                    $until = strtotime('last day of last month');
                }else{
                    $since = strtotime('first day of this month');
                    //$since = strtotime('-2 months');
                    $since = strtotime('-1 days', $since);
                    $until = time();
                }
                $page = $fb->getPageData($oModel[0]->entity_id);
                return $this->render('/facebook/facebookPage', [
                    'page' => $page,
                    'fb' => $fb,
                    'id' => $oModel[0]->entity_id,
                    'since' => $since,
                    'until' => $until,
                    'model' => $oModel[0],
                    'oRangeForm' => $oRangeForm,
                    'oExportForm' => $oExportForm,
                    'authclient_created' => strtotime($oAuthclient->created),
                ]);
            }else{
                return $this->render('/facebook/facebook',['user_pages' => $fb->getUserPages(), 'oUserPagesForm' => $oUserPagesForm]);
            }
        }else{
            return $this->render('/facebook/facebookAuth');
        }
    }
	
    /**
     * This function will be triggered when user is successfuly authenticated using some oAuth client.
     * @todo enhancements
     * @reference http://www.yiiframework.com/doc-2.0/guide-security-auth-clients.html
     * @param yii\authclient\ClientInterface $client
     * @return boolean|yii\web\Response
     */
	 
    public function onAuthSuccess($client) {
        $ActiveUser=Yii::$app->session->get('ActiveUser');
        if($client->name == 'facebook'){
            Facebook::setClient($client);
            return $this->action->redirect( Url::to(['facebook/'.$ActiveUser],true) );
        }elseif($client->name == 'twitter'){
                Twitter::setClient($client);
                return $this->action->redirect( Url::to(['twitter/'.$ActiveUser],true) );
        }elseif($client->name == 'instagram'){
            Instagram::setClient($client);
            return $this->action->redirect( Url::to(['instagram/'.$ActiveUser],true));
        }elseif($client->name == 'youtube'){
            Youtube::setClient($client);
            return $this->action->redirect( Url::to(['youtube/'.$ActiveUser],true) );
        }elseif($client->name == 'google_plus'){
            GooglePlus::setClient($client);
            return $this->action->redirect( Url::to(['google-plus/'.$ActiveUser],true) );
        }elseif($client->name == 'foursquare'){
            Foursquare::setClient($client);
            return $this->action->redirect( Url::to(['foursquare'],true) );
        }elseif($client->name == 'linkedin'){
            LinkedIn::setClient($client);
            return $this->action->redirect( Url::to(['linkedin/'.$ActiveUser],true) );
        }else{
            echo '<pre>'; var_dump($client); echo '</pre>'; die;
        }
    }

}
