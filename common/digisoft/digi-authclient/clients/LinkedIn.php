<?php

namespace digi\authclient\clients;

use Yii;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;

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
}