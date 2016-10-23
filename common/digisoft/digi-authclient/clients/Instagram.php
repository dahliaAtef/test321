<?php

namespace digi\authclient\clients;

use Yii;
use yii\authclient\InvalidResponseException;
use yii\authclient\OAuth2;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;

class Instagram extends OAuth2
{
    const ACCOUNT = 0;
    const POST = 1;
    const IMAGE = 0;
    const VIDEO = 1;
    
    public $authUrl = 'https://api.instagram.com/oauth/authorize';

    public $tokenUrl = 'https://api.instagram.com/oauth/access_token';

    public $apiBaseUrl = 'https://api.instagram.com/v1';
    
    public $statistics = array();
    
    public $media_in_range;
    
    public $account_insights_in_range;
    
    public $hours;
    
    protected function initUserAttributes()
    {
        $response = $this->api('users/self', 'GET');

        return $response['data'];
    }

    protected function defaultName()
    {
        return 'instagram';
    }

    protected function defaultTitle()
    {
        return 'Instagram';
    }

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
            if( $error['meta']['error_type']  == "OAuthAccessTokenException") {
                return null;
            }else{
                throw new InvalidResponseException($responseHeaders, $response, 'Request failed with code: ' . $responseHeaders['http_code'] . ', message: ' . $response);
            }
        }

        return $this->processResponse($response, $this->determineContentTypeByHeaders($responseHeaders));
    }

    
    /**
     * get array of days in the specified range of days 
     **/
    public function getDaysInRange($from, $to){
        $days_in_range[] = $from;
        $current = strtotime('+1 days', $from);
        while($current <= $to){
            array_push($days_in_range, $current);
            $current = strtotime('+1 days', $current);
        }
        return $days_in_range;
    }
    
    /**
     * get array of hours per week days 
     **/
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
     * Set instagram client session 
     **/
    public function setClient($client){
        Yii::$app->session->set('instagram', $client);
    }
    
    /**
     * get instagram client session 
     **/
    public function getClient(){
        $client = Yii::$app->session->get('instagram');
        if(Yii::$app->session->get('instagram')){
            return Yii::$app->session->get('instagram');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    
    /**
     * Get logged in user data
     **/
    public function getUserData(){
        $client = $this->getClient();
        $user_data = $client->api("users/self", 'GET')["data"];
        return $user_data;
    }
    
    /**
     * Get user data by account_id
     **/
    public function getUserDataById($id){
        $client = $this->getClient();
        $user_data = $client->api("users/".$id, 'GET')["data"];
        return $user_data;
    }
    
    public function getUsersFollowedByAuthUser(){
        $client = $this->getClient();
        $follows = $client->api("users/self/follows", 'GET');
        return $follows;
    }
    
    public function getUserFollowers(){
        $client = $this->getClient();
        $followers = $client->api("users/self/followed-by", 'GET');
        return $followers;
    }
    
    public function getUserMedia(){
        $client = $this->getClient();
        $media = $client->api("users/self/media/recent?count=100", 'GET');
        return $media;
    }
    
    public function getTheRestOfUserMedia($max_id){
        $client = $this->getClient();
        $media = $client->api("users/self/media/recent?count=100&max_id".$max_id, 'GET');
        return $media;
    }
    
    public function getMediaLikes($media_id){
        $client = $this->getClient();
        $media_likes = $client->api("media/".$media_id."/likes", 'GET');
        return $media_likes;
    }
    
    public function getMediaComments($media_id){
        $client = $this->getClient();
        $media_comments = $client->api("media/".$media_id."/comments", 'GET');
        return $media_comments;
    }

    public function getInteractionPerPostTypeJsonTable($interaction_per_post_type){
        sort($interaction_per_post_type);
        $interaction_per_post_type_json_table = GoogleChartHelper::getArrayOfArrayDataTable('media type', 'value', $interaction_per_post_type);
        return $interaction_per_post_type_json_table;
    }
    
    public function getInstagramAccounts(){
        //$accounts = Authclient::find()->andWhere(['source' => 'instagram'])->joinWith('model')->andWhere(['model.parent_id' => null, 'model.type' => self::ACCOUNT])->all();
        $accounts = Model::find()->andWhere(['parent_id' => null, 'type' => self::ACCOUNT])->joinWith('authclient')->andWhere(['authclient.source' => 'instagram'])->all();
        return $accounts;
    }
    
    public function getUserAccount($id){
        $client = $this->getClient();
        $user_data = $client->api("users/".$id, 'GET')["data"];
        return $user_data;
    }
    
    public function getUserFollowersById($id){
        $client = $this->getClient();
        $followers = $client->api("users/".$id."/followed-by", 'GET');
        return $followers;
    }
    
    public function getAllUserFollowersById($id){
        $user_followers = $this->getUserFollowersById($id);
        $all_users = $user_followers["data"];
        
        while($user_followers["pagination"]){
            $user_followers = $this->getUserAccountRestOfMediaById($account_id, $media_data["pagination"]["next_max_id"]);
            $all_users += $user_followers["data"];
        }
        return $all_users;
    }
    
    public function getUserAccountMediaById($id){
        $client = $this->getClient();
        $user_media = $client->api("users/".$id."/media/recent?count=100", 'GET');
        return $user_media;
    }
    
    public function getUserAccountRestOfMediaById($id, $max_id){
        $client = $this->getClient();
        $user_media = $client->api("users/".$id."/media/recent?count=100&max_id".$max_id, 'GET');
        return $user_media;
    }
    
    public function getTest($tag_name = 'clean'){
        $client = $this->getClient();
        //$test_results = $client->api("tags/".$tag_name, 'GET');
        //$test_results = $client->api("tags/".$tag_name."/media/recent?count=10", 'GET');
        //$test_results = $client->api("subscriptions", 'GET');
        $test_results = $client->api("");
        return $test_results;
    }
    
    public function everydayCron(){
        $accounts = $this->getInstagramAccounts();
        foreach($accounts as $oAccountModel){
            $userData = $this->getUserAccount($oAccountModel->entity_id);
            $oAccountInsights = new Insights();
            $oAccountInsights->model_id = $oAccountModel->id;
            $oAccountInsights->followers = $userData["counts"]["followed_by"];
            $gained_lost_followers = $this->compareFollowers($oAccountModel->id, $oAccountModel->entity_id);
            $oAccountInsights->gained_followers = $gained_lost_followers['gained'];
            $oAccountInsights->lost_followers = $gained_lost_followers['lost'];
            $oAccountInsights->follows = $userData["counts"]["follows"];
            $oAccountInsights->number_of_posted_media = $userData["counts"]["media"];
           if($oAccountInsights->save()){
                $all_media = $this->getAllMediaByAccountId($userData["id"]);
                $total_media_likes = $total_media_comments = 0;
                foreach($all_media as $media_value){
                    $oMediaModel = Model::findOne(['entity_id' => $media_value["id"]]);
                    if(!$oMediaModel){
                        $oMediaModel = $this->createNewMediaModel($oAccountModel, $userData["counts"]["followed_by"], $media_value);
                    }else{
                        $oMediaModel->likes = $media_value["likes"]["count"];
                        $oMediaModel->comments = $media_value["comments"]["count"];
                        $oMediaModel->save();
                    }
                    $total_media_likes += $oMediaModel->likes;
                    $total_media_comments += $oMediaModel->comments;
                }
                $oAccountInsights->total_likes = $total_media_likes;
                $oAccountInsights->total_comments = $total_media_comments;
                $oAccountInsights->save();
            }
        }
    }
    
    public function updateMediaModels($all_media){
        foreach($all_media as $media){
            //echo '<pre>'; var_dump($media); echo '</pre>'; die;
            $oMediaModel = Model::findOne(['entity_id' => $media['id']]);
            $oMediaModel->filter = $media['filter'];
            $oMediaModel->save();
        }
        echo 'done'; die;
    }

    public function getAllMedia($since){
        $media_data = $this->getUserMedia();
        $all_media = $media_data["data"];
        while((($all_media[count($all_media)-1]['created_time']) >= $since) && $media_data["pagination"]){
            $media_data = $this->getTheRestOfUserMedia($media_data["pagination"]["next_max_id"]);
            $media += $media_data["data"];
        }
        return $all_media;
    }
    
    public function getAllMediaByAccountId($account_id){
        $since = strtotime('-1 months', time());
        $media_data = $this->getUserAccountMediaById($account_id);
        $all_media = $media_data["data"];
        
        while((($all_media[count($all_media)-1]['created_time']) >= $since) && $media_data["pagination"]){
            $media_data = $this->getUserAccountRestOfMediaById($account_id, $media_data["pagination"]["next_max_id"]);
            $all_media += $media_data["data"];
        }
        return $all_media;
    }
    
    public function createNewMediaModel($oAccountModel, $followers_count, $media){
        $oMediaModel = new Model();
        $oMediaModel->authclient_id = $oAccountModel->authclient_id;
        $oMediaModel->parent_id = $oAccountModel->id;
        $oMediaModel->entity_id = $media["id"];
        $oMediaModel->type = self::POST;
        $oMediaModel->media_url = $media["images"]["thumbnail"]["url"];
        $oMediaModel->post_type = ($media['type'] == 'image') ? (self::IMAGE) : (self::VIDEO); 
        $oMediaModel->likes = $media["likes"]["count"];
        $oMediaModel->comments = $media["comments"]["count"];
        $oMediaModel->followers = $followers_count;
        $oMediaModel->creation_time = $media["created_time"];
        $oMediaModel->url = $media["link"];
        $oMediaModel->tags = implode(',', $media["tags"]);
        $oMediaModel->filter = $media['filter'];
        $oMediaModel->save();
        return $oMediaModel;
    }
	
    public function updateMediaModel($oMediaModel, $media){
        $oMediaModel->likes = $media["likes"]["count"];
        $oMediaModel->comments = $media["comments"]["count"];
        $oMediaModel->update();
        return $oMediaModel;
    }
    
    public function firstLogNewMediaModel($oAccountModel, $followers_count, $media){
        $today = strtotime(date('d-m-Y', time()));
        $oMediaModel = new Model();
        $oMediaModel->authclient_id = $oAccountModel->authclient_id;
        $oMediaModel->parent_id = $oAccountModel->id;
        $oMediaModel->entity_id = $media["id"];
        $oMediaModel->type = self::POST;
        $oMediaModel->media_url = $media["images"]["thumbnail"]["url"];
        $oMediaModel->post_type = ($media['type'] == 'image') ? (self::IMAGE) : (self::VIDEO); 
        $oMediaModel->likes = $media["likes"]["count"];
        $oMediaModel->comments = $media["comments"]["count"];
        $oMediaModel->followers = ($media["created_time"] >= $today) ? $followers_count :  null;
        $oMediaModel->creation_time = $media["created_time"];
        $oMediaModel->url = $media["link"];
        $oMediaModel->tags = implode(',', $media["tags"]);
        $oMediaModel->filter = $media['filter'];
        $oMediaModel->save();
        return $oMediaModel;
    }
    
    public function saveRecentFollowers($model_id = 60, $user_id = '1527813113'){
        $oRecentFollowers = new RecentFollowers();
        $oRecentFollowers->model_id = $model_id;
        $followers = $this->getAllUserFollowersById($user_id);
        $followers[2] = array (
              "username" => "Sea",
              "profile_picture" => "https://igcdn-photos-b-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/s150x150/11373938_883088071771257_52101692_a.jpg",
              "id" => "401454021",
              "full_name" => "Sarah"
            );
        $oRecentFollowers->followers_json = json_encode($followers);
        $oRecentFollowers->save();
    }
    
    public function compareFollowers($model_id, $authclient_id){
        $old_followers = json_decode(RecentFollowers::findOne(['model_id' => $model_id])->followers_json, true);
        $new_followers = $this->getAllUserFollowersById($authclient_id);
        $new_followers[2] = 
            array (
              "username" => "tena",
              "profile_picture" => "https://igcdn-photos-b-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/s150x150/11373938_883088071771257_52101692_a.jpg",
              "id" => "401354021",
              "full_name" => "mariana"
            );
        $followers['lost'] = -count(array_diff(array_map('serialize',$old_followers), array_map('serialize',$new_followers)));
        $followers['gained'] = count(array_diff(array_map('serialize',$new_followers), array_map('serialize',$old_followers)));
        $oRecentFollowers = RecentFollowers::findOne(['model_id' => $model_id]);
        $oRecentFollowers->followers_json = json_encode($new_followers);
        $oRecentFollowers->update();
        return $followers;
    }
    
    public function firstTimeToLog($user_data, $authclient_id){
        $since = strtotime('first day of this month');
        $oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $user_data["id"];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $user_data["username"];
        $oAccountModel->media_url = $user_data["profile_picture"];
        if($oAccountModel->save()){
            $all_media = $this->getAllMedia($since);
            $total_photo_likes = $total_photo_comments = $total_video_likes = $total_video_comments = 0;
            foreach($all_media as $media){
                if(($media['created_time']) >= $since){
                    $oMediaModel = $this->firstLogNewMediaModel($oAccountModel, $user_data["counts"]["followed_by"], $media);
                    if($oMediaModel->post_type == self::IMAGE){
                        $total_photo_likes += $oMediaModel->likes;
                        $total_photo_comments += $oMediaModel->comments;
                    }else{
                        $total_video_likes += $oMediaModel->likes;
                        $total_video_comments += $oMediaModel->comments;
                    }
                }
            }
            $oAccountInsights = new Insights();
            $oAccountInsights->model_id = $oAccountModel->id;
            $oAccountInsights->followers = $user_data["counts"]["followed_by"];
            $oAccountInsights->gained_followers = 0;
            $oAccountInsights->lost_followers = 0;
            $oAccountInsights->follows = $user_data["counts"]["follows"];
            $oAccountInsights->number_of_posted_media = count($all_media);
            $oAccountInsights->total_likes = $total_photo_likes + $total_video_likes;
            $oAccountInsights->total_comments = $total_photo_comments + $total_video_comments;
            $oAccountInsights->save();
        }
        $this->saveRecentFollowers($oAccountModel->id, $oAccountModel->entity_id);
        $this->account_insights_in_range = $oAccountInsights;
        
        return $oAccountModel;
    }
    
    public function getTimeBasedMedia($parent_id, $since, $until){
        $this->media_in_range = Model::find()->where(['parent_id' => $parent_id, 'type' => self::POST])->andWhere(['between', 'creation_time', $since, $until])->all();
    }
    
    public function getTopPostsByEngagement(){
        
        if($this->media_in_range){
            $media_array = array();
            foreach($this->media_in_range as $key => $oMedia){
                if(!$oMedia->followers){
                   $media_array[$key] = 'N/A'; 
                }else{
                    $media_array[$key] = ((($oMedia->likes + $oMedia->comments)/($oMedia->followers))*100);
                }
            }
            krsort($media_array);
            $top_posts_by_eng = array();
            foreach($media_array as $key => $value){
                $top_posts_by_eng[] = ['id' => $this->media_in_range[$key]->id, 'engagement' => round($value, 2), 'likes' => $this->media_in_range[$key]->likes, 'comments' => $this->media_in_range[$key]->comments, 'link' => $this->media_in_range[$key]->url, 'media_url' => $this->media_in_range[$key]->media_url];  
            }
        }else{
            $top_posts_by_eng = null;
        }
        
        if($top_posts_by_eng && (count($top_posts_by_eng) > 10)){
            $top_ten_posts = array_slice($top_posts_by_eng, 0, 10);
            return $top_ten_posts;
        }
        return $top_posts_by_eng;
    }
    
    public function getTimeBasedAccountInsights($id, $since, $until){
		$since_str = date('Y-m-d H:i:s', $since);
		$until_str = date('Y-m-d H:i:s', $until);
        $this->account_insights_in_range = Insights::find()->Where(['model_id' => $id])->andWhere(['between', 'created', $since_str, $until_str])->orderBy(['id' => SORT_DESC])->all();
		return $this->account_insights_in_range;
    }
    
    public function getFollowersGainedAndLost($days_in_range){
        $followers_gained_lost = array();
        foreach($days_in_range as $day){
            if(is_array($this->account_insights_in_range)){
                foreach($this->account_insights_in_range as $account_insights){
                    if(date('M d', strtotime($account_insights->created)) == date('M d', $day)){
                       $followers_gained_lost[date('M d', $day)]['gained'] = $account_insights->gained_followers;
                       $followers_gained_lost[date('M d', $day)]['lost'] = $account_insights->lost_followers;
                    }
                } 
            }else{
                if(date('M d', strtotime($this->account_insights_in_range->created)) == date('M d', $day)){
                    $followers_gained_lost[date('M d', $day)]['gained'] = $this->account_insights_in_range->gained_followers;
                    $followers_gained_lost[date('M d', $day)]['lost'] = $this->account_insights_in_range->lost_followers;
                }
            }
            if(!array_key_exists(date('M d', $day), $followers_gained_lost)){
                $followers_gained_lost[date('M d', $day)]['gained'] = null;
                $followers_gained_lost[date('M d', $day)]['lost'] = null;
            }
        }
        return $followers_gained_lost;
    }
    
    public function getFollowersGainedAndLostJsonTable($days_in_range){
        $followers_gained_lost = $this->getFollowersGainedAndLost($days_in_range);
        $followers_gained_lost_json_table = ($followers_gained_lost) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'gained', 'lost', $followers_gained_lost, null, 'gained', 'lost') : '';
        return $followers_gained_lost_json_table;
    }
    
    public function getFollowersGrowth($days_in_range){
        $followers_growth = array();
        foreach($days_in_range as $day){
            if(is_array($this->account_insights_in_range)){
                foreach($this->account_insights_in_range as $account_insights){
                    //var_dump($account_insights->created); die;
                    if(date('M d', strtotime($account_insights->created)) == date('M d', $day)){
                       $followers_growth[date('M d', $day)] = $account_insights->followers;
                    }
                } 
            }else{
                if(date('M d', strtotime($this->account_insights_in_range->created)) == date('M d', $day)){
                       $followers_growth[date('M d', $day)] = $this->account_insights_in_range->followers;
                    }
            }
            if(!array_key_exists(date('M d', $day), $followers_growth)){
                $followers_growth[date('M d', $day)] = null;
            }
        }
        return $followers_growth;
    }
    
    public function getFollowersGrowthJsonTable($followers_growth){
        $followers_growth_json_table = ($followers_growth) ? InstagramGoogleChartHelper::getDataTable('day', 'followers', $followers_growth) : '';
        return $followers_growth_json_table;
    }
    
    public function getEngagementStatistics($model_id, $days_in_range, $since, $until){
       $this->getTimeBasedMedia($model_id, $since, $until);
        if(!empty($this->media_in_range)){
            $this->clearStatistics();
            $this->statistics['top_posts_by_engagement'] = $this->getTopPostsByEngagement();
            //$this->statistics['source_of_engagement'] = $this->sourceOfEngagement();
            
            foreach($days_in_range as $day){
                $day_formated = date('M d', $day);
                
                foreach($this->media_in_range as $media){
                    
                    if(date('M d', $media->creation_time) == $day_formated){
                        
                        if(!array_key_exists($day_formated, $this->statistics['profile'])){
                            $this->statistics["profile"][$day_formated]["amount"] = 1;
                            $this->statistics["profile"][$day_formated]["interaction"] = ($media->likes + $media->comments);
                            $this->statistics['profile'][$day_formated]['followers'] = $media->followers;
                        }else{
                            $this->statistics["profile"][$day_formated]["amount"]++;
                            $this->statistics["profile"][$day_formated]["interaction"] += ($media->likes + $media->comments); 
                        }
                        if($media->post_type == self::IMAGE){
                            if(array_key_exists($media->filter, $this->statistics['photo_filter'])){
                                $this->statistics['photo_filter'][$media->filter]['amount']++;
                                $this->statistics['photo_filter'][$media->filter]['interactions'] += ($media->likes + $media->comments);
                            }else{
                                $this->statistics['photo_filter'][$media->filter]['amount'] = 1;
                                $this->statistics['photo_filter'][$media->filter]['interactions'] = ($media->likes + $media->comments);
                            }
                            
                            if(array_key_exists($day_formated , $this->statistics['image'])){
                                $this->statistics['image'][$day_formated]["amount"]++;
                                $this->statistics['image'][$day_formated]["interaction"] += ($media->likes + $media->comments);
                            }else{
                                $this->statistics['image'][$day_formated]["amount"] = 1;
                                $this->statistics['image'][$day_formated]["interaction"] = ($media->likes + $media->comments);
                                if(!array_key_exists($day_formated, $this->statistics['video'])){
                                    $this->statistics['video'][$day_formated ]["amount"] = 0;
                                    $this->statistics['video'][$day_formated]["interaction"] = 0;
                                }
                            }
                            $this->statistics['total_posts_by_type']['photo']++;
                            $this->statistics['total_photo_likes'] += $media->likes;
                            $this->statistics['total_photo_comments'] += $media->comments;
                        }else{
                            if(array_key_exists($media->filter, $this->statistics['video_filter'])){
                                $this->statistics['video_filter'][$media->filter]['amount']++;
                                $this->statistics['video_filter'][$media->filter]['interactions'] += ($media->likes + $media->comments);
                            }else{
                                $this->statistics['video_filter'][$media->filter]['amount'] = 1;
                                $this->statistics['video_filter'][$media->filter]['interactions'] = ($media->likes + $media->comments);
                            }
                            if(array_key_exists($day_formated, $this->statistics['video'])){
                                $this->statistics['video'][$day_formated]["amount"]++;
                                $this->statistics['video'][$day_formated]["interaction"] += ($media->likes + $media->comments);
                            }else{
                                $this->statistics['video'][$day_formated]["amount"] = 1;
                                $this->statistics['video'][$day_formated]["interaction"] = ($media->likes + $media->comments);
                                if(!array_key_exists($day_formated, $this->statistics['image'])){
                                    $this->statistics['image'][$day_formated]["amount"] = 0;
                                    $this->statistics['image'][$day_formated]["interaction"] = 0;
                                }
                            }
                            $this->statistics['total_posts_by_type']['video']++;
                            $this->statistics['total_video_likes'] += $media->likes;
                            $this->statistics['total_video_comments'] += $media->comments;
                        }
                    }
                }
                if(!array_key_exists($day_formated, $this->statistics['profile'])){
                    $this->statistics['image'][$day_formated]['amount'] = $this->statistics['video'][$day_formated]['amount'] = 
                    $this->statistics['image'][$day_formated]['interaction'] = $this->statistics['video'][$day_formated]['interaction'] =
                    $this->statistics["profile"][$day_formated]["amount"] = $this->statistics["profile"][$day_formated]["interaction"] =
                    $this->statistics['profile'][$day_formated]['followers'] = $this->statistics['profile'][$day_formated]["profile_engagement"] =
                    $this->statistics['profile'][$day_formated]["post_engagement"] = 0;
                }else{
                    (($this->statistics['profile'][$day_formated]['interaction']) != 0) ? $this->statistics['days_with_engagement']++ : '';
                    $this->statistics["profile"][$day_formated]["profile_engagement"] = ((($this->statistics['profile'][$day_formated]['followers'] != 'N/A') && ($this->statistics['profile'][$day_formated]['followers'] != 0)) ? round(((($this->statistics["profile"][$day_formated]['interaction'])/($this->statistics['profile'][$day_formated]['followers']))*100), 2) : 0);
                    $this->statistics['profile'][$day_formated]["post_engagement"] = ((($this->statistics['profile'][$day_formated]['followers'] != 'N/A') && ($this->statistics['profile'][$day_formated]['followers'] != 0)) ? round(((($this->statistics["profile"][$day_formated]['interaction'])/($this->statistics['profile'][$day_formated]['amount'])/($this->statistics['profile'][$day_formated]['followers']))*100),2) : 0);
                    $this->statistics['total_post_engagement_rate'] += $this->statistics['profile'][$day_formated]["post_engagement"];
                    ($this->statistics['profile'][$day_formated]["post_engagement"] > $this->statistics['max_post_engagement_rate']) ? ($this->statistics['max_post_engagement_rate'] = $this->statistics['profile'][$day_formated]["post_engagement"]) : '';
                    $this->statistics['total_profile_engagement_rate'] += $this->statistics['profile'][$day_formated]["profile_engagement"];
                    ($this->statistics['profile'][$day_formated]["profile_engagement"] > $this->statistics['max_profile_engagement_rate']) ? ($this->statistics['max_profile_engagement_rate'] = $this->statistics['profile'][$day_formated]["profile_engagement"]) : '';
                }
            } 
            $this->statistics['total_posts'] = $this->statistics['total_posts_by_type']['photo'] + $this->statistics['total_posts_by_type']['video'];
            $this->statistics['avg_likes_per_post'] = (($this->statistics['total_photo_likes'] + $this->statistics['total_video_likes'])/($this->statistics['total_posts']));
            $this->statistics['avg_comments_per_post'] = (($this->statistics['total_photo_comments'] + $this->statistics['total_video_comments'])/($this->statistics['total_posts']));
            $this->statistics['total_interaction_by_post_type']['photo'] = $this->statistics['total_photo_likes'] + $this->statistics['total_photo_comments'];
            $this->statistics['total_interaction_by_post_type']['video'] = $this->statistics['total_video_likes'] + $this->statistics['total_video_comments'];
            $this->statistics['total_interaction'] = $this->statistics['total_interaction_by_post_type']['photo'] + $this->statistics['total_interaction_by_post_type']['video'];
            $this->statistics['avg_interaction_per_post'] = (($this->statistics['total_interaction_by_post_type']['photo'] + $this->statistics['total_interaction_by_post_type']['video'])/($this->statistics['days_with_engagement']));
            $this->statistics['avg_post_engagement_rate'] = ($this->statistics['days_with_engagement'] != 0) ? ($this->statistics['total_post_engagement_rate']/$this->statistics['days_with_engagement']) : 0;
            $this->statistics['avg_profile_engagement_rate'] = ($this->statistics['days_with_engagement'] != 0) ? ($this->statistics['total_profile_engagement_rate']/$this->statistics['days_with_engagement']) : 0;

        }else{
            $this->statistics = null;
        }
        return $this->statistics;
    }
    
    public function getBestTimeToPost($model_id, $since, $until){
        $this->getHoursArray(); 
        $this->getTimeBasedMedia($model_id, $since, $until);
        $hour = $this->hours;
        foreach($this->media_in_range as $media){
            $hour[date('ga', $media->creation_time)][date('D', $media->creation_time)] += ($media->likes + $media->comments);
        }
        return $hour;
    }
    
    public function getBestTimeToPostJsonTable($model_id, $since, $until){
        $best_time_to_post = $this->getBestTimeToPost($model_id, $since, $until);
        $best_time_to_post_json_table = InstagramGoogleChartHelper::getBestTimeToPost($best_time_to_post);
        return $best_time_to_post_json_table;
    }

    public function getNumberOfPostsJsonTable($statistics_image, $statistics_video){
        $posts_per_day_json_table = ($statistics_image && $statistics_video) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'image', 'video', $statistics_image, $statistics_video, 'amount', null) : '';
        return $posts_per_day_json_table;
    }
    
    public function getNumberOfInteractionsJsonTable($statistics_image, $statistics_video){
        $interactions_per_day_json_table = ($statistics_image && $statistics_video) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'image', 'video', $statistics_image, $statistics_video, 'interaction', null) : '';
        return $interactions_per_day_json_table;
    }
    
    public function getPostEngagementJsonTable($statistics_profile){
        $post_engagement_per_day_json_table = ($statistics_profile) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'post engagement', null, $statistics_profile, null, 'post_engagement', null) : '';
        return $post_engagement_per_day_json_table;
    }
    
    public function getProfileEngagementJsonTable($statistics_profile){
        $profile_engagement_per_day_json_table = ($statistics_profile) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('day', 'profile engagement', null, $statistics_profile, null, 'profile_engagement', null) : '';
        return $profile_engagement_per_day_json_table;
    }
    
    public function getPostTypesJsonTable($statistics_total_posts_by_type){
        $post_types_json_table = ($statistics_total_posts_by_type) ? InstagramGoogleChartHelper::getDataTable('post type', 'percentage', $statistics_total_posts_by_type) : '';
        return $post_types_json_table;
    }
    
    public function getMostEngagingPostTypesJsonTable($statistics_total_interaction_by_post_type){
        $most_engaging_post_types_json_table = ($statistics_total_interaction_by_post_type) ? InstagramGoogleChartHelper::getDataTable('interaction by post type', 'percentage', $statistics_total_interaction_by_post_type) : '';
        return $most_engaging_post_types_json_table;
    }
    
    public function getTagsInteractions($media_in_range){
        $tags_interactions = array();
        foreach($media_in_range as $media){
            $tags = explode(',', $media->tags);
            foreach($tags as $tag){
                if(!empty($tag)){
                    if(array_key_exists($tag, $tags_interactions)){
                        $tags_interactions[$tag] += ($media->likes + $media->comments);
                    }else{
                        $tags_interactions[$tag] = ($media->likes + $media->comments);
                    }
                }
            }
        }
        arsort($tags_interactions);
        return $tags_interactions;
    }
    
    public function getTagsInteractionsJsonTable(){
        $tags_interactions = $this->getTagsInteractions($this->media_in_range);
        $tags_interactions_json_table = ($tags_interactions) ? InstagramGoogleChartHelper::getDataTable('interaction', 'tag', $tags_interactions) : '';
        return $tags_interactions_json_table;
    }
    
    public function clearStatistics(){
        $this->statistics['profile'] = $this->statistics['image'] = $this->statistics['video'] = 
        $this->statistics['photo_filter'] = $this->statistics['video_filter'] = array();
        $this->statistics['total_photo_likes'] = $this->statistics['total_video_likes'] =
        $this->statistics['total_photo_comments'] = $this->statistics['total_video_comments'] =
        $this->statistics['total_posts'] = $this->statistics['avg_likes_per_post'] =
        $this->statistics['avg_comments_per_post'] = $this->statistics['total_interaction_by_post_type']['photo'] =
        $this->statistics['total_interaction_by_post_type']['video'] = $this->statistics['total_interaction'] =
        $this->statistics['avg_interaction_per_post'] = $this->statistics['avg_post_engagement_rate'] =
        $this->statistics['avg_profile_engagement_rate'] = $this->statistics['max_post_engagement_rate'] =
        $this->statistics['max_profile_engagement_rate'] = $this->statistics['total_posts_by_type']['photo'] =
        $this->statistics['total_posts_by_type']['video'] = $this->statistics['total_post_engagement_rate'] = 
        $this->statistics['days_with_engagement'] = $this->statistics['total_profile_engagement_rate'] = 0;
        //$this->statistics['top_posts_by_engagement'] = $this->statistics['source_of_engagement'] = null;
    }
    
    public function getRelationship($user_id){
        return $this->getClient()->api('users/'.$user_id.'/relationship');
    }
    
    public function sourceOfEngagement(){
        $engagement_source['not followers'] = $engagement_source['followers'] = 0;
        foreach($this->media_in_range as $media){
            $likes = $this->getMediaLikes($media->entity_id)['data'];
            $comments = $this->getMediaComments($media->entity_id)['data'];
            foreach($likes as $like){
                if(static::getRelationship($like['id'])['data']['incoming_status'] == 'followed_by'){
                    $engagement_source['followers']++;
                }else{
                    $engagement_source['not followers']++;
                }
            }
            foreach($comments as $comment){
                if(static::getRelationship($comment['from']['id'])['data']['incoming_status'] == 'followed_by'){
                    $engagement_source['followers']++;
                }else{
                    $engagement_source['not followers']++;
                }
            }
        }
        return $engagement_source;
    }
    
    public function getSourceOfEngagementJsonTable($source_of_engagement){
        $source_of_engagement_json_table = ($source_of_engagement) ? InstagramGoogleChartHelper::getDataTable('source of engagement', 'value', $source_of_engagement) : '';
        return $source_of_engagement_json_table;
    }
    
    public function getTopPhotoFiltersJsonTable($photo_filters){
        $top_photo_filters_json_table = ($photo_filters) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('photo filter', 'value', null, $photo_filters, null, 'amount', null) : '';
        return $top_photo_filters_json_table;
    }
    
    public function getMostEngagingPhotoFiltersJsonTable($photo_filters){
        $most_engaging_photo_filters_json_table = ($photo_filters) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('photo filter', 'value', null, $photo_filters, null, 'interactions', null) : '';
        return $most_engaging_photo_filters_json_table;
    }
    
    public function getTopVideoFiltersJsonTable($video_filters){
        $top_video_filters_json_table = ($video_filters) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('video filter', 'value', null, $video_filters, null, 'amount', null) : '';
        return $top_video_filters_json_table;
    }
    
    public function getMostEngagingVideoFiltersJsonTable($video_filters){
        $most_engaging_video_filters_json_table = ($video_filters) ? InstagramGoogleChartHelper::getInstagramDataTableUsingKeyName('video filter', 'value', null, $video_filters, null, 'interactions', null) : '';
        return $most_engaging_video_filters_json_table;
    }
	
	public function saveAccountInsights($oAccountModel){
            $user_data = $this->getUserData();
            $since = strtotime('first day of this month');
            $all_media = $this->getAllMedia($since);
            $total_photo_likes = $total_photo_comments = $total_video_likes = $total_video_comments = 0;
            foreach($all_media as $media){
		$oMedia = Model::findOne(['entity_id' => $media['id'], 'parent_id' => $oAccountModel->id]);
		if(!$oMedia){
                    if(($media['created_time']) >= $since){
                        $oMediaModel = $this->createNewMediaModel($oAccountModel, $user_data["counts"]["followed_by"], $media);
			if($oMediaModel->post_type == self::IMAGE){
                            $total_photo_likes += $oMediaModel->likes;
                            $total_photo_comments += $oMediaModel->comments;
			}else{
                            $total_video_likes += $oMediaModel->likes;
                            $total_video_comments += $oMediaModel->comments;
			}
                    }
		}else{
                    $oMediaModel = $this->updateMediaModel($oMedia, $media);
                    if($oMediaModel->post_type == self::IMAGE){
			$total_photo_likes += $oMediaModel->likes;
			$total_photo_comments += $oMediaModel->comments;
                    }else{
			$total_video_likes += $oMediaModel->likes;
			$total_video_comments += $oMediaModel->comments;
                    }
		}
                
            }
            $oAccountInsights = new Insights();
            $oAccountInsights->model_id = $oAccountModel->id;
            $oAccountInsights->followers = $user_data["counts"]["followed_by"];
            $oAccountInsights->gained_followers = 0;
            $oAccountInsights->lost_followers = 0;
            $oAccountInsights->follows = $user_data["counts"]["follows"];
            $oAccountInsights->number_of_posted_media = count($all_media);
            $oAccountInsights->total_likes = $total_photo_likes + $total_video_likes;
            $oAccountInsights->total_comments = $total_photo_comments + $total_video_comments;
            $oAccountInsights->save();
	}
	
	public function getUserIdUsingUserUrl($url){
		$name = substr($url, 26, -1);
		return $name;
	}
	
	public function getUserByUrl($url){
		$name = $this->getUserIdUsingUserUrl($url);
		$client = $this->getClient();
		$search = $client->api("users/search", 'GET', ["q" => $name]);
		$user_data = $this->getUserDataById($search["data"][0]["id"]);
		return $user_data;
	}
	
	public function getCompetitorNameAndFollowers($url){
		$user_data = $this->getUserByUrl($url);
		$page['followers'] = $user_data['counts']['followed_by'];
		$page['name'] = $user_data['username'];
		$page['id'] = $user_data['id'];
		return $page;
	}
	
}