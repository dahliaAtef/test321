<?php

namespace digi\authclient\clients;

use Yii;
use yii\authclient\OAuth2;
use yii\authclient\BaseOAuth;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;

class Foursquare extends OAuth2
{
    const ACCOUNT = 0;
    
    public $authUrl = 'https://foursquare.com/oauth2/authenticate';
    
    public $tokenUrl = 'https://foursquare.com/oauth2/access_token';
    
    public $apiBaseUrl = 'https://api.foursquare.com/v2';
    

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

    
    protected function initUserAttributes()
    {
        return $this->api('users/self', 'GET');
    }

    protected function defaultName()
    {
        return 'foursquare';
    }

    
    protected function defaultTitle()
    {
        return 'Foursquare';
    }
    
    protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    {
        $params['oauth_token'] = $accessToken->getToken();
        $params['v'] = '20140806';

        return $this->sendRequest($method, $url, $params, $headers);
    }
    
    public static function setClient($client){
        if(!Yii::$app->session->get('foursquare')){
            Yii::$app->session->set('foursquare', $client);
        }
    }
    
    public function getClient(){
        $client = Yii::$app->session->get('foursquare');
        if(Yii::$app->session->get('foursquare')){
            return Yii::$app->session->get('foursquare');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getUserData(){
        return $this->api('users/self');
    }
    
    public function getManagedVenues(){
        $client = $this->getClient();
        $managed_venues = $client->api('/venues/managed', 'GET')['response']['venues'];
        //$managed_venues = $client->api('/venues/managed', 'GET');
        //echo '<pre>'; var_dump($managed_venues); echo '</pre>'; die;
        return $managed_venues;
    }
    
    public function getVenueData($venue_id){
        $client = $this->getClient();
        $venue = $client->api('/venues/'.$venue_id, 'GET')['response']['venue'];
        return $venue;
    }
    
    public function firstTimeToLog($authclient_id, $venue_id){
        $venue_data = $this->getVenueData($venue_id);
        $oModel = new Model();
        $oModel->authclient_id = $authclient_id;
        $oModel->entity_id = $venue_id;
        $oModel->type = self::ACCOUNT;
        $oModel->name = $venue_data['name'];
        $oModel->media_url = $venue_data['bestPhoto']['prefix'].'width960'.$venue_data['bestPhoto']['suffix'];
        $oModel->url = $venue_data['canonicalUrl'];
        
        if($oModel->save()){
            $oInsights = new Insights();
            $oInsights->model_id = $oModel->id;
            $oInsights->total_likes = $venue_data['likes']['count'];
            $oInsights->followers = $venue_data['stats']['usersCount'];
            $oInsights->number_of_posted_media = $venue_data['stats']['tipCount'];
            $oInsights->listed = $venue_data['listed']['count'];
            $oInsights->visits = $venue_data['stats']['visitsCount'];
            $oInsights->checkins = $venue_data['stats']['checkinsCount'];
            $oInsights->save();
        }
    }
    
}
