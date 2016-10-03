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
        $oUpdateModel->creation_time = $update['timestamp'];
        //$oUpdateStatistics = $this->getUpdateStatistics($parent_id, $update['updateKey']);
        if(!$oUpdateModel->save()){
            echo '<pre>'; var_dump($oUpdateModel->getErrors()); echo '</pre>'; die;
        }
    }
    
    public function getUpdateStatisticsInTime($company_id = '5260201', $update_key = 'UPDATE-c5260201-6082180170444267520', $since = '1475280000000'){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?update-key='.$update_key.'&time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalStatisticsInTime($company_id = '5260201', $since = '1475280000000'){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalFollowersStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_followers_statistics = $client->api('companies/'.$company_id.'/historical-follow-statistics?time-granularity=day&start-timestamp='.$since.'&format=json');
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
    
    public function statistics($company_id = '5260201'){
        $since = strtotime('-3 months') * 1000;
        $historical_statistics = $this->getHistoricalStatisticsInTime($company_id, $since)['values'];
        //echo '<pre>'; var_dump($historical_statistics); echo '</pre>'; die;
        $statistics_array = ['clicks' => 0, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0];
        foreach($historical_statistics as $statistics){
            $statistics_array['clicks'] += $statistics['clickCount'];
            $statistics_array['likes'] += $statistics['likeCount'];
            $statistics_array['comments'] += $statistics['commentCount'];
            $statistics_array['shares'] += $statistics['shareCount'];
            $statistics_array['impressions'] += $statistics['impressionCount'];
        }
        $statistics_array['interactions'] = $statistics_array['likes'] + $statistics_array['comments'] + $statistics_array['shares'];
        $statistics_array['followers'] = $this->getHistoricalFollowersStatisticsInTime($company_id, $since);
        $statistics_array['new_followers'] = $statistics_array['followers']['values'][92]['totalFollowerCount'] - $statistics_array['followers']['values'][0]['totalFollowerCount'];
        $statistics_array['total_followers'] = $statistics_array['followers']['values'][92]['totalFollowerCount'];
        $statistics_array['organic_followers'] = $statistics_array['followers']['values'][92]['organicFollowerCount'];
        $statistics_array['paid_followers'] = $statistics_array['followers']['values'][92]['paidFollowerCount'];
        //echo '<pre>'; var_dump($statistics_array['followers']['values']); echo '</pre>'; die;
        echo '<pre>'; var_dump($statistics_array['followers']['values'][0]); echo '</pre>'; die;
    }
}