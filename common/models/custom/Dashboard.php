<?php

namespace common\models\custom;

use Yii;
use digi\authclient\clients\Facebook;
use digi\authclient\clients\Twitter;
use digi\authclient\clients\Instagram;
use digi\authclient\clients\Youtube;
use digi\authclient\clients\GooglePlus;
use common\models\custom\Model;
use common\models\custom\Competitors;
use common\models\custom\CompChannels;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;

class Dashboard extends \common\models\base\Base
{
    const ACCOUNT = 0;
    const POST = 1;
    
    public function getDashboardAccountsInsights(){
		
        $insights = [];
        $since = strtotime(date('Y-06-01', time()));
        $until = time();
        $session = Yii::$app->session;
		$accounts = Authclient::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
        if(!$session['dashboard_accounts']){
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
        if(array_key_exists('facebook', $session['dashboard_accounts'])){
            $facebook = new Facebook();
            $insights['facebook']['all_insights'] = $facebook->getAccountInsightsInRange($session['dashboard_accounts']['facebook']['model_id'], $since, $until);
            $insights['facebook']['last_insights'] = $insights['facebook']['all_insights'][count($insights['facebook']['all_insights']) - 1];
        }
        if(array_key_exists('twitter', $session['dashboard_accounts'])){
            $twitter = new Twitter();
            $insights['twitter']['all_insights'] = $twitter->getTimeBasedAccountInsights($session['dashboard_accounts']['twitter']['model_id'], $since, $until);
            $insights['twitter']['last_insights'] = $insights['twitter']['all_insights'][count($insights['twitter']['all_insights']) - 1];
        }
        if(array_key_exists('instagram', $session['dashboard_accounts'])){
            $instagram = new Instagram();
            $insights['instagram']['all_insights'] = $instagram->getTimeBasedAccountInsights($session['dashboard_accounts']['instagram']['model_id'], $since, $until);
			//echo '<pre>'; var_dump($insights['instagram']['all_insights']); echo '</pre>'; die;
            $insights['instagram']['last_insights'] = $insights['instagram']['all_insights'][count($insights['instagram']['all_insights']) - 1];
        }
        if(array_key_exists('google_plus', $session['dashboard_accounts'])){
            $google_plus = new GooglePlus();
            $insights['google_plus']['all_insights'] = $google_plus->getTimeBasedAccountInsights($session['dashboard_accounts']['google_plus']['model_id'], $since, $until);
            $insights['google_plus']['last_insights'] = $insights['google_plus']['all_insights'][count($insights['google_plus']['all_insights']) - 1];
            //echo '<pre>'; var_dump($gp_insights); echo '</pre>'; die;
        }
        if(array_key_exists('youtube', $session['dashboard_accounts'])){
            $youtube = new Youtube();
            $insights['youtube']['all_insights'] = $youtube->getAccountInsightsInRange($session['dashboard_accounts']['youtube']['model_id'], $since, $until);
            $insights['youtube']['last_insights'] = $insights['youtube']['all_insights'][count($insights['youtube']['all_insights']) - 1];
        }
		
		//echo '<pre>'; var_dump($insights); echo '</pre>'; die;
        return $insights;
    }
    
    public function getSocialMediaExistance($insights){
        $sx = [];
        foreach($insights as $oInsightKey => $oInsightValue){
            $sx[$oInsightKey] = $oInsightValue['last_insights']->followers;
        }
        return $sx;
    }
    
    public function getSocialMediaExistanceJsonTable($sx){
        $sx_json_table = ($sx) ? GoogleChartHelper::getDataTable('channel', 'existance', $sx) : '';
        return $sx_json_table;
    }
    
    public function getGrowthPerMonth($insights){
        $growth_per_channel = [];
        foreach($insights as $channel => $value){
            $first_value = $value['all_insights'][0]->followers;
            $last_value = $value['all_insights'][count($value['all_insights']) - 1]->followers;
            $growth_per_channel[$channel] = ($last_value - $first_value);
        }
        return $growth_per_channel;
    }
    
    public function getGrowthPerChannelJsonTable($growth_per_channel){
        $growth_per_channel_json_table = ($growth_per_channel) ? GoogleChartHelper::getDataTable('channel', 'growth', $growth_per_channel) : '';
        return $growth_per_channel_json_table;
    }
    
    public function getChannelsKpiOverviews(){
        $session = Yii::$app->session;
        $kpi_overviews = [];
        $since = strtotime(date('Y-m-01', time()));
        $until = time();
        $since_str = date('Y-m-d H:i:s', $since);
        $until_str = date('Y-m-d H:i:s', $until);
        //$session 
        if(array_key_exists('facebook', $session['dashboard_accounts'])){
            $kpi_overviews['facebook'] = $this->getFacebookKpiOverviewPerMonth($since, $until);
        }
        if(array_key_exists('twitter', $session['dashboard_accounts'])){
            $kpi_overviews['twitter'] = $this->getTwitterKpiOverviewPerMonth($since, $until);
        }
        if(array_key_exists('instagram', $session['dashboard_accounts'])){
            $kpi_overviews['instagram'] = $this->getInstagramKpiOverviewPerMonth($since, $until);
        }
        if(array_key_exists('youtube', $session['dashboard_accounts'])){
            $kpi_overviews['youtube'] = $this->getYoutubeKpiOverviewPerMonth();
        }
        if(array_key_exists('google_plus', $session['dashboard_accounts'])){
            $kpi_overviews['google_plus'] = $this->getGooglePlusKpiOverviewPerMonth($since_str, $until_str);
        }
        return $kpi_overviews;
    }
    
    public function getFacebookKpiOverviewPerMonth($since, $until){
        $oInsights = Insights::find()->Where(['model_id' => Yii::$app->session['dashboard_accounts']['facebook']['model_id']])->orderBy(['id' => SORT_DESC])->one();
        //echo '<pre>'; var_dump(Yii::$app->session['dashboard_accounts']['facebook']['model_id']); echo '</pre>'; die;
        $fb_insights['followers'] = $oInsights->followers;
        $fb_insights['total_organic_reach'] = $oInsights->total_organic_reach;
        $fb_insights['total_paid_reach'] = $oInsights->total_paid_reach;
        $fb_insights['total_unpaid_reach'] = $oInsights->total_unpaid_reach;
        $posts = Model::find()->Where(['parent_id' => Yii::$app->session['dashboard_accounts']['facebook']['model_id']])->andWhere(['between', 'creation_time', $since, $until])->all();
        $fb_insights['reactions'] = $fb_insights['comments'] = $fb_insights['shares'] = 0;
        foreach($posts as $oPost){
            $fb_insights['reactions'] += $oPost->reactions;
            $fb_insights['comments'] += $oPost->comments;
            $fb_insights['shares'] += $oPost->shares;
        }
        $fb_insights['interactions'] = (($fb_insights['reactions']) + ($fb_insights['comments']) + ($fb_insights['shares']));
        return $fb_insights;
    }
    
    public function getYoutubeKpiOverviewPerMonth(){
        $session = Yii::$app->session;
        $oInsights = Insights::find()->Where(['model_id' => $session['dashboard_accounts']['youtube']['model_id']])->orderBy(['id' => SORT_DESC])->one();
        $yt_insights['views'] = $oInsights->total_views;
        $yt_insights['likes'] = $oInsights->total_likes;
        $yt_insights['comments'] = $oInsights->total_comments;
        $yt_insights['shares'] = $oInsights->total_shares;
        $yt_insights['dislikes'] = $oInsights->total_dislikes;
        $yt_insights['subscribers_gained'] = $oInsights->gained_followers;
        $yt_insights['subscribers_lost'] = $oInsights->lost_followers;
        $yt_insights['subscribers'] = $oInsights->followers;
        $yt_insights['interactions'] = (($yt_insights['likes']) + ($yt_insights['comments']) + ($yt_insights['shares']));
        return $yt_insights;
    }
    
    public function getGooglePlusKpiOverviewPerMonth($since, $until){
        //$oInsights = Insights::find()->Where(['model_id' => $session['dashboard_accounts']['google_plus']['model_id']])->orderBy(['id' => SORT_DESC])->one();
        $gp_insights['followers'] = Insights::find()->Where(['model_id' => 144])->orderBy(['id' => SORT_DESC])->one()->followers;
        //$oPosts = Model::find()->Where(['parent_id' => Yii::$app->session['dashboard_accounts']['google_plus']['model_id']])->andWhere(['between', 'creation_time', $since, $until])->all();
        $posts = Model::find()->Where(['parent_id' => 144])->andWhere(['between', 'created', $since, $until])->all();
        $gp_insights['number_of_posted_media'] = count($posts);
        $gp_insights['likes'] = $gp_insights['comments'] = $gp_insights['shares'] = 0;
        foreach($posts as $oPost){
            $gp_insights['likes'] += $oPost->likes;
            $gp_insights['comments'] += $oPost->comments;
            $gp_insights['shares'] += $oPost->shares;
        }
        $gp_insights['interactions'] = (($gp_insights['likes']) + ($gp_insights['comments']) + ($gp_insights['shares']));
        return $gp_insights;
    }
    
    public function getInstagramKpiOverviewPerMonth($since, $until){
        $oInsights = Insights::find()->Where(['model_id' => Yii::$app->session['dashboard_accounts']['instagram']['model_id']])->orderBy(['id' => SORT_DESC])->one();
        $insta_insights['followers'] = $oInsights->followers;
        $posts = Model::find()->Where(['parent_id' => Yii::$app->session['dashboard_accounts']['instagram']['model_id']])->andWhere(['between', 'creation_time', $since, $until])->all();
        $insta_insights['number_of_posted_media'] = count($posts);
        $insta_insights['likes'] = $insta_insights['comments'] = 0;
        foreach($posts as $oPost){
            $insta_insights['likes'] += $oPost->likes;
            $insta_insights['comments'] += $oPost->comments;
        }
        $insta_insights['interactions'] = (($insta_insights['likes'] + $insta_insights['comments']));
        return $insta_insights;
    }
    
    public function getTwitterKpiOverviewPerMonth($since, $until) {
        $session = Yii::$app->session;
        $oInsights = Insights::find()->Where(['model_id' => $session['dashboard_accounts']['twitter']['model_id']])->orderBy(['id' => SORT_DESC])->one();
        $tweets = Model::find()->Where(['parent_id' => Yii::$app->session['dashboard_accounts']['twitter']['model_id'], 'type' => self::ACCOUNT])->andWhere(['between', 'creation_time', $since, $until])->all();
        $tw_insights['likes'] = $oInsights->total_likes;
        $tw_insights['replies'] = $oInsights->total_comments;
        $tw_insights['retweets'] = $oInsights->total_shares;
        $tw_insights['interactions'] = (($oInsights->total_likes)+($oInsights->total_comments)+($oInsights->total_shares));
        $tw_insights['followers'] = $oInsights->followers;
        $tw_insights['listing'] = $oInsights->listed;
        $tw_insights['mentions'] = $oInsights->total_mentions;
        $tw_insights['number_of_posted_tweets'] = count($tweets);
        return $tw_insights;
    }
    
    public function getInteractionPerChannelJsonTable($overview){
        $interaction_per_channel_json_table = ($overview) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('channel', 'interactions', $overview, 'interactions') : '';
        return $interaction_per_channel_json_table;
    }
	
	public function saveCompetitors($oCompetitorsForm){
		$this->checkAndSaveCompetitorOne($oCompetitorsForm);
		$this->checkAndSaveCompetitorTwo($oCompetitorsForm);
		$this->checkAndSaveCompetitorThree($oCompetitorsForm);
	}
	
	public function checkAndSaveCompetitorOne($oCompetitorsForm){
		if($oCompetitorsForm->comp1fb || $oCompetitorsForm->comp1tw || $oCompetitorsForm->comp1insta || $oCompetitorsForm->comp1yt || $oCompetitorsForm->comp1gp || $oCompetitorsForm->comp1in){
			$oCompetitor = new Competitors();
			$oCompetitor->comp_no = 1;
			$oCompetitor->user_id = Yii::$app->user->getId();
			if($oCompetitor->save()){
				$comp = [$oCompetitorsForm->comp1fb, $oCompetitorsForm->comp1tw, $oCompetitorsForm->comp1insta, $oCompetitorsForm->comp1yt, $oCompetitorsForm->comp1gp, $oCompetitorsForm->comp1in];
				$this->checkChannnels($oCompetitor->id, $comp);
			}
		}
	}
	
	public function checkAndSaveCompetitorTwo($oCompetitorsForm){
		if($oCompetitorsForm->comp2fb || $oCompetitorsForm->comp2tw || $oCompetitorsForm->comp2insta || $oCompetitorsForm->comp2yt || $oCompetitorsForm->comp2gp || $oCompetitorsForm->comp2in){
			$oCompetitor = new Competitors();
			$oCompetitor->comp_no = 2;
			$oCompetitor->user_id = Yii::$app->user->getId();
			if($oCompetitor->save()){
				$comp = [$oCompetitorsForm->comp2fb, $oCompetitorsForm->comp2tw, $oCompetitorsForm->comp2insta, $oCompetitorsForm->comp2yt, $oCompetitorsForm->comp2gp, $oCompetitorsForm->comp2in];
				$this->checkChannnels($oCompetitor->id, $comp);
			}
		}
	}
    
	public function checkAndSaveCompetitorThree($oCompetitorsForm){
		if($oCompetitorsForm->comp2fb || $oCompetitorsForm->comp2tw || $oCompetitorsForm->comp2insta || $oCompetitorsForm->comp2yt || $oCompetitorsForm->comp2gp || $oCompetitorsForm->comp2in){
			$oCompetitor = new Competitors();
			$oCompetitor->comp_no = 3;
			$oCompetitor->user_id = Yii::$app->user->getId();
			if($oCompetitor->save()){
				$comp = [$oCompetitorsForm->comp3fb, $oCompetitorsForm->comp3tw, $oCompetitorsForm->comp3insta, $oCompetitorsForm->comp3yt, $oCompetitorsForm->comp3gp, $oCompetitorsForm->comp3in];
				$this->checkChannnels($oCompetitor->id, $comp);
			}
		}
	}
    
	public function checkChannnels($comp_id, $comp){
		$this->checkAndSaveFacebook($comp_id, $comp[0]);
		$this->checkAndSaveTwitter($comp_id, $comp[1]);
		$this->checkAndSaveInstagram($comp_id, $comp[2]);
		$this->checkAndSaveYoutube($comp_id, $comp[3]);
		$this->checkAndSaveGooglePlus($comp_id, $comp[4]);
		$this->checkAndSaveLinkedin($comp_id, $comp[5]);
	}
	
	public function checkAndSaveFacebook($comp_id, $fb_comp){
		if($fb_comp){
			$fb = new Facebook();
			$page = $fb->getCompetitorNameAndFollowersFromUrl($fb_comp);
			$oCompDetails = new CompChannels();
			$oCompDetails->comp_id = $comp_id;
			$oCompDetails->comp_channel = 'facebook';
			$oCompDetails->comp_channel_id = $page["id"];
			$oCompDetails->comp_channel_name = $page["name"];
			$oCompDetails->comp_channel_followers = $page["followers"];
			$oCompDetails->save();
		}
	}
    
	public function checkAndSaveTwitter($comp_id, $tw_comp){
		if($tw_comp){
			$tw = new Twitter();
			$page = $tw->getCompetitorNamesAndFollowers($tw_comp);
			$oCompDetails = new CompChannels();
			$oCompDetails->comp_id = $comp_id;
			$oCompDetails->comp_channel = 'twitter';
			$oCompDetails->comp_channel_id = $page["id"];
			$oCompDetails->comp_channel_name = $page["name"];
			$oCompDetails->comp_channel_followers = $page["followers"];
			$oCompDetails->save();
		}
	}
    
	public function checkAndSaveInstagram($comp_id, $insta_comp){
		if($insta_comp){
			$insta = new Instagram();
			$page = $insta->getCompetitorNameAndFollowers($insta_comp);
			$oCompDetails = new CompChannels();
			$oCompDetails->comp_id = $comp_id;
			$oCompDetails->comp_channel = 'instagram';
			$oCompDetails->comp_channel_id = $page["id"];
			$oCompDetails->comp_channel_name = $page["name"];
			$oCompDetails->comp_channel_followers = $page["followers"];
			$oCompDetails->save();
		}
	}
    
	public function checkAndSaveYoutube($comp_id, $yt_comp){
		if($yt_comp){
			$yt = new Youtube();
			$page = $yt->getCompetitorNameAndSubscribers($yt_comp);
			$oCompDetails = new CompChannels();
			$oCompDetails->comp_id = $comp_id;
			$oCompDetails->comp_channel = 'youtube';
			$oCompDetails->comp_channel_id = $page["id"];
			$oCompDetails->comp_channel_name = $page["name"];
			$oCompDetails->comp_channel_followers = $page["followers"];
			$oCompDetails->save();
		}
	}
    
	public function checkAndSaveGooglePlus($comp_id, $gp_comp){
		if($gp_comp){
			$gp = new GooglePlus();
			$page = $gp->getCompetitorNameAndCircledBy($gp_comp);
			$oCompDetails = new CompChannels();
			$oCompDetails->comp_id = $comp_id;
			$oCompDetails->comp_channel = 'google_plus';
			$oCompDetails->comp_channel_id = $page["id"];
			$oCompDetails->comp_channel_name = $page["name"];
			$oCompDetails->comp_channel_followers = $page["followers"];
			$oCompDetails->save();
		}
	}
    
	public function checkAndSaveLinkedin($comp_id, $in_comp){
		if($in_comp){
			$page = GooglePlus::getCompetitorNameAndCircledBy($in_comp);
			$oCompDetails = new CompChannels();
			$oCompDetails->comp_id = $comp_id;
			$oCompDetails->comp_channel = 'linkedin';
			$oCompDetails->comp_channel_id = $page["id"];
			$oCompDetails->comp_channel_name = $page["name"];
			$oCompDetails->comp_channel_followers = $page["followers"];
			$oCompDetails->save();
		}
	}
    
	public function getUserCompetitors($user_followers, $name){
		$oCompetitors = Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
		if($oCompetitors){
			foreach($oCompetitors as $oCompetitor){
				$competitor_followers = 0;
				foreach($oCompetitor->compChannels as $oChannel){
					$competitor_followers += $oChannel->comp_channel_followers;
				}
				$competitors_array[$oCompetitor->compChannels[0]->comp_channel_name] = $competitor_followers;
			}
			$competitors_array[$name] = $user_followers;
			$sum = array_sum($competitors_array);
			foreach($competitors_array as $competitor => $value){
				$comp_value = round(((($value)/($sum))*100),1);
 				$competitors_existance[$competitor.' '.$comp_value.'%'] = $comp_value;
			}
		}else{
			$competitors_existance = null;
		}
		return $competitors_existance;
	}
	
	public function getCompetitorsJsonTable($competitors_existance){
		$competitors_existance_json_table = GoogleChartHelper::getDataTable('competitor', 'existance', $competitors_existance);
        return $competitors_existance_json_table;
	}
	
	
}// end of class
