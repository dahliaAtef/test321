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
        $oUpdateModel->save();
    }
    
    public function firstTimeToLog($company_id, $authclient_id){
        $company_data = $this->getCompanyData($company_id);
        $oAccountModel = $this->createCompanyModel($company_data, $authclient_id);
        $company_updates = $this->getCompanyUpdates($company_id);
        foreach($company_updates['values'] as $update){
            $this->createUpdateModel($oAccountModel->id, $authclient_id, $update);
        }
    }
}