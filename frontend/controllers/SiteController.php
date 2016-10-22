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
use frontend\models\ContactForm;
use frontend\models\SubscribeForm;
use frontend\models\UserPagesForm;
use frontend\models\SupportForm;
use frontend\models\CompetitorsForm;

/**
 * Site controller
 */
class SiteController extends \frontend\components\BaseController {

    public $defaultAction = 'home';
    public $Cashed =true;

    public function behaviors()
    {
        return [

            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['linkedin'],
                'duration' => 60*60*12, // 12 h
                    'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "linkedin" and user_id='.Yii::$app->user->getId(),
                ],

            ],
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['facebook'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "linkedin" and user_id='.Yii::$app->user->getId(),
                ],

            ],
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['twitter'],
                'duration' => 60*60*12, // 12 h
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT( id ) FROM authclient where source= "twitter" and user_id='.Yii::$app->user->getId(),
                ],

            ],
            'pageCache' => [
                        'class' => 'yii\filters\PageCache',
                        'only' => ['instagram'],
                        'duration' => 60*60*12, // 12 h
                        'dependency' => [
                            'class' => 'yii\caching\DbDependency',
                            'sql' => 'SELECT COUNT( id ) FROM authclient where source= "instagram" and user_id='.Yii::$app->user->getId(),
                        ],

                    ],
            'pageCache' => [
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

    /**
     * Home page
     */
    public function actionHome() {
          //var_dump (Yii::$app->user->getId()); die;
        return (Yii::$app->user->isGuest) ? $this->render('home') : $this->redirect('dashboard');
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
    public function actionDashboard() {
		$session= Yii::$app->session;
        $dashboard = new Dashboard();
		$oCompetitorsForm = new CompetitorsForm();
		if($oCompetitorsForm->load(Yii::$app->request->post()) && $oCompetitorsForm->validate()){
			//echo '<pre>'; var_dump($oCompetitorsForm); echo '</pre>'; die;
			if($dashboard->saveCompetitors($oCompetitorsForm)){
				//die('success');
			}else{
				//echo '<pre>'; var_dump($oCompetitorsForm); echo '</pre>'; 
				//die('error');
			}
		}
        if(!$session->has('dashboard_accounts')){
            $dashboard_accounts = [];
            $accounts = Authclient::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
            foreach($accounts as $account){
                if($account->model){
                    $dashboard_accounts[$account['source']]['entity_id'] = $account->model[0]['entity_id'];
                    $dashboard_accounts[$account['source']]['model_id'] = $account->model[0]['id'];
                }
            } 
            $session->set('dashboard_accounts', $dashboard_accounts);
        }
        $insights = $dashboard->getDashboardAccountsInsights();
        $dashboard->getGrowthPerMonth($insights);
        return $this->render('/dashboard/dashboard', ['insights' => $dashboard->getDashboardAccountsInsights(), 'oDashboard' => $dashboard, 'oCompetitorsForm' => $oCompetitorsForm]);
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

//        if($session->has('linkedin')) {
//            echo "<pre>";
//            print_r($linkedin->getClient());
//            echo "</pre>";
//            die;
//        }

        if($session->has('linkedin')){
            $client = $linkedin->getClient();
            $company_statistics = $linkedin->getCompanyStatistics();
            //echo '<pre>'; var_dump($linkedin->getCompanySizes($company_statistics['followStatistics']['companySizes']['values'])); echo '</pre>'; die;
            $oUserPagesForm = new UserPagesForm();

            if($oUserPagesForm->load(Yii::$app->request->post()) && $oUserPagesForm->validate()){
                $client = $linkedin->getClient();
                $oAuthclient =  $oAuthclient ? $oAuthclient : new Authclient();
                $oAuthclient->user_id = Yii::$app->user->getId();
                $oAuthclient->source = $client->name;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->source_id = $client->getUserAttributes()["id"];
                $oAuthclient->save();
                $linkedin->firstTimeToLog($oUserPagesForm->id, $oAuthclient->id);
            }
            if($oAuthclient){
                if($oAuthclient->source_data == null){
                    $oAuthclient->source_data =serialize($client);;
                    $oAuthclient->save();
                }

                $oModel = [];
                $oModel = $oAuthclient->model;
                if($oModel){
                    $since = strtotime('-12 months') * 1000;
                    $until = time() * 1000;
                    $statistics = $linkedin->statistics($oModel[0]);
                    $linkedin->saveAccountInsights($oModel[0], $since);
                    return $this->render('/linkedin/linkedinPage', ['statistics' => $statistics, 'linkedin' => $linkedin, 'oModel' => $oModel[0]]);
                }
            }else{
                return $this->render('/linkedin/linkedin',['user_pages' => $linkedin->getUserAdminCompanies(), 'oUserPagesForm' => $oUserPagesForm]);
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
            }
            //echo '<pre>'; var_dump($gPlus->getCompetitorNameAndCircledBy("https://plus.google.com/+TaylorSwift")); echo '</pre>'; die;
            $account = $gPlus->getAccountDetails();
            $gPlus->getTimeBasedAccountInsights();
            return $this->render('/google-plus/google-plus', [
                'account' => $account,
                'googleP' => $gPlus, 
                'followers_growth' => $gPlus->getFollowersGrowth(),
                'statistics' => $gPlus->getEngagementStatistics()
                    ]);
        }else{
            return $this->render('/google-plus/google-plusAuth');
        }
    }
    
    public function actionYoutube($p = null, $v = null){
        ini_set('max_execution_time', 300000);
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
            $channel_analytics = $youtube->getChannelAnalytics();

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
            if(!$models){
                $youtube->firstTimeToLog($oAuthclient->id);
            }else{
                //echo '<pre>'; var_dump($youtube->getCompetitorNameAndSubscribers("https://www.youtube.com/channel/UC89jxlRgoiqAnO_0pm-Ug0g")); echo '</pre>'; die;
                //$youtube->updatePostImageActualSize($oAuthclient->model[0]->id);
                $youtube->saveAccountInsights($oAuthclient->model[0]->id);
            }
            $subscribers = $youtube->getChannelSubscribers();
            return $this->render('/youtube/youtube', [
                'channels' => $channels,
                'channel_analytics' => $channel_analytics,
                'subscribers' => $subscribers,
                'youtube' => $youtube
            ]);

        }else{
            return $this->render('/youtube/youtubeAuth');
        }
    }

    public function actionInstagram(){
        ini_set('max_execution_time', 300000);
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

        //echo '<pre>'; var_dump($insta->getCompetitorNameAndFollowers()); echo '</pre>'; die;
	if(Yii::$app->request->post() && isset($_POST['since'])){
            $since = $_POST['since'];
	}else{
            $since =  strtotime('-3 months', time());
	}
	if(Yii::$app->request->post() && isset($_POST['until'])){
            $until = $_POST['until'];
	}else{
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
            //$oAuthclient = Authclient::findOne(['user_id' => 75, 'source' => 'instagram']); 
            $oModels = $oAuthclient->model;
            if(!$oModels){
                $oModel = $insta->firstTimeToLog($user_data, $oAuthclient->id);
            }else{
		$insta->saveAccountInsights($oModels[0]);
                $insta->getTimeBasedAccountInsights($oModels[0]->id, $since, $until);
            }
            return $this->render('/instagram/instagram', [
                'user' => $user_data,
                'insta' => $insta,
                'followers_growth' => $insta->getFollowersGrowth($days_in_range),
                'followers_gained_lost_json_table' => $insta->getFollowersGainedAndLostJsonTable($days_in_range),
                'statistics' => $insta->getEngagementStatistics($oModels[0]->id, $days_in_range, $since, $until),
		'model_id' => $oModels[0]->id,
		'since' => $since,
		'until' => $until,
                    ]);
        }else{
            return $this->render('/instagram/instagramAuth');
        }
    }
    
    public function actionTwitter(){
        ini_set('max_execution_time', 900000);
        //check if the save access is working
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
		//echo '<pre>'; var_dump($twitter->getCompetitorsNamesAndFollowers("https://twitter.com/GoldDerby")); echo '</pre>'; die;
        if($session->has('twitter')){
            $client = $twitter->getClient();
            //echo '<pre>'; var_dump($client->api('application/rate_limit_status.json', 'GET', ['resources' => 'statuses'])); echo '</pre>'; die;
            $user_data = $twitter->getAccountData();
           // $oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'twitter']);
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

            //$oAuthclient = Authclient::findOne(['user_id' => 75, 'source' => 'instagram']);
            $oModels = $oAuthclient->model;
            if(!$oModels){
                $oModels[0] = $twitter->firstTimeToLog($user_data, $oAuthclient->id);
		$twitter->getTimeBasedAccountInsights($oModels[0]->id);
            }else{
		$twitter->saveAccountInsights($oModels[0]);
                $twitter->getTimeBasedAccountInsights($oModels[0]->id);
            }
            
            return $this->render('/twitter/twitter', [
                'user' => $user_data,
                'twitter' => $twitter,
                'followers_growth' => $twitter->getFollowersGrowth(),
                'following_growth' => $twitter->getFollowingGrowth(),
                'listed_growth' => $twitter->getListedGrowth(),
                'statistics' => $twitter->getEngagementStatistics($oModels[0]->id),
                'top_ten_trends' => $twitter->getPublicTrends(),
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
                $client->getUserAttributes() ;
                $oAuthclient->source_data = serialize($client);
                $oAuthclient->save();
            }
        }

		//echo '<pre>'; var_dump($fb->getCompetitorNameAndFollowersFromUrl("https://www.facebook.com/collectivenouncomedy/?hc_ref=NEWSFEED")); echo '</pre>'; die;

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
		$since = strtotime('first day of this month');
                $until = time();
                $page = $fb->getPageData($oModel[0]->entity_id);
		$fb->saveAccountInsights($oModel[0], $page['likes']);
                return $this->render('/facebook/facebookPage',[
                    'page' => $page,
                    'fb' => $fb,
                    'id' => $oModel[0]->entity_id,
                    'since' => $since,
                    'until' => $until,
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
        if($client->name == 'facebook'){
            Facebook::setClient($client);
            return $this->action->redirect( Url::to(['facebook'],true) );
        }elseif($client->name == 'twitter'){
                Twitter::setClient($client);
                return $this->action->redirect( Url::to(['twitter'],true) );
        }elseif($client->name == 'instagram'){
            Instagram::setClient($client);
            return $this->action->redirect( Url::to(['instagram'],true));
        }elseif($client->name == 'youtube'){
            Youtube::setClient($client);
            return $this->action->redirect( Url::to(['youtube'],true) );
        }elseif($client->name == 'google_plus'){
            GooglePlus::setClient($client);
            return $this->action->redirect( Url::to(['google-plus'],true) );
        }elseif($client->name == 'foursquare'){
            Foursquare::setClient($client);
            return $this->action->redirect( Url::to(['foursquare'],true) );
        }elseif($client->name == 'linkedin'){
            LinkedIn::setClient($client);
            return $this->action->redirect( Url::to(['linkedin'],true) );
        }else{
            echo '<pre>'; var_dump($client); echo '</pre>'; die;
        }
    }

}
