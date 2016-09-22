<?php

namespace digi\authclient\clients;

use Yii;
use yii\authclient\OAuth2;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;

class Linkedin extends OAuth2
{
    const ACCOUNT = 0;
    const POST = 1;
    const IMAGE = 0;
    const VIDEO = 1;
    
    public $authUrl = 'https://www.linkedin.com/oauth/v2/authorization';

    public $tokenUrl = 'https://www.linkedin.com/oauth/v2/accessToken';

    public $apiBaseUrl = 'https://api.linkedin.com';
    
    public $statistics = array();
    
    public $media_in_range;
    
    public $account_insights_in_range;
    
    public $hours;
    
    protected function initUserAttributes()
    {
        $response = $this->api('/v1/people/~', 'GET');

        return $response['data'];
    }

    protected function defaultName()
    {
        return 'linkedin';
    }

    protected function defaultTitle()
    {
        return 'Linkedin';
    }
    
    
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
}