<?php

namespace digi\authclient\clients;

use Yii;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;
use common\models\custom\CompChannels;
use common\models\custom\Competitors;

class Twitter extends \yii\authclient\clients\Twitter
{
    const ACCOUNT = 0;
    const POST = 1;
    const MENTION = 2;
    const REPLY = 3;
    const TWEET = 1;

    public $account_insights_in_range;
    public $days_in_range;


    /**
     * get array of days in the specified range of days 
     **/
    public function  getDaysInRange($from = null, $to = null){
        (!$from) ? ($from = strtotime('first day of this month')) : '';
        (!$to) ? ($to = time()) : '';
        $days_in_range[] = $from;
        $current = $from/*strtotime('+1 days', $from)*/;
        while($current <= $to){
            array_push($days_in_range, $current);
            $current = strtotime('+1 days', $current);
        }
        return $days_in_range;
    }
    
    public static function setClient($client){
        //if(!Yii::$app->session->get('twitter')){
            Yii::$app->session->set('twitter', $client);
        //}
    }

    public function getClient(){
        $client = Yii::$app->session->get('twitter');
        if(Yii::$app->session->get('twitter')){
            return Yii::$app->session->get('twitter');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getAccountData(){
        $client = $this->getClient();
        $user_data = $client->api("account/verify_credentials.json", 'GET');
        return $user_data;
    }
    
    public function getAccountDataById($id){
        $client = $this->getClient();
        $user_data = $client->api("users/show.json", 'GET', ['user_id' => $id]);
        return $user_data;
        
    }
	
    public function getScreenNameFromUrl($url){
	$name = substr($url, 20);
        $screen_name = explode('?', $name)[0];
	return $screen_name;
    }
	
  	
  	public function checkClientSession(){
    	if(Yii::$app->session['twitter']){
        	return $this->getClient();
        }else{
        	$oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'twitter']);
              if(! $oAuthclient ){
                  $oAuthclient = Authclient::findOne(['user_id' => 2, 'source' => 'twitter']);
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
                 Twitter::setClient( unserialize($oAuthclient->source_data));
                 $ReturnData = $this->getAccountData() ;
                  if( $ReturnData == null){
                      $oAuthclient->source_data =null;
                      $oAuthclient->save();
                      Twitter::setClient( null);
                  }
                  return $this->getClient();
              
          }
        }
    }
  
  
    public function getAccountDataByScreenName($name){
	$client = $this->checkClientSession();
        $user_data = $client->api("users/show.json", 'GET', ['screen_name' => $name]);
        return $user_data;
    }
	
    public function getCompetitorNamesAndFollowers($url){
      $screen_name = $this->getScreenNameFromUrl($url);
      $user_data = $this->getAccountDataByScreenName($screen_name);
      $page['name'] = $user_data["name"];
      $page['id'] = $user_data["id_str"];
      $page['followers'] = $user_data["followers_count"];
      $page['img_url'] = $user_data['profile_image_url'];
      return $page;
    }
    
 	public function updateCompetitorsValues(){
      	$competitors = Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
  		foreach($competitors as $oCompetitor){
        	$oTwitter = CompChannels::findOne(['comp_id' => $oCompetitor->id, 'comp_channel' => 'twitter']);
          	if($oTwitter){
            	$this->updateCompetitorValue($oTwitter);
            }
        }
  	}
    
 	public function updateCompetitorValue($oTwitter){
  		$page_data = $this->getAccountDataById($oTwitter->comp_channel_id);
      	if($page_data){
        	$oTwitter->comp_channel_followers = $page_data["followers_count"];
          	$oTwitter->update();
        }
  	}
  
    public function getAccountFollowers(){
        $client = $this->getClient();
        $followers = $client->api("followers/list.json",'GET',['count' => 200,'cursor' => -1, 'skip_status' => true, "include_user_entities" => false]);
        //echo '<pre>'; var_dump($followers); echo '</pre>'; die;
        return $followers;
    }
    
    public function getTheRestOfAccountFollowers($next_cursor){
        $client = $this->getClient();
        $followers = $client->api("followers/list.json",'GET',['count' => 200,'cursor' => $next_cursor, 'skip_status' => true, "include_user_entities" => false]);
        return $followers;
    }
    
    public function getAllUserFollowers(){
        $user_followers = $this->getAccountFollowers();
        $all_users = $user_followers["users"];
        for($i = 0; $i<=1 ; $i++){
            $user_followers = $this->getTheRestOfAccountFollowers($user_followers["next_cursor_str"]);
            $all_users += $user_followers["users"];
        }
//        while($user_followers["next_cursor_str"]){
//            $user_followers = $this->getTheRestOfAccountFollowers($user_followers["next_cursor_str"]);
//            $all_users += $user_followers["users"];
//        }
        return $all_users;
    }
    
    public function getAccountFollowersById($id){
        $client = $this->getClient();
        $followers = $client->api("followers/ids.json", 'GET',['count' => 200,'cursor' => -1, 'skip_status' => true, "include_user_entities" => false, 'user_id' => $id]);
        return $followers;
    }
    
    public function getTheRestOfAccountFollowersById($id, $next_cursor){
        $client = $this->getClient();
        $followers = $client->api("followers/ids.json",'GET',['count' => 200,'cursor' => $next_cursor, 'skip_status' => true, "include_user_entities" => false, 'user_id' => $id]);
        return $followers;
    }
    
    public function getAllUserFollowersById($id){
        $user_followers = $this->getAccountFollowersById($id);
        //echo '<pre>'; var_dump($user_followers); echo '</pre>'; die;
        $all_users = $user_followers["ids"];
        for($i = 0; $i<=1; $i++){
            $user_followers = $this->getTheRestOfAccountFollowersById($id, $user_followers["next_cursor_str"]);
            $all_users += $user_followers["ids"];
        }
//        while($user_followers["next_cursor_str"]){
//            $user_followers = $this->getTheRestOfAccountFollowersById($id, $user_followers["next_cursor_str"]);
//            $all_users += $user_followers["users"];
//        }
        return $all_users;
    }
    
    public function getTweet($id){
        $client = $this->getClient();
        $test_tweet = $client->api("statuses/show.json", 'GET', ['id' => $id]);
        return $test_tweet;
    }
    
    public function getAccountTweets(){
        $client = $this->getClient();
        $tweets = $client->api("statuses/user_timeline.json",'GET',['count' => 200, 'skip_status' => true, 'include_rts' => false, 'exclude_replies' => true]);
        return $tweets;
    }
    
    public function getTheRestOfAccountTweets($max_id){
        $client = $this->getClient();
        $tweets = $client->api("statuses/user_timeline.json",'GET',['count' => 200, 'skip_status' => true, 'include_rts' => false, 'exclude_replies' => true, 'max_id' => $max_id]);
        return $tweets;
    }
    
    public function getAllAccountTweets(){
        $all_tweets = $tweets_data = $this->getAccountTweets();
//        $last_entry = $tweets_data[count($tweets_data)-1];
//        $last_entry_id = $last_entry["id_str"];
//        $counter = 1;
//        while(!(($counter >= 3) && (count($tweets_data) == 1) && (strtotime($last_entry['created_at']) < strtotime(date('Y-07-01', time()))))){
//            //sleep(5);
//            $tweets_data = $this->getTheRestOfAccountTweets($last_entry_id);
//            $counter++;
//            $last_entry = array_pop($tweets_data);
//            $last_entry_id = $last_entry["id_str"];
//            $all_tweets = array_merge($all_tweets, $tweets_data);
//        }
        return $all_tweets;
    }
    
    public function getAccountRetweets(){
        $client = $this->getClient();
        $retweets = $client->api('/statuses/retweets_of_me.json', 'GET', ['count' => 200]);
        return $retweets;
    }
  
    public function getTheRestOfAccountRetweets($max_id){
        $client = $this->getClient();
        $retweets = $client->api("statuses/retweets_of_me.json",'GET',['count' => 200, 'max_id' => $max_id]);
        return $retweets;
    }
    
    public function getAllAccountRetweets(){
        $all_retweets = $retweets_data = $this->getAccountRetweets();
        $last_entry = $retweets_data[count($retweets_data)-1];
        $last_entry_id = $last_entry["id_str"];
//        $counter = 1;
//        while(!(($counter >= 8) && (count($retweets_data) == 1) && (strtotime($last_entry['created_at']) < strtotime(date('Y-07-01', time()))) &&  ($retweets_data[0]["id_str"] == $last_entry))){
//            $retweets_data = $this->getTheRestOfAccountRetweets($last_entry_id);
//            $counter++;
//            $last_entry = array_shift($retweets_data);
//            $last_entry_id = $last_entry["id_str"];
//            $all_retweets += $retweets_data;
//        }
        return $all_retweets;
    }

    public function getAccountMentions(){
        $client = $this->getClient();
        $mentions = $client->api("statuses/mentions_timeline.json",'GET',['count' => 200, 'skip_status' => true]);
        return $mentions;
    }
    
    public function getTheRestOfAccountMentions($max_id){
        $client = $this->getClient();
        $mentions = $client->api("statuses/mentions_timeline.json",'GET',['count' => 200, 'skip_status' => true, 'max_id' => $max_id]);
        return $mentions;
    }
    
    public function getAllAccountMentions(){
        $all_mentions = $mentions_data = $this->getAccountMentions();
        //echo '<pre>'; var_dump($all_mentions); echo '</pre>'; die;
        $last_entry = $mentions_data[count($mentions_data)-1];
        $last_entry_id = $last_entry["id_str"];
//        $counter = 1;
//        echo $counter;
////        echo 'last entry created time in date : '.date('Y-m-d', strtotime($last_entry['created_at'])). ' and in timestamp : '.strtotime($last_entry['created_at']);
////        echo 'first day of that month in date : '.date('Y-m-d', strtotime(date('Y-07-01', time()))). ' and in timestamp : '.strtotime(date('Y-07-01', time())); die;
//        while(!(($counter >= 8) && (count($mentions_data) <= 1) && (strtotime($last_entry['created_at']) < strtotime(date('Y-07-01', time()))))){
//            $mentions_data = $this->getTheRestOfAccountMentions($last_entry_id);
//            $counter++;
//            echo $counter;
//            $last_entry = array_pop($mentions_data);
//            $last_entry_id = $last_entry["id_str"];
//            $all_mentions = array_merge($all_mentions, $mentions_data);
////            $counter++;
//        }
        return $all_mentions;
    }
    
    public function getTweetTags($tags_array){
        $tags = [];
        foreach($tags_array as $tag){
            array_push($tags, $tag['text']);
        }
        return implode(',', $tags);
    }
    
    public function firstLogNewTweetModel($oAccountModel, $tweet){
        $today = strtotime(date('d-m-Y', time()));
        $oTweetModel = new Model();
        $oTweetModel->authclient_id = $oAccountModel->authclient_id;
        $oTweetModel->parent_id = $oAccountModel->id;
        $oTweetModel->entity_id = $tweet["id_str"];
        $oTweetModel->type = self::POST;
        $oTweetModel->content = $tweet["text"];
        $oTweetModel->likes = $tweet["favorite_count"];
        $oTweetModel->shares = $tweet["retweet_count"];
        $comments = Model::find()->andWhere([/*'parent_id' => $oAccountModel->id ,*/'in_reply_to_id' => $tweet["id_str"]])->all();
        $oTweetModel->comments = count($comments);
	$oTweetModel->interactions = ($oTweetModel->likes + $oTweetModel->shares + $oTweetModel->comments);
        $oTweetModel->followers = (strtotime($tweet["created_at"]) >= $today) ? $tweet['user']['followers_count'] :  null;
        $oTweetModel->creation_time = strtotime($tweet["created_at"]);
	$oTweetModel->media_url = (array_key_exists('media', $tweet['entities'])) ? $tweet['entities']['media'][0]['media_url_https'] : null;
        $oTweetModel->url = 'https://twitter.com/'.$oAccountModel->name.'/status/'.$tweet['id_str'];
        $oTweetModel->source = strip_tags($tweet['source']);
        
        $oTweetModel->tags = (!empty($tweet['entities']['hashtags'])) ? $this->getTweetTags($tweet['entities']['hashtags']) : null;
        if(!$oTweetModel->save()){
            echo 'error saving first log new tweet model'; die;
        }
        return $oTweetModel;
    }
    
    public function createNewTweetModel($oAccountModel, $tweet){
        $oTweetModel = new Model();
        $oTweetModel->authclient_id = $oAccountModel->authclient_id;
        $oTweetModel->parent_id = $oAccountModel->id;
        $oTweetModel->entity_id = $tweet["id_str"];
        $oTweetModel->type = self::POST;
        $oTweetModel->post_type = self::TWEET;
        $oTweetModel->content = $tweet["text"];
        $oTweetModel->likes = $tweet["favorite_count"];
        $oTweetModel->shares = $tweet["retweet_count"];
        $comments = Model::find()->andWhere(['parent_id' => $oAccountModel->id ,'in_reply_to_id' => $tweet["id_str"]])->all();
        $oTweetModel->comments = ($comments)? count($comments) : 0;
		$oTweetModel->interactions = ($oTweetModel->likes + $oTweetModel->shares + $oTweetModel->comments);
        $oTweetModel->followers = $tweet['user']['followers_count'];
        $oTweetModel->creation_time = strtotime($tweet["created_at"]);
        $oTweetModel->url = 'https://twitter.com/'.$oAccountModel->name.'/status/'.$tweet['id_str'];
		$oTweetModel->media_url = (array_key_exists('media', $tweet['entities'])) ? $tweet['entities']['media'][0]['media_url_https'] : null;
        $oTweetModel->source = strip_tags($tweet['source']);
        $oTweetModel->tags = (!empty($tweet['entities']['hashtags'])) ? $this->getTweetTags($tweet['entities']['hashtags']) : null;
        if(!$oTweetModel->save()){
            echo 'error saving first log new tweet model'; die;
        }
        return $oTweetModel;
    }
    
	public function updateTweetModel($oTweetModel, $tweet){
		$oTweetModel->likes = $tweet["favorite_count"];
        $oTweetModel->shares = $tweet["retweet_count"];
        $comments = Model::find()->andWhere(['parent_id' => $oTweetModel->parent_id ,'in_reply_to_id' => $tweet["id_str"]])->all();
        $oTweetModel->comments = ($comments)? count($comments) : 0;
		$oTweetModel->interactions = ($oTweetModel->likes + $oTweetModel->shares + $oTweetModel->comments);
		$oTweetModel->save();
	}
	
    public function createNewMentionModel($oAccountModel, $mention){
        $oMentionModel = new Model();
        $oMentionModel->authclient_id = $oAccountModel->authclient_id;
        $oMentionModel->parent_id = $oAccountModel->id;
        $oMentionModel->entity_id = $mention["id_str"];
        $oMentionModel->type = self::POST;
        $oMentionModel->post_type = ($mention["in_reply_to_status_id_str"] && ($mention["in_reply_to_user_id_str"] == $oAccountModel->authclient_id)) ? self::REPLY : self::MENTION;
        $oMentionModel->in_reply_to_id = $mention["in_reply_to_status_id_str"];
        $oMentionModel->creation_time = strtotime($mention["created_at"]);
        $oMentionModel->url = 'https://twitter.com/'.$mention["user"]["screen_name"].'/status/'.$mention["id_str"];
        $oMentionModel->source = strip_tags($mention["source"]);
        $oMentionModel->content = $mention["text"];
        if(!$oMentionModel->save()){
            echo 'error saving mention model'; die;
        }
        return $oMentionModel;
    }
    public function createAccountInsights($oAccountModel, $user_data, $total_retweets, $total_replies, $total_favourites, $total_mentions, $sources){
        $oAccountInsights = new Insights();
        $oAccountInsights->model_id = $oAccountModel->id;
        $oAccountInsights->followers = $user_data['followers_count'];
        $oAccountInsights->follows = $user_data['friends_count'];
        $oAccountInsights->listed = $user_data['listed_count'];
        $media_today = Model::find()->Where(['parent_id' => $oAccountModel->id, 'type' => self::POST])->andWhere(['between', 'creation_time', strtotime('yesterday'), time()])->all();
        $oAccountInsights->number_of_posted_media = count($media_today);
        $oAccountInsights->total_likes = $total_favourites;
        $oAccountInsights->total_comments = $total_replies;
        $oAccountInsights->total_shares = $total_retweets;
        $oAccountInsights->total_mentions = $total_mentions;
        $oAccountInsights->total_interactions = ($total_favourites + $total_replies + $total_retweets + $total_mentions);
		$oAccountInsights->insights_json = $sources;
		//echo '<pre>'; var_dump($oAccountInsights->validate()); echo '</pre>'; die;
        if(!$oAccountInsights->save()){
            echo 'error saving account insights model'; die;
        }
        return $oAccountInsights;
    }
    
    public function firstTimeToLog($user_data, $authclient_id){
        $oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $user_data["id_str"];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $user_data["screen_name"];
        $oAccountModel->media_url = $user_data["profile_image_url"];
        //$oAccountModel->likes = $user_data["favourites_count"];
        $oAccountModel->creation_time = strtotime($user_data["created_at"]);
        $oAccountModel->url = $user_data["url"];
        if($oAccountModel->save()){
            $all_mentions = $this->getAllAccountMentions();
            foreach($all_mentions as $mention){
                $oMentionModel = Model::findOne(['entity_id' => $mention['id_str']]);
                if(!$oMentionModel){
                    $oMentionModel = $this->createNewMentionModel($oAccountModel, $mention); 
                }
            }
            $all_tweets = $this->getAllAccountTweets();
            $total_replies = $total_retweets = $total_favourites = 0;
            foreach($all_tweets as $tweet){
                $oTweetModel = Model::findOne(['entity_id' => $tweet['id_str']]);
                if(!$oTweetModel){
                    $oTweetModel = $this->firstLogNewTweetModel($oAccountModel, $tweet);
                }
                $total_retweets += $oTweetModel->shares;
                $total_replies += $oTweetModel->comments;
                $total_favourites += $oTweetModel->likes;
            }
            $sources = json_encode($this->getInteractionsSources($all_tweets, $all_mentions));
            $oAccountInsights = $this->createAccountInsights($oAccountModel, $user_data, $total_retweets, $total_replies, $total_favourites, count($all_mentions), $sources, 0, 0);
            return $oAccountModel;
        }else{
            echo 'error saving account model'; die;
        }
        echo '<pre>'; var_dump($oAccountInsights); echo '</pre>'; die; 
    }
    
    public function getTwitterAccounts(){
        $accounts = Model::find()->andWhere(['parent_id' => null, 'type' => self::ACCOUNT])->joinWith('authclient')->andWhere(['authclient.source' => 'twitter'])->all();
        return $accounts;
    }
 
//    public function getMentionsBySearch(){
//        $client = $this->getClient();
//        $search_result = $client->api("search/tweets.json", 'GET', ['q' => "%40dou_lphi", 'count' => 2, 'since_id' => '591407240785096705']);
//        echo '<pre>'; var_dump($search_result); echo '</pre>'; die;
//        return $search_result;
//    }

    public function getRecentAccountMentions($parent_id = 233, $max_id = null){
        $client = $this->getClient();
        if(!$max_id){
            $last_mention_entry = Model::findOne(['parent_id' => $parent_id, 'type' => self::MENTION ]);
            ($last_mention_entry) ? ($max_id = $last_mention_entry->entity_id) : ($max_id = null);
        }
        if($max_id){
            $recent_mentions = $client->api("statuses/mentions_timeline.json",'GET',['count' => 2, 'skip_status' => true, 'max_id' => $max_id]);
            array_shift($recent_mentions);
        }else{
            $recent_mentions = null;
        }
        return $recent_mentions;
    }
    
    public function getAllRecentAccountMentions($parent_id = 233){
        $client = $this->getClient();
        $all_recent_mentions = $this->getRecentAccountMentions();
        if($all_recent_mentions && !empty($all_recent_mentions)){
            $recent_mentions = $client->api("statuses/mentions_timeline.json",'GET',['count' => 5, 'skip_status' => true, 'max_id' => $all_recent_mentions[count($all_recent_mentions)-1]['id_str']]);
            for($i=0; $i<=2; $i++){
                
                $all_recent_mentions += $recent_mentions;
                
                $recent_mentions = $client->api("statuses/mentions_timeline.json",'GET',['count' => 5, 'skip_status' => true, 'max_id' => $all_recent_mentions[count($all_recent_mentions)-1]['id_str']]);
            }echo '<pre>Recent Mentions :'; var_dump($all_recent_mentions); echo '</pre>'; die;
            while(/*$recent_mentions* && */!empty($recent_mentions)){
                $all_recent_mentions += $recent_mentions;
                $recent_mentions = $client->api("statuses/mentions_timeline.json",'GET',['count' => 5, 'skip_status' => true, 'max_id' => $all_recent_mentions[count($all_recent_mentions)-1]['id_str']]);
            }
        }
        return $all_recent_mentions;
    }
    
    public function everydayCron(){
        $accounts = $this->getTwitterAccounts();
        foreach($accounts as $oAccountModel){
            $userData = $this->getAccountDataById($oAccountModel->entity_id);
//            $all_mentions = $this->getAllAccountMentionsById($id);
//            foreach($all_mentions as $mention){
//                $oMentionModel = Model::findOne(['entity_id' => $mention['id_str']]);
//                if(!$oMentionModel){
//                    $oMentionModel = $this->createNewMentionModel($oAccountModel, $mention);
//                }
//            }
            $all_tweets = $this->getAllAccountTweets();
            $total_comments = $total_shares = 0;
            foreach($all_tweets as $tweet){
                $oTweetModel = Model::findOne(['entity_id' => $tweet['id_str']]);
                if(!$oTweetModel){
                    $oTweetModel = $this->createNewTweetModel($oAccountModel, $tweet);
                }
                $total_shares += $oTweetModel->shares;
                $total_comments += $oTweetModel->comments;
            }
			$sources = json_encode($this->getInteractionsSources($all_tweets, $all_mentions));
            $oAccountInsights = $this->createAccountInsights($oAccountModel, $user_data, $total_shares, $total_comments, count($all_mentions), $sources, 0, 0);
        }
    }
    
    public function afterLogin(){
        //Continue saving new mentions, and updating tweets' total_comments and account insights
        $this->getAllRecentAccountMentions($parent_id = 233);
        
    }
        
    public function getTimeBasedAccountInsights($id, $since = null, $until = null){
        $since = (!$since) ? ($since = date('Y-m-d H:i:s', strtotime('first day of this month'))) : (date('Y-m-d H:i:s', $since));
        $until = (!$until) ? ($until = date('Y-m-d H:i:s', strtotime('+ 1 day', time()))) : (date('Y-m-d H:i:s', strtotime('+ 1 day', $until)));
        $this->account_insights_in_range = Insights::find()->where(['model_id' => $id])->andWhere(['between', 'created', $since, $until])->all();
        return ($this->account_insights_in_range) ? $this->account_insights_in_range : null;
    }
   
    public function getTimeBasedMedia($id, $since, $until){
        $since_str = (!$since) ? date('Y-m-d H:i:s', strtotime('first day of this month')) : date('Y-m-d H:i:s', $since);
        $until_str = (!$until) ? date('Y-m-d H:i:s', time()) : date('Y-m-d H:i:s', $until);
      	//$since_str = date('Y-m-d H:i:s', $since);
        //$until_str = date('Y-m-d H:i:s', $until) ;
        $media_in_range = Model::find()->where(['parent_id' => $id, 'post_type' => self::TWEET])->andWhere(['between', 'created', $since_str, $until_str])->all();
      //var_dump($since_str); die;
        return $media_in_range;
    }
    
    public function getTimeBasedMentionsAndReplies($id, $since = null, $until = null){
        (!$since) ? ($since = strtotime('first day of this month')) : '';
        (!$until) ? ($until = time()) : '';
        $mentions_replies_in_range = Model::find()->where(['parent_id' => $id, 'post_type' => [self::MENTION, self::REPLY]])->andWhere(['between', 'creation_time', $since, $until])->all();
        return $mentions_replies_in_range;
    }
    
    public function getFollowersGrowth($days_in_range){
        $followers_growth = array();
        foreach($days_in_range as $day){
          $day_formated = date('d M, y', $day);
          //$date_day = date('M d', $day);
          //$refine_date = date('d', $day);
          //$date = ($refine_date != '01') ?  $refine_date : $date_day;
            if(is_array($this->account_insights_in_range)){
                foreach($this->account_insights_in_range as $account_insights){
                    //var_dump($account_insights->created); die;
                    if(date('d M, y', strtotime($account_insights->created)) == $day_formated){
                       $followers_growth[$day] = $account_insights->followers;
                    }
                } 
            }else{
                if(date('d M, y', strtotime($this->account_insights_in_range->created)) == $day_formated){
                       $followers_growth[$day] = $this->account_insights_in_range->followers;
                    }
            }
            if(!array_key_exists($day, $followers_growth)){
                $followers_growth[$day] = null;
            }
        }
      
        return $followers_growth;
    }
    
    public function getFollowersGrowthJsonTable($followers_growth){
        $followers_growth_json_table = ($followers_growth) ? InstagramGoogleChartHelper::getRegularTimeDataTable('day', 'followers', $followers_growth) : '';
        return $followers_growth_json_table;
    }
    
    public function getFollowingGrowth($days_in_range){
        $following_growth = array();
        foreach($days_in_range as $day){
          $day_formated = date('d M, y', $day);
          //$date_day = date('M d', $day);
          //$refine_date = date('d', $day);
          //$date = ($refine_date != '01') ?  $refine_date : $date_day;
            if(is_array($this->account_insights_in_range)){
                foreach($this->account_insights_in_range as $account_insights){
                    if(date('d M, y', strtotime($account_insights->created)) == $day_formated){
                       $following_growth[$day] = $account_insights->follows;
                    }
                } 
            }else{
                if(date('d M, y', strtotime($this->account_insights_in_range->created)) == $day_formated){
                       $following_growth[$day] = $this->account_insights_in_range->follows;
                    }
            }
            if(!array_key_exists($day, $following_growth)){
                $following_growth[$day] = null;
            }
        }
      
        return $following_growth;
    }
    
    public function getFollowingGrowthJsonTable($following_growth){
        $following_growth_json_table = ($following_growth) ? InstagramGoogleChartHelper::getRegularTimeDataTable('day', 'following', $following_growth) : '';
        return $following_growth_json_table;
    }
    
    public function getListedGrowth($days_in_range){
        $listed_growth = array();
        foreach($days_in_range as $day){
          $day_formated = date('d M, y', $day);
          //$date_day = date('M d', $day);
          //$refine_date = date('d', $day);
          //$date = ($refine_date != '01') ?  $refine_date : $date_day;
            if(is_array($this->account_insights_in_range)){
                foreach($this->account_insights_in_range as $account_insights){
                    if(date('d M, y', strtotime($account_insights->created)) == $day_formated){
                       $listed_growth[$day] = $account_insights->listed;
                    }
                } 
            }else{
                if(date('d M, y', strtotime($this->account_insights_in_range->created)) == $day_formated){
                       $listed_growth[$day] = $this->account_insights_in_range->listed;
                    }
            }
            if(!array_key_exists($day, $listed_growth)){
                $listed_growth[$day] = null;
            }
        }
        return $listed_growth;
    }
    
    public function getListedGrowthJsonTable($listed_growth){
        $listed_growth_json_table = ($listed_growth) ? InstagramGoogleChartHelper::getRegularTimeDataTable('day', 'listed', $listed_growth) : '';
        return $listed_growth_json_table;
    }

    public function calculateStatistics(){
        
    }
    
    public function test(){
        $tweets = $this->getAllAccountTweets();
        $today = strtotime(date('d-m-Y', time()));
        $oTweetModel = new Model();
        $oTweetModel->authclient_id = 90;
        $oTweetModel->parent_id = 1058;
        $oTweetModel->entity_id = $tweets[0]["id_str"];
        $oTweetModel->type = self::POST;
        $oTweetModel->content = $tweets[0]["text"];
        $oTweetModel->likes = $tweets[0]["favorite_count"];
        $oTweetModel->shares = $tweets[0]["retweet_count"];
        $comments = Model::find()->andWhere(['parent_id' => 1058 ,'in_reply_to_id' => $tweets[0]["id_str"]])->all();
        $oTweetModel->comments = count($comments);
        $oTweetModel->followers = (strtotime($tweets[0]["created_at"]) >= $today) ? $tweets[0]['user']['followers_count'] :  null;
        $oTweetModel->creation_time = strtotime($tweets[0]["created_at"]);
        //$oTweetModel->url = 'https://twitter.com/'.$oAccountModel->name.'/status/'.$tweets[0]['id_str'];
        $oTweetModel->source = strip_tags($tweets[0]['source']);
        
        $oTweetModel->tags = (!empty($tweets[0]['entities']['hashtags'])) ? $this->getTweetTags($tweets[0]['entities']['hashtags']) : null;
        if(!$oTweetModel->save()){
            var_dump($oTweetModel); die;
            echo 'error saving first log new tweet model'; die;
        }
        return $oTweetModel;
    }
    
    public function sourceOfEngagement($mentions_replies){
        $source = [];
        foreach($mentions_replies as $mention_reply){
            $source_type = strip_tags($mention_reply->source);
            if(array_key_exists($source_type, $source)){
                $source[$source_type]++;
            }else{
                $source[$source_type] = 1;
            }
        }
        return $source;
    }
    
    public function tagsInteractions($tweet_in_range){
        $tags = [];
        foreach($tweet_in_range as $tweet){
            if($tweet->tags){
                $tweet_tags = explode(",", $tweet->tags);
                foreach($tweet_tags as $tag){
                    if(array_key_exists($tag, $tags)){
                        $tags[$tag] += $tweet->interactions;
                    }else{
                        $tags[$tag] = $tweet->interactions;
                    }
                }
            }
        }
        arsort($tags);
        return $tags;
    }
    
    public function getTopPostsByEngagement($media_in_range){
        if($media_in_range){
            $media_array = array();
            foreach($media_in_range as $key => $oMedia){
                if(!$oMedia->followers){
                   $media_array[$key] = 'N/A'; 
                }else{
                    $media_array[$key] = ((($oMedia->interactions)/($oMedia->followers))*1000);
                }
            }
            rsort($media_array);
            $top_posts_by_eng = array();
            foreach($media_array as $key => $value){
                $top_posts_by_eng[] = ['id' => $media_in_range[$key]->id, 'engagement' => round($value, 2), 'favourites' => $media_in_range[$key]->likes, 'replies' => $media_in_range[$key]->comments, 'retweets' => $media_in_range[$key]->shares, 'media_url' => $media_in_range[$key]->media_url, 'url' => $media_in_range[$key]->url, 'content' => $media_in_range[$key]->content, 'oPost' => $media_in_range[$key]];  
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
    
    public function getMentionsPerDay($mentions, $days_in_range){
        $mentions_per_day = []; $mentions_per_day['profile'] = [];
        $mentions_per_day['total_mentions'] = 0;
        if($mentions){
            foreach($days_in_range as $day){
                $day_formated = date('d M, y', $day);
                //$day_formated_without_year = date('d M', $day);
                foreach($mentions as $mention){
                    if(date('d M, y', $mention->creation_time) == $day_formated){
                        if(!array_key_exists($day, $mentions_per_day['profile'])){
                            $mentions_per_day['profile'][$day] = 1;
                        }else{
                            $mentions_per_day['profile'][$day]++;
                        }
                        $mentions_per_day['total_mentions']++;
                    }
                }
                if(!array_key_exists($day, $mentions_per_day['profile'])){
                    $mentions_per_day['profile'][$day]["amount"] = 0;
                }
            }
            $mentions_per_day['avg_mentions_per_day'] = round((($mentions_per_day['total_mentions'])/30), 2);
            return $mentions_per_day;
        }else{
            return null;
        }
    }
    
    public function getMentionsPerDayJsonTable($mentions_per_day){
        $mentions_per_day_json_table = ($mentions_per_day) ? GoogleChartHelper::getRegularTimeDataTable('day', 'mentions', $mentions_per_day) : '';
      //echo '<pre>'; var_dump($mentions_per_day_json_table); echo '</pre>'; die;
        return $mentions_per_day_json_table;
    }
    
    public function getEngagementStatistics($model_id, $days_in_range, $since, $until){
        $statistics = []; $statistics['profile'] = []; 
        $statistics['total_post_engagement_rate'] = $statistics['max_post_engagement_rate'] = $statistics['total_profile_engagement_rate'] = 
        $statistics['max_profile_engagement_rate'] = $statistics['days_with_engagement'] = 0;
        $media_in_range = $this->getTimeBasedMedia($model_id, $since, $until);
		//$this->saveInteractions($media_in_range);
        $statistics['tags_interactions'] = $this->tagsInteractions($media_in_range);
        $mentions_replies = $this->getTimeBasedMentionsAndReplies($model_id, $since, $until);
        $statistics['mentions_per_day'] = $this->getMentionsPerDay($mentions_replies, $days_in_range);
      	//if($media_in_range){
        //if(!empty($media_in_range)){
            $statistics['top_posts_by_engagement'] = $this->getTopPostsByEngagement($media_in_range);
            ($mentions_replies) ? ($statistics['source_of_engagement'] = $this->sourceOfEngagement($mentions_replies)) : '';
            $statistics['total_posts'] = $statistics['interactions']['likes'] = $statistics['interactions']['replies'] = $statistics['interactions']['retweets'] = 0;
            foreach($days_in_range as $day){
                $day_formated = date('d M, y', $day);
                //$date_day = date('M d', $day);
              	//$refine_date = date('d', $day);
              	//$date = ($refine_date != '01') ?  $refine_date : $date_day;
                foreach($media_in_range as $media){
                    
                    if(date('d M, y', $media->creation_time) == $day_formated){
                        
                        if(!array_key_exists($day, $statistics['profile'])){
                            $statistics["profile"][$day]["amount"] = 1;
                            $statistics["profile"][$day]["interaction"] = $media->interactions;
                            $statistics['profile'][$day]['followers'] = $media->followers;
                        }else{
                            $statistics["profile"][$day]["amount"]++;
                            $statistics["profile"][$day]["interaction"] += $media->interactions; 
                        }
                        $statistics['total_posts']++;
                        $statistics['interactions']['likes'] += $media->likes;
                        $statistics['interactions']['replies'] += $media->comments;
                        $statistics['interactions']['retweets'] += $media->shares;
                    }
                }
                if(!array_key_exists($day, $statistics['profile'])){
                    $statistics["profile"][$day]["amount"] = $statistics["profile"][$day]["interaction"] =
                    $statistics['profile'][$day]['followers'] = $statistics['profile'][$day]["profile_engagement"] =
                    $statistics['profile'][$day]["post_engagement"] = 0;
                }else{
                    (($statistics['profile'][$day]['interaction']) != 0) ? $statistics['days_with_engagement']++ : '';
                    $statistics["profile"][$day]["profile_engagement"] = ((($statistics['profile'][$day]['followers'] != 'N/A') && ($statistics['profile'][$day]['followers'] != 0)) ? round(((($statistics["profile"][$day]['interaction'])/($statistics['profile'][$day]['followers']))*100), 2) : 0);
                    $statistics['profile'][$day]["post_engagement"] = ((($statistics['profile'][$day]['followers'] != 'N/A') && ($statistics['profile'][$day]['followers'] != 0)) ? round(((($statistics["profile"][$day]['interaction'])/($statistics['profile'][$day]['amount'])/($statistics['profile'][$day]['followers']))*100),2) : 0);
                    $statistics['total_post_engagement_rate'] += $statistics['profile'][$day]["post_engagement"];
                    ($statistics['profile'][$day]["post_engagement"] > $statistics['max_post_engagement_rate']) ? ($statistics['max_post_engagement_rate'] = $statistics['profile'][$day]["post_engagement"]) : '';
                    $statistics['total_profile_engagement_rate'] += $statistics['profile'][$day]["profile_engagement"];
                    ($statistics['profile'][$day]["profile_engagement"] > $statistics['max_profile_engagement_rate']) ? ($statistics['max_profile_engagement_rate'] = $statistics['profile'][$day]["profile_engagement"]) : '';
                }
            }
              //echo '<pre>'; var_dump($statistics['profile']); echo '</pre>'; die;
            $statistics['avg_favourites_per_post'] = ($statistics['total_posts'] != 0) ? (($statistics['interactions']['likes'])/($statistics['total_posts'])) : 0;
            $statistics['avg_replies_per_post'] = ($statistics['total_posts'] != 0) ? (($statistics['interactions']['replies'])/($statistics['total_posts'])) : 0;
            $statistics['avg_retweets_per_post'] = ($statistics['total_posts'] != 0) ? (($statistics['interactions']['retweets'])/($statistics['total_posts'])) : 0;
            $statistics['total_interaction'] = $statistics['interactions']['likes'] + $statistics['interactions']['replies'] + $statistics['interactions']['retweets'];
            $statistics['avg_interaction_per_day'] = ($statistics['days_with_engagement'] != 0) ? (($statistics['total_interaction'])/($statistics['days_with_engagement'])) : 0;
            $statistics['avg_post_engagement_rate'] = ($statistics['days_with_engagement'] != 0) ? ($statistics['total_post_engagement_rate']/$statistics['days_with_engagement']) : 0;
            $statistics['avg_profile_engagement_rate'] = ($statistics['days_with_engagement'] != 0) ? ($statistics['total_profile_engagement_rate']/$statistics['days_with_engagement']) : 0;
	//echo '<pre>'; var_dump($statistics); echo '</pre>'; die;
       /* }else{
            $statistics = null;
        }*/
        return $statistics;
    }
    
    public function getNumberOfTweetsJsonTable($tweets_per_day){
        $tweets_per_day_json_table = ($tweets_per_day) ? InstagramGoogleChartHelper::getKeyValueDataTableWithValueKeyNameTime('day', 'tweet', $tweets_per_day, 'amount') : '';
        return $tweets_per_day_json_table;
    }
    
    public function getNumberOfTweetsInteractionsPerDayJsonTable($tweets_per_day){
        $tweets_interactions_per_day_json_table = ($tweets_per_day) ? InstagramGoogleChartHelper::getKeyValueDataTableWithValueKeyNameTime('day', 'tweet', $tweets_per_day, 'interaction') : '';
        return $tweets_interactions_per_day_json_table;
    }
    
    public function getInteractionsByTypeJsonTable($interactions){
        $interactions_by_type_json_table = ($interactions) ? InstagramGoogleChartHelper::getDataTable('interaction', 'type', $interactions) : '';
        return $interactions_by_type_json_table;
    }
    
    public function getTagsInteractionsJsonTable($tags_interactions){
        $tags_interactions_json_table = ($tags_interactions) ? InstagramGoogleChartHelper::getDataTable('tags', 'interactions', $tags_interactions) : '';
        return $tags_interactions_json_table;
    }
	
    public function saveInteractions($tweets_in_range){
        foreach($tweets_in_range as $tweet_in_range){
            $oTweet = Model::findOne($tweet_in_range->id);
            $oTweet->interactions = ($oTweet->likes + $oTweet->comments + $oTweet->shares);
            $oTweet->update();
        }
    }
	
    public function getDayAccountMentionsBySearch($username){
        $client = $this->getClient();
        $search_result = $client->api("search/tweets.json", 'GET', ['q' => "%40".$username, 'count' => 200, 'until' => date('Y-m-d', time())]);
        //echo '<pre>'; var_dump($search_result); echo '</pre>'; die;
        return $search_result;
    }
    
    public function getPublicTrends(){
        $client = $this->getClient();
        $trends = $client->api('trends/place.json', 'GET', ['id' => '23424802'])[0]['trends'];
        $top_ten_trends = array_slice($trends, 0, 10);
        return $top_ten_trends;
    }

    public function saveAccountInsights($oAccountModel){
        $user_data = $this->getAccountData();
        $since = strtotime('first day of this month');
        $until = time();
        $new_mentions = $this->getAllAccountMentions();
        foreach($new_mentions as $mention){
            $oMentionModel = Model::findOne(['entity_id' => $mention['id_str']]);
            if(!$oMentionModel){
                    $oMentionModel = $this->createNewMentionModel($oAccountModel, $mention); 
            }
        }
        $all_mentions = $this->getTimeBasedMentionsAndReplies($oAccountModel->id, $since, $until);
        $new_tweets = $this->getAllAccountTweets();
        $total_replies = $total_retweets = $total_favourites = 0;
        foreach($new_tweets as $tweet){
            $oTweetModel = Model::findOne(['entity_id' => $tweet['id_str']]);
            if(!$oTweetModel){
                $oTweetModel = $this->createNewTweetModel($oAccountModel, $tweet);
            }else{
                $oTweetModel = $this->updateTweetModel($oTweetModel, $tweet);
            }
        }
        $tweets_this_month = $this->getTimeBasedMedia($oAccountModel->id, $since, $until);
        foreach($tweets_this_month as $oTweetModel){
            $total_retweets += $oTweetModel->shares;
            $total_replies += $oTweetModel->comments;
            $total_favourites += $oTweetModel->likes;
        }
        $sources = json_encode($this->getInteractionsSources($tweets_this_month, $all_mentions));
        $oAccountInsights = $this->createAccountInsights($oAccountModel, $user_data, $total_retweets, $total_replies, $total_favourites, count($all_mentions), $sources, 0, 0);
    }
	
	/*
     * get retweet sources for a given tweet id
     */
    public function getTweetRetweetsSourcesByTweetId($tweet_id , $sources){
        $client = $this->getClient();
        $tweet_retweets = $client->api('statuses/retweets/'.$tweet_id.'.json', 'GET', ['count' => 100]);
        foreach($tweet_retweets as $retweet){
            array_push($sources, strip_tags($retweet['source']));
        }
        return $sources;
    }
    
    /*
     * retrieve tweets and get their retweets sources
     */
    public function getTweetsRetweetsSources($sources, $tweets){
        foreach($tweets as $tweet){
            $sources = $this->getTweetRetweetsSourcesByTweetId($tweet->entity_id, $sources);
        }
        return $sources;
    }
    
    /*
     * retrieve mentions and get their sources
     */
    public function getMentionsSources($sources, $mentions){
        foreach($mentions as $mention){
            array_push($sources, $mention['source']);
        }
        return $sources;
    }
    
    public function getInteractionsSources($tweets, $mentions){
        $sources = [];
		//$sources = $this->getTweetsRetweetsSources($sources, $tweets);
        $sources = $this->getMentionsSources($sources, $mentions);
        $sort_sources = $this->sortSources($sources);
        return $sort_sources;
    }
    
    public function sortSources($sources_array){
        $mobile_tablet_array = ['Twitter for Android', 'Mobile Web (M5)', 'Twitter for iPhone', 'Twitter for iPad', 'Twitter for Android Tablets', 'Fenix for Android', 'IFTTT'];
        $desktop_array = ['Twitter Web Client', 'Twitter for Windows', 'Twitter Business Experience', 'TweetDeck'];
        $sort_source['mobile/tablet'] = $sort_source['desktop'] = $sort_source['other'] = 0;
        foreach($sources_array as $source){
            if(in_array($source, $mobile_tablet_array)){
                $sort_source['mobile/tablet'] ++;
            }elseif(in_array($source, $desktop_array)){
                $sort_source['desktop'] ++;
            }else{
                $sort_source['other'] ++;
            }
        }
        return $sort_source;
    }
    
    public function getDeviceTypeJsonTable($devices){
        if(!empty($devices)){
            asort($devices);
        }
		$devices_json_table = ($devices) ? GoogleChartHelper::getDataTable('device', 'views', $devices) : '';
        return $devices_json_table;
    }
        
    public function getComparison($model_id, $since, $until, $authclient_created){
	$start_month = date('Y-m', $since);
	$end_month = date('Y-m', $until);
        $months_limits = [];
	if($start_month == $end_month){
            array_push($months_limits, [
                        'start' => strtotime(date('Y-m-01', strtotime('-1 month'))),
                        'end' => strtotime(date('Y-m-t', strtotime('-1 month')))
                        ]);
            array_push($months_limits, [
                        'start' => $since,
                        'end' => $until
                        ]);
        }elseif(strtotime(date('Y-m-d', $since)) < strtotime(date($authclient_created))){
            array_push($months_limits, [
                        'start' => strtotime(date('Y-m-01', strtotime('-1 month'))),
                        'end' => strtotime(date('Y-m-t', strtotime('-1 month')))
                        ]);
            array_push($months_limits, [
                        'start' => strtotime('first day of this month'),
                        'end' => time()
                        ]);
        }else{
            $months = [];
            $temp = 0;
            while(strtotime(date('Y-m', $temp)) <= strtotime(date('Y-m', $until))){
                if($temp === 0){
                    array_push($months_limits, [
                        'start' => $since,
                        'end' => strtotime(date('Y-m-t 02:00:00', $since))
                        ]);
                    $temp = strtotime('+1 month', strtotime($start_month));
                }elseif(date('Y-m', $temp) == $end_month){
                    array_push($months_limits, [
                        'start' => strtotime(date('Y-m-01 02:00:00', $until)),
                        'end' => $until
                        ]);
                    $temp = strtotime('+1 month', $temp);
                }else{
                    array_push($months_limits, [
                        'start' => strtotime(date('Y-m-01 02:00:00', $temp)),
                        'end' => strtotime(date('Y-m-t 02:00:00', $temp))
                        ]);
                    $temp = strtotime('+1 month', $temp);
                }
                
            }
	}

	//echo '<pre>'; var_dump($months_limits); echo '</pre>'; die;
        foreach($months_limits as $key => $value){
            $insights = Insights::find()->where(['model_id' => $model_id])->andWhere(['between', 'created', date('Y-m-d H:i:s', $value['start']), date('Y-m-d H:i:s', $value['end'])])->all();
            $months_limits[$key]['month'] = date('M y', $value['start']);
            $months_limits[$key]['followers'] = ($insights) ? ($insights[count($insights) -1]->followers - $insights[0]->followers) : '-';
            $months_limits[$key]['listing'] = ($insights) ? ($insights[count($insights) -1]->listed - $insights[0]->listed) : '-';
            
            $mentions = Model::find()->where(['parent_id' => $model_id, 'post_type' => self::MENTION])->andWhere(['between', 'creation_time', $value['start'], $value['end']])->all();
            $months_limits[$key]['mentions'] = count($mentions);
            
            $tweets = Model::find()->where(['parent_id' => $model_id, 'post_type' => self::TWEET])->andWhere(['between', 'creation_time', $value['start'], $value['end']])->all();
            $months_limits[$key]['tweets'] = count($tweets);
            
            $months_limits[$key]['likes'] = $months_limits[$key]['comments'] = $months_limits[$key]['shares'] = 0;
          
            foreach($tweets as $tweet){
                $months_limits[$key]['likes'] += $tweet->likes;
                $months_limits[$key]['comments'] += $tweet->comments;
                $months_limits[$key]['shares'] += $tweet->shares;
            }
            $months_limits[$key]['interactions'] = $months_limits[$key]['likes'] + $months_limits[$key]['comments'] + $months_limits[$key]['shares'];
        }
        rsort($months_limits);
        return $months_limits;
    }
    
}
