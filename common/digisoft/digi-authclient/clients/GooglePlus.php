<?php

namespace digi\authclient\clients;

use Yii;
use yii\authclient\OAuth2;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use yii\authclient\OAuthToken;
use yii\base\Exception;


class GooglePlus extends OAuth2
{
    const ACCOUNT = 0;
    const POST = 1;
    
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://accounts.google.com/o/oauth2/auth?prompt=consent&access_type=offline';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://accounts.google.com/o/oauth2/token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://www.googleapis.com';
    
    public $redirect_uri = 'postmessage';
    
    public $account_insights_in_range;
    
    public $days_in_range;
    
    public $posts_in_range;
    
    public $statistics;
    
    public $hours;
    
    public function getHoursArray(){
        $this->hours = array();
        for($i = 1 ; $i <= 12 ; $i++){
            $this->hours[$i.'am'] = ['Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0];
        }
        for($i = 1 ; $i <= 12 ; $i++){
            $this->hours[$i.'pm'] = ['Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0];
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(' ', [
                'profile',
                'email',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('/plus/v1/people/me', 'GET');
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'google_plus';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Google Plus';
    }
    
    public function getDaysInRange(){
        $from = strtotime('first day of this month');
        $to = time();
        $this->days_in_range[] = $from;
        $current = $from;
        while($current <= $to){
            array_push($this->days_in_range, $current);
            $current = strtotime('+1 days', $current);
        }
        //echo '<pre>'; var_dump($this->days_in_range); echo '</pre>'; die;
        return $this->days_in_range;
    }
    
    public static function setClient($client){
        Yii::$app->session->set('google_plus', $client);
    }
    
    public function getClient(){
        $client = Yii::$app->session->get('google_plus');
        if(Yii::$app->session->get('google_plus')){
            return Yii::$app->session->get('google_plus');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getAccountDetails(){
        $client = GooglePlus::getClient();
        $account = $client->api('/plus/v1/people/me', 'GET');
        //$account = $client->api('/plus/v1/people/+Pepsi/people/connected', 'GET');
        return $account;
    }
	
    public function getPublicActivities(){
        $client = GooglePlus::getClient();
        $public_activities = $client->api('/plus/v1/people/me/activities/public?maxResults=100');
        return $public_activities;
    }
    
    public function getTheRestOfThePublicActivities($page_token){
        $client = GooglePlus::getClient();
        $public_activities = $client->api('/plus/v1/people/me/activities/public', 'GET', ['pageToken' => $page_token, 'maxResults' => 100]);
        return $public_activities;
    }
    
    public function getAllPublicActivities(){
        $public_activities = array();
        $public_activities_array = $this->getPublicActivities();
        $public_activities = $public_activities_array ['items'];
        while(array_key_exists('nextPageToken', $public_activities_array)){
            $public_activities_array = $this->getTheRestOfThePublicActivities($public_activities_array['nextPageToken']);
            $public_activities = array_merge($public_activities, $public_activities_array ['items']);
        }
        return $public_activities;
    }
  
  	
  	public function checkClientSession(){
    	if(Yii::$app->session['google_plus']){
        	return GooglePlus::getClient();
        }else{
        	$oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'google_plus']);
          	if(! $oAuthclient ){
            	$oAuthclient = Authclient::findOne(['user_id' => 2, 'source' => 'google_plus']);
              	$client = unserialize($oAuthclient->source_data);
                  $ReturnData = $client->getUserAttributes() ;
                    if( $ReturnData == null){
                        $oAuthclient->source_data =null;
                        $oAuthclient->save();
                          $client = null;
                    }
                return $client;
            }
              if($oAuthclient->source_data != null){
                 GooglePlus::setClient( unserialize($oAuthclient->source_data));
                 $ReturnData = $this->getAccountDetails() ;
                  if( $ReturnData == null){
                      $oAuthclient->source_data =null;
                      $oAuthclient->save();
                      GooglePlus::setClient( null);
                  }
                return GooglePlus::getClient();
              }
        }
    }
  
    
    public function getAccountDetailsById($id){
        $client = $this->checkClientSession();
        $account = $client->api('/plus/v1/people/'.$id, 'GET');
        return $account;
    }
	
    public function getUserIdUsingUrl($url){
        $username  = substr($url, 24);
        return $username;
    }
	
    public function getCompetitorNameAndCircledBy($url){
	$username = $this->getUserIdUsingUrl($url);
	$data = $this->getAccountDetailsById($username);
	$page['followers'] = $data["circledByCount"];
	$page['name'] = $data["displayName"];
	$page['id'] = $data["id"];
	return $page;
    }
    
    public function getPublicActivitiesById($id){
        $client = GooglePlus::getClient();
        $public_activities = $client->api('/plus/v1/people/'.$id.'/activities/public?maxResults=100');
        return $public_activities;
    }
    
    public function getTheRestOfThePublicActivitiesById($id, $page_token){
        $client = GooglePlus::getClient();
        $public_activities = $client->api('/plus/v1/people/'.$id.'/activities/public', 'GET', ['pageToken' => $page_token, 'maxResults' => 100]);
        return $public_activities;
    }
    
    public function getAllPublicActivitiesById($id){
        $public_activities = array();
        $public_activities_array = $this->getPublicActivitiesById($id);
        $public_activities = $public_activities_array ['items'];
        while(array_key_exists('nextPageToken', $public_activities_array)){
            $public_activities_array = $this->getTheRestOfThePublicActivitiesById($id, $public_activities_array['nextPageToken']);
            $public_activities = array_merge($public_activities, $public_activities_array ['items']);
        }
        return $public_activities;
    }
    
    public function creatNewPostModel($post, $authclient_id, $parent_model_id, $followers){
        $oPostModel = new Model();
        $oPostModel->authclient_id = $authclient_id;
        $oPostModel->parent_id = $parent_model_id;
        $oPostModel->entity_id = $post['id'];
        $oPostModel->type = self::POST;
        if(array_key_exists('attachments', $post['object'])){
            (array_key_exists('image', $post['object']['attachments'][0])) ? ($oPostModel->media_url = $post['object']['attachments'][0]['image']['url']) : '';
        }
        $oPostModel->likes = $post['object']['plusoners']['totalItems'];
        $oPostModel->comments = $post['object']['replies']['totalItems'];
        $oPostModel->shares = $post['object']['resharers']['totalItems'];
        $oPostModel->followers = $followers;
        $oPostModel->creation_time = strtotime($post['published']);
        $oPostModel->url = $post['url'];
        //echo '<pre>'; var_dump($oPostModel); echo '</pre>'; die;
        if($oPostModel->save()){
            return $oPostModel;
        }else{
            echo 'there were an error while saving this model'; die;
        }
    }
    
    public function firstTimeToLogNewPostModel($post, $authclient_id, $parent_model_id, $followers){
        $oPostModel = new Model();
        $oPostModel->authclient_id = $authclient_id;
        $oPostModel->parent_id = $parent_model_id;
        $oPostModel->entity_id = $post['id'];
        $oPostModel->type = self::POST;
        if(array_key_exists('attachments', $post['object'])){
            (array_key_exists('image', $post['object']['attachments'][0])) ? ($oPostModel->media_url = $post['object']['attachments'][0]['image']['url']) : '';
        }
        $oPostModel->likes = $post['object']['plusoners']['totalItems'];
        $oPostModel->comments = $post['object']['replies']['totalItems'];
        $oPostModel->shares = $post['object']['resharers']['totalItems'];
        $oPostModel->creation_time = strtotime($post['published']);
        if(strtotime($post['published']) >= strtotime(date('Y-m-d', time()))){
            $oPostModel->followers = $followers;
        }
        $oPostModel->url = $post['url'];
        if($oPostModel->save()){
            return $oPostModel;
        }else{
            echo 'there were an error while saving this model'; die;
        }
    }
    
    public function firstTimeToLog($user_data){
      $oAuthclient = Authclient::findOne(['source_id' => $user_data['id']]);
        if($oAuthclient){
            $oAccountModel = new Model();
            $oAccountModel->authclient_id = $oAuthclient->id;
            $oAccountModel->entity_id = $user_data["id"];
            $oAccountModel->type = self::ACCOUNT;
            $oAccountModel->name = $user_data["displayName"];
            $oAccountModel->media_url = $user_data["image"]["url"];
            //echo '<pre>'; var_dump($oAccountModel); echo '</pre>'; die;
            if($oAccountModel->save()){
                $all_posts =  $this->getAllPublicActivities();
                $total_likes = $total_comments = $total_shares = 0;
                foreach($all_posts as $post){
                    $total_likes += $post['object']['plusoners']['totalItems'];
                    $total_comments += $post['object']['replies']['totalItems'];
                    $total_shares += $post['object']['resharers']['totalItems'];
                    $oPostModel = $this->firstTimeToLogNewPostModel($post, $oAuthclient->id, $oAccountModel->id, $user_data['circledByCount']);
                }
                $oAccountInsights = new Insights();
                $oAccountInsights->model_id = $oAccountModel->id;
                $oAccountInsights->followers = $user_data["circledByCount"];
                $oAccountInsights->number_of_posted_media = count($all_posts);
                $oAccountInsights->total_likes = $total_likes;
                $oAccountInsights->total_comments = $total_comments;
                $oAccountInsights->total_shares = $total_shares;
                if($oAccountInsights->save()){
                    return $oAccountInsights;
                }else{
                   echo 'there were an error while saving this insights'; die; 
                }
            }else{
                echo 'there were an error while saving this page model'; die;
            }
        }else{
            echo "ERROR: couldn't find authclient"; die;
        }
        
    }
    
    public function everydayCron(){
        $all_accounts = Authclient::find()->where(['source' => 'google_plus'])->all();
        foreach($all_accounts as $account){
            $user_data = $this->getAccountDetailsById($account->source_id);
            $oAccountModel = Model::findOne(['authclient_id' => $account->id, 'entity_id' => $account->source_id]);
            if($oAccountModel){
                $all_posts =  $this->getAllPublicActivities();
                $total_likes = $total_comments = $total_shares = 0;
                foreach($all_posts as $post){
                    $total_likes += $post['object']['plusoners']['totalItems'];
                    $total_comments += $post['object']['replies']['totalItems'];
                    $total_shares += $post['object']['resharers']['totalItems'];
                    $oPostModel = Model::findOne(['parent_id' => $oAccountModel->id, 'entity_id' => $post['id']]);
                    if(!$oPostModel){
                        $oPostModel = $this->creatNewPostModel($post, $oAuthclient->id, $oAccountModel->id, $user_data['circledByCount']);
                    }
                }
                $oAccountInsights = new Insights();
                $oAccountInsights->model_id = $oAccountModel->id;
                $oAccountInsights->followers = $user_data["circledByCount"];
                $oAccountInsights->number_of_posted_media = count($all_posts);
                $oAccountInsights->total_likes = $total_likes;
                $oAccountInsights->total_comments = $total_comments;
                $oAccountInsights->total_shares = $total_shares;
                if(!$oAccountInsights->save()){
                    echo "error while saving this page's insights"; die;
                }
            }else{
                echo "couldn't find it"; die;
            }
        }
    }
    
    public function getTimeBasedAccountInsights($model_id, $since = null, $until = null){
        ($since)? '' : ($since = strtotime(date('Y-m', time()).'-1'));
        ($until)? '' : ($until = time());
        $this->account_insights_in_range = Insights::find()->where(['model_id' => $model_id])->andWhere(['>=', 'created', $since])/*->andWhere(['<=', 'created', $until])*/->all();
        return $this->account_insights_in_range;
    }
    
    public function getFollowersGrowth(){
        $followers_growth_array = array();
        foreach($this->account_insights_in_range as $insights){
            $followers_growth_array[date('d M, y', strtotime($insights->created))] = $insights->followers;
        }
        return $followers_growth_array;
    }
    
    public function getFollowersGrowthJsonTable($followers_growth){
        $followers_growth_json_table = ($followers_growth) ? GoogleChartHelper::getDataTable('day', 'followers', $followers_growth) : '';
        return $followers_growth_json_table;
    }
    
    public function getTimeBasedPosts($parent_id, $since = null, $until = null){
        ($since)? '' : ($since = strtotime(date('2015-5-1')));
        ($until)? '' : ($until = time());
        $this->posts_in_range = Model::find()->where(['parent_id' => $parent_id])->andWhere(['>=', 'creation_time', $since])->andWhere(['<=', 'creation_time', $until])->all();
        
        return $this->posts_in_range;
    }
    
    public function getTopPostsByEngagement(){
        $top_posts_by_eng = [];
        if($this->posts_in_range){
            $post_array = array();
            //echo '<pre>'; var_dump($this->posts_in_range); echo '</pre>'; die;
            foreach($this->posts_in_range as $key => $oPost){
                if(!$oPost->followers){
                   $post_array[$key] = null; 
                }else{
                    $post_array[$key] = ((($oPost->likes + $oPost->comments + $oPost->shares)/($oPost->followers))*100);
                }
            }
            arsort($post_array);
            ///echo '<pre>'; var_dump($post_array); echo '</pre>'; die;
            $top_posts_by_eng = array();
            foreach($post_array as $key => $value){
                ($value != null) ? ($top_posts_by_eng[] = ['id' => $this->posts_in_range[$key]->id, 'engagement' => round($value, 2), 'likes' => $this->posts_in_range[$key]->likes, 'comments' => $this->posts_in_range[$key]->comments, 'shares' => $this->posts_in_range[$key]->shares,'link' => $this->posts_in_range[$key]->url, 'media_url' => $this->posts_in_range[$key]->media_url]) : '';  
            }
        }
        //echo '<pre>'; var_dump($top_posts_by_eng); echo '</pre>'; die;
        return $top_posts_by_eng;
    }
    
    public function getEngagementStatistics($model_id){
        $this->getDaysInRange();
        $this->getTimeBasedPosts($model_id);
        
        $this->statistics['top_posts_by_engagement'] = $this->getTopPostsByEngagement();
        $this->statistics['total_posts'] = $this->statistics['total_post_likes'] = $this->statistics['total_post_comments'] = 
        $this->statistics['total_post_shares'] = $this->statistics['total_post_engagement_rate'] = 
        $this->statistics['max_post_engagement_rate'] = $this->statistics['days_with_engagement'] =
        $this->statistics['total_profile_engagement_rate'] = $this->statistics['max_profile_engagement_rate'] = 0;
        $this->statistics['profile'] = array();
        
        foreach($this->days_in_range as $day){
          	$day_formated = date('M d, y', $day);
            $date_day = date('M d', $day);
            $refine_date = date('d', $day);
            $date = ($refine_date != '01') ?  $refine_date : $date_day;
            
            foreach($this->posts_in_range as $post){
                if(date('M d, y', $post->creation_time) == $day_formated){
                    if(!array_key_exists($day_formated, $this->statistics['profile'])){
                        $this->statistics["profile"][$date]["amount"] = 1;
                        $this->statistics["profile"][$date]["interaction"] = ($post->likes + $post->comments + $post->shares);
                        $this->statistics['profile'][$date]['followers'] = $post->followers;
                    }else{
                        $this->statistics["profile"][$date]["amount"]++;
                        $this->statistics["profile"][$date]["interaction"] += ($post->likes + $post->comments + $post->shares); 
                    }
                    $this->statistics['total_posts']++;
                    $this->statistics['total_post_likes'] += $post->likes;
                    $this->statistics['total_post_comments'] += $post->comments;
                    $this->statistics['total_post_shares'] += $post->shares;
                    
                }
            }
            if(!array_key_exists($date, $this->statistics['profile'])){
                $this->statistics["profile"][$date]["amount"] = 0;
                $this->statistics["profile"][$date]["interaction"] = 0;
                $this->statistics['profile'][$date]['followers'] = 0;
                $this->statistics['profile'][$date]["profile_engagement"] = 0;
                $this->statistics['profile'][$date]["post_engagement"] = 0;
            }else{
                if($this->statistics['profile'][$date]['followers']){
                    (($this->statistics['profile'][$date]['interaction']) != 0) ? $this->statistics['days_with_engagement']++ : '';
                    $this->statistics["profile"][$date]["profile_engagement"] = round(((($this->statistics["profile"][$date]['interaction'])/($this->statistics['profile'][$date]['followers']))*100), 2);
                    $this->statistics['profile'][$date]["post_engagement"] = round(((($this->statistics["profile"][$date]['interaction'])/($this->statistics['profile'][$date]['amount'])/($this->statistics['profile'][$date]['followers']))*100),2);
                }else{
                    $this->statistics["profile"][$date]["profile_engagement"] = null;
                    $this->statistics['profile'][$date]["post_engagement"] = null;
                }
                
                $this->statistics['total_post_engagement_rate'] += $this->statistics['profile'][$date]["post_engagement"];
                ($this->statistics['profile'][$date]["post_engagement"] > $this->statistics['max_post_engagement_rate']) ? ($this->statistics['max_post_engagement_rate'] = $this->statistics['profile'][$date]["post_engagement"]) : '';
                $this->statistics['total_profile_engagement_rate'] += $this->statistics['profile'][$date]["profile_engagement"];
                ($this->statistics['profile'][$date]["profile_engagement"] > $this->statistics['max_profile_engagement_rate']) ? ($this->statistics['max_profile_engagement_rate'] = $this->statistics['profile'][$date]["profile_engagement"]) : '';
            }
        }
        
        $this->statistics['avg_likes_per_post'] = (($this->statistics['total_posts'] != 0) ? (($this->statistics['total_post_likes'])/($this->statistics['total_posts'])) : 0);
        $this->statistics['avg_comments_per_post'] = (($this->statistics['total_posts'] != 0) ? (($this->statistics['total_post_comments'])/($this->statistics['total_posts'])) : 0);
        $this->statistics['avg_shares_per_post'] = (($this->statistics['total_posts'] != 0) ? (($this->statistics['total_post_shares'])/($this->statistics['total_posts'])) : 0);
        $this->statistics['total_interaction'] = $this->statistics['total_post_likes'] + $this->statistics['total_post_comments'] + $this->statistics['total_post_shares'];
        $this->statistics['avg_interaction_per_post'] = (($this->statistics['days_with_engagement'] != 0) ? (($this->statistics['total_interaction'])/($this->statistics['days_with_engagement'])) : 0);
        $this->statistics['avg_post_engagement_rate'] = ($this->statistics['days_with_engagement'] != 0) ? ($this->statistics['total_post_engagement_rate']/$this->statistics['days_with_engagement']) : 0;
        $this->statistics['avg_profile_engagement_rate'] = ($this->statistics['days_with_engagement'] != 0) ? ($this->statistics['total_profile_engagement_rate']/$this->statistics['days_with_engagement']) : 0;
        return $this->statistics;
    }
    
    public function getNumberOfPostsJsonTable($profile_statistics){
        $posts_per_day_json_table = ($profile_statistics) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'post', null, $profile_statistics, null, 'amount', null) : '';
		return $posts_per_day_json_table;
    }
    
    public function getNumberOfInteractionsJsonTable($profile_statistics){
        $interactions_per_day_json_table = ($profile_statistics) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'post', null, $profile_statistics, null, 'interaction', null) : '';
        return $interactions_per_day_json_table;
    }
    
    public function getPostEngagementJsonTable($profile_statistics){
        $post_engagement_per_day_json_table = ($profile_statistics) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'post engagement', null, $profile_statistics, null, 'post_engagement', null) : '';
        return $post_engagement_per_day_json_table;
    }
    
    public function getProfileEngagementJsonTable($profile_statistics){
        $profile_engagement_per_day_json_table = ($profile_statistics) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'profile engagement', null, $profile_statistics, null, 'profile_engagement', null) : '';
        return $profile_engagement_per_day_json_table;
    }
    
    public function bestTimeToPost($model_id){
        $this->getHoursArray(); 
        $this->getTimeBasedPosts($model_id);
        $hour = $this->hours;
      	if($this->posts_in_range){
          $total = 0;
          foreach($this->posts_in_range as $post){
            	$interaction = $post->likes + $post->comments + $post->shares;
              	$hour[date('ga', $post->creation_time)][date('D', $post->creation_time)] += $interaction;
            	$total += $interaction;
          }if($total){
          	return $hour;
          }else{
          	return null;
          }
        }else{
        	return null;
        }
    }
    
    public function getBestTimeToPostJsonTable($model_id){
        $best_time_to_post = $this->bestTimeToPost($model_id);
        $best_time_to_post_json_table = GoogleChartHelper::getBestTimeToPost($best_time_to_post);
        return $best_time_to_post_json_table;
    }

   // inherit this function to check the api return
    protected function sendRequest($method, $url, array $params = [], array $headers = [])
    {
        $curlOptions = $this->mergeCurlOptions(
            $this->defaultCurlOptions(),
            $this->getCurlOptions(),
            [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => $url,
            ],
            $this->composeRequestCurlOptions(strtoupper($method), $url, $params)
        );
        $curlResource = curl_init();
        foreach ($curlOptions as $option => $value) {
            curl_setopt($curlResource, $option, $value);
        }
        $response = curl_exec($curlResource);
        $responseHeaders = curl_getinfo($curlResource);

        // check cURL error
        $errorNumber = curl_errno($curlResource);
        $errorMessage = curl_error($curlResource);

        curl_close($curlResource);

        if ($errorNumber > 0) {
            throw new Exception('Curl error requesting "' .  $url . '": #' . $errorNumber . ' - ' . $errorMessage);
        }
        if (strncmp($responseHeaders['http_code'], '20', 2) !== 0) {
            $error= json_decode($response, TRUE);
             //            echo "<pre>";
//            print_r($error['error']['message']);
//            echo "</pre>";
//            die;
            if( $error['error']['message']  == "Invalid Credentials") {
                return null;
            }else{
                throw new InvalidResponseException($responseHeaders, $response, 'Request failed with code: ' . $responseHeaders['http_code'] . ', message: ' . $response);
            }
        }

        return $this->processResponse($response, $this->determineContentTypeByHeaders($responseHeaders));
    }
    public function api($apiSubUrl, $method = 'GET', array $params = [], array $headers = [])
    {
        if (preg_match('/^https?:\\/\\//is', $apiSubUrl)) {
            $url = $apiSubUrl;
        } else {
            $url = $this->apiBaseUrl . '/' . $apiSubUrl;
        }
        $accessToken = $this->getAccessToken();

        if (!is_object($accessToken) || !$accessToken->getIsValid()) {

            if( !$accessToken->getIsValid() ){
                $accessToken = $this->refreshAccessToken($accessToken);
                if($accessToken == null){return null;}else{$this->setAccessToken($accessToken);}
            }else{
                return null ;

            }
           // throw new Exception('Invalid access token.');
        }
        return $this->apiInternal($accessToken, $url, $method, $params, $headers);
    }



    //to fix the lib issues for request new token
    public function refreshAccessToken(OAuthToken $token)
    {
        if(! isset($token->getParams()['refresh_token'])){
            return null ;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accounts.google.com/o/oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "client_id=$this->clientId&client_secret=$this->clientSecret&refresh_token=".$token->getParams()['refresh_token']."&grant_type=refresh_token",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $returnData= json_decode($response);
            //  echo  $returnData->access_token.'dddd';die;
            $token->setToken($returnData->access_token);
            return $token;
        }

    }





}
