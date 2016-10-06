<?php

namespace digi\authclient\clients;

use Yii;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;
use yii\web\NotFoundHttpException;

class LinkedIn extends \yii\authclient\clients\LinkedIn
{
    const ACCOUNT = 0;
    const POST = 1;
    const IMAGE = 0;
    const VIDEO = 1;
    
    /**
     * Set instagram client session 
     **/
    public function setClient($client){
        Yii::$app->session->set('linkedin', $client);
    }
    
    /**
     * get instagram client session 
     **/
    public function getClient(){
        $client = Yii::$app->session->get('linkedin');
        if(Yii::$app->session->get('linkedin')){
            return Yii::$app->session->get('linkedin');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getUserAdminCompanies(){
        $client = $this->getClient();
        $companies = $client->api('companies?format=json&is-company-admin=true');
        return $companies;
    }
    
    public function getCompanyData($company_id){
        $client = $this->getClient();
        $company_data = $client->api('companies/'.$company_id.':(id,name,logo-url,num-followers)?format=json');
        return $company_data;
    }
    
    public function createCompanyModel($data, $authclient_id){
        $oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $data["id"];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $data["name"];
        $oAccountModel->media_url = $data["logoUrl"];
        $oAccountModel->followers = $data["numFollowers"];
        $oAccountModel->save();
        return $oAccountModel;
    }
    
    public function getCompanyUpdates($company_id){
        $client = $this->getClient();
        $company_updates = $client->api('companies/'.$company_id.'/updates?format=json');
        return $company_updates;
    }
    
    public function createUpdateModel($parent_id, $authclient_id, $update){
        $oUpdateModel = new Model();
        $oUpdateModel->authclient_id = $authclient_id;
        $oUpdateModel->parent_id = $parent_id;
        $oUpdateModel->entity_id = $update['updateKey'];
        $oUpdateModel->type = self::POST;
        $oUpdateModel->content = $update['updateContent']['companyStatusUpdate']['share']['content']['description'];
        $oUpdateModel->media_url = $update['updateContent']['companyStatusUpdate']['share']['content']['thumbnailUrl'];
        $oUpdateModel->likes = $update['numLikes'];
        $oUpdateModel->comments = $update['updateComments']['_total'];
        $oUpdateModel->creation_time = (($update['timestamp'])/1000);
        if(!$oUpdateModel->save()){
            echo '<pre>'; var_dump($oUpdateModel->getErrors()); echo '</pre>'; die;
        }
    }
    
    public function getUpdateStatisticsInTime($company_id, $update_key, $since){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?update-key='.$update_key.'&time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalFollowersStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_followers_statistics = $client->api('companies/'.$company_id.'/historical-follow-statistics?time-granularity=day&start-timestamp='.$since.'&format=json');
        //echo '<pre>'; var_dump($company_followers_statistics); echo '</pre>'; die;
        return $company_followers_statistics;
    }
    
    public function firstTimeToLog($company_id, $authclient_id){
        $company_data = $this->getCompanyData($company_id);
        $oAccountModel = $this->createCompanyModel($company_data, $authclient_id);
        $company_updates = $this->getCompanyUpdates($company_id);
        foreach($company_updates['values'] as $update){
            $this->createUpdateModel($oAccountModel->id, $authclient_id, $update);
        }
        return $oAccountModel;
    }
    
    public function getUpdatesStatistics($company_id, $updates, $since, $until){
        $updates_statistics = [];
        foreach($updates as $oUpdate){
            $update_statistics = $this->getUpdateStatisticsInTime($company_id, $oUpdate->entity_id, $since)['values'];
            $updates_statistics[$oUpdate->entity_id] = ['statistics' => $update_statistics, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'clicks' => 0];
            foreach($update_statistics as $statistics){
                $updates_statistics[$oUpdate->entity_id]['likes'] += $statistics['likeCount'];
                $updates_statistics[$oUpdate->entity_id]['comments'] += $statistics['commentCount'];
                $updates_statistics[$oUpdate->entity_id]['shares'] += $statistics['shareCount'];
                $updates_statistics[$oUpdate->entity_id]['impressions'] += $statistics['impressionCount'];
                $updates_statistics[$oUpdate->entity_id]['clicks'] += $statistics['clickCount'];
            }
        }
        return $updates_statistics;
    }
    
    public function getSumsOfAllUpdatesStatistics($updates_statistics){
        $sum = ['likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'clicks' => 0, 'interactions' => 0];
        foreach($updates_statistics as $statistics){
            $sum['likes'] += $statistics['likes'];
            $sum['comments'] += $statistics['comments'];
            $sum['shares'] += $statistics['shares'];
            $sum['impressions'] += $statistics['impressions'];
            $sum['clicks'] += $statistics['clicks'];
        }
        $sum['interactions'] = $sum['likes'] + $sum['comments'] + $sum['shares'];
        return $sum;
    }
    
    public function statistics($oModel){
        $since = strtotime('-10 months') * 1000;
        $until = time() * 1000;
        $historical_statistics = $this->getHistoricalStatisticsInTime($oModel->entity_id, $since)['values'];
        $days = [];
        $statistics_array = ['clicks' => 0, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'days' => []];
        $company_views_statistics_by_day = [];
        foreach($historical_statistics as $statistics){
            $statistics_array['clicks'] += $statistics['clickCount'];
            $statistics_array['likes'] += $statistics['likeCount'];
            $statistics_array['comments'] += $statistics['commentCount'];
            $statistics_array['shares'] += $statistics['shareCount'];
            $statistics_array['impressions'] += $statistics['impressionCount'];
            $day_in_str = date('d M', (($statistics['time'])/1000));
            array_push($days, $day_in_str);
            $company_views_statistics_by_day[$day_in_str]['impressions'] = $statistics['impressionCount'];
            $company_views_statistics_by_day[$day_in_str]['shares'] = $statistics['shareCount'];
            $company_views_statistics_by_day[$day_in_str]['comments'] = $statistics['commentCount'];
            $company_views_statistics_by_day[$day_in_str]['likes'] = $statistics['likeCount'];
            $company_views_statistics_by_day[$day_in_str]['clicks'] = $statistics['clickCount'];
            $company_views_statistics_by_day[$day_in_str]['interactions'] = $company_views_statistics_by_day[$day_in_str]['shares'] + $company_views_statistics_by_day[$day_in_str]['likes'] + $company_views_statistics_by_day[$day_in_str]['comments'] = $statistics['commentCount'];
        }
        $statistics_array['company_views_statistics_by_day'] = $company_views_statistics_by_day;
        $statistics_array['days'] = $days;
        $days_max_index = count($days) - 1;
        $statistics_array['interactions'] = $statistics_array['likes'] + $statistics_array['comments'] + $statistics_array['shares'];
        $statistics_array['followers'] = $this->getHistoricalFollowersStatisticsInTime($oModel->entity_id, $since);
        $statistics_array['new_followers'] = $statistics_array['followers']['values'][$days_max_index]['totalFollowerCount'] - $statistics_array['followers']['values'][0]['totalFollowerCount'];
        $statistics_array['total_followers'] = $statistics_array['followers']['values'][$days_max_index]['totalFollowerCount'];
        $statistics_array['organic_followers'] = $statistics_array['followers']['values'][$days_max_index]['organicFollowerCount'];
        $statistics_array['paid_followers'] = $statistics_array['followers']['values'][$days_max_index]['paidFollowerCount'];
        $statistics_array['updates'] = Model::find()->Where(['parent_id' => $oModel->id])->andWhere(['between', 'creation_time', $since, $until])->all();
        $statistics_array['avg_daily_updates'] = (count($statistics_array['updates']) != 0) ? round(((count($statistics_array['updates']))/count($days)), 1) : 0;
        $statistics_array['avg_daily_reach'] = ($statistics_array['impressions'] != 0) ? round((($statistics_array['impressions'])/count($days)), 1) : 0;
        $statistics_array['avg_daily_interactions'] = ($statistics_array['interactions'] != 0) ? round((($statistics_array['interactions'])/count($days)), 1) : 0;
        $statistics_array['updates_statistics'] = $this->getUpdatesStatistics($oModel->entity_id, $statistics_array['updates'], $since, $until);
        $statistics_array['updates_statistics_by_day'] = $this->getUpdatesStatisticsByDay($statistics_array['days'], $statistics_array['updates'], $statistics_array['updates_statistics']);
        $statistics_array['sums_of_all_updates_statistics'] = $this->getSumsOfAllUpdatesStatistics($statistics_array['updates_statistics']);
        $statistics_array['followers_array'] = $this->getFollowersArray($statistics_array['followers']['values']);
        return $statistics_array;
    }
    
    public function getUpdatesStatisticsByDay($days, $updates, $updates_statistics){
        foreach($days as $day){
            $update_statistics_by_day[$day] = ['new_updates' => 0, 'new_likes' => 0, 'new_comments' => 0, 'new_shares' => 0, 'new_interactions' => 0, 'new_impressions' => 0, 'new_clicks' => 0];
            foreach($updates as $oUpdate){
                if(date('d M', $oUpdate->creation_time) == $day){
                    $update_statistics_by_day[$day]['new_updates']++;
                    $update_statistics_by_day[$day]['new_likes'] += $updates_statistics[$oUpdate->entity_id]['likes'];
                    $update_statistics_by_day[$day]['new_comments'] += $updates_statistics[$oUpdate->entity_id]['comments'];
                    $update_statistics_by_day[$day]['new_shares'] += $updates_statistics[$oUpdate->entity_id]['shares'];
                    $update_statistics_by_day[$day]['new_interactions'] += ($update_statistics_by_day[$day]['new_likes'] + $update_statistics_by_day[$day]['new_comments'] + $update_statistics_by_day[$day]['new_shares']);
                    $update_statistics_by_day[$day]['new_impressions'] += $updates_statistics[$oUpdate->entity_id]['impressions'];
                    $update_statistics_by_day[$day]['new_clicks'] += $updates_statistics[$oUpdate->entity_id]['clicks'];
                }
            }
        }
        return $update_statistics_by_day;
    }
    
    public function getUpdatesByDayJsonTable($updates_by_day_statistics){
        $updates_by_day_json_table = ($updates_by_day_statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'updates', $updates_by_day_statistics, 'new_updates') : '';
        return $updates_by_day_json_table;
    }
    
    public function getInteractionsByDayJsonTable($days, $update_statistics_by_day, $company_views_statistics_by_day){
        $interactions_by_day_json_table = (($update_statistics_by_day) && ($company_views_statistics_by_day)) ? GoogleChartHelper::getTwoGraphsByDayDataTableUsingKeyNames('day', 'new interactions', 'total interactions', $days, $update_statistics_by_day, 'new_interactions', $company_views_statistics_by_day, 'interactions') : '';
        return $interactions_by_day_json_table;
    }
    
    public function getInteractionsDistributionByDayJsonTable($statistics){
        $interactions_distribution_by_day_json_table = ($statistics) ? GoogleChartHelper::getSameArrayThreeValuesDataTableUsingKeyNames('day', 'likes', 'comments', 'shares', $statistics, 'likes', 'comments', 'shares') : '';
        return $interactions_distribution_by_day_json_table;
    }
    
    public function getClicksByDayJsonTable($statistics){
        $clicks_by_day_json_table = ($statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'clicks', $statistics, 'clicks') : '';
        return $clicks_by_day_json_table;
    }
    
    public function getImpressionsByDayJsonTable($statistics){
        $impressions_by_day_json_table = ($statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'impressions', $statistics, 'impressions') : '';
        return $impressions_by_day_json_table;
    }
    
    public function getFollowersArray($followers){
        $followers_array = [];
        foreach($followers as $day){
            $day_t = date('d M', ($day['time']/1000));
            $followers_array[$day_t]['total'] = $day['totalFollowerCount'];
            $followers_array[$day_t]['organic'] = $day['organicFollowerCount'];
            $followers_array[$day_t]['paid'] = $day['paidFollowerCount'];
        }
        return $followers_array;
    }
    
    public function getFollowersByDayJsonTable($followers){
        $followers_by_day_json_table = ($followers) ? GoogleChartHelper::getSameArrayThreeValuesDataTableUsingKeyNames('day', 'total', 'organic', 'paid', $followers, 'total', 'organic', 'paid') : '';
        return $followers_by_day_json_table;
    }
}