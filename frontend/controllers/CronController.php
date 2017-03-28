<?php

namespace frontend\controllers;

use common\models\base\form\Login;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use common\helpers\GoogleChartHelper;
use digi\authclient\clients\Facebook;
use digi\authclient\clients\Twitter;
use digi\authclient\clients\Instagram;
use digi\authclient\clients\Youtube;
use digi\authclient\clients\GooglePlus;
use digi\authclient\clients\Foursquare;
use digi\authclient\clients\LinkedIn;
use common\models\custom\User;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\Dashboard;
use frontend\models\ContactForm;
use frontend\models\SubscribeForm;
use frontend\models\UserPagesForm;
use frontend\models\SupportForm;
use frontend\models\CompetitorsForm;
/**
 * Site controller
 */
class CronController extends \frontend\components\BaseController {

    public function actionIndex() {
       //get all verified users
        $users = User::find()
            ->where("status=".User::STATUS_VERIFIED)
            ->all();

        foreach ($users as $user){
            Yii::$app->user->logout();
            $oLoginForm = new Login();
            $oLoginForm->LoginDb($user->id);
            $facebook = Authclient::findOne(['user_id' => $user->id, 'source' => 'facebook']);
            $twitter = Authclient::findOne(['user_id' => $user->id, 'source' => 'twitter']);
            $instagram = Authclient::findOne(['user_id' => $user->id, 'source' => 'instagram']);
            $youtube = Authclient::findOne(['user_id' => $user->id, 'source' => 'youtube']);
            $google_plus = Authclient::findOne(['user_id' => $user->id, 'source' => 'google_plus']);
            $linkedin = Authclient::findOne(['user_id' => $user->id, 'source' => 'linkedin']);
            if($user->id > 1) {
                if ($facebook) Yii::$app->runAction('save/facebook');
                if ($twitter) Yii::$app->runAction('save/twitter');
                if ($instagram) Yii::$app->runAction('save/instagram');
                if ($youtube) Yii::$app->runAction('save/youtube');
                if ($google_plus) Yii::$app->runAction('save/google-plus');
                if ($linkedin) Yii::$app->runAction('save/linkedin');
            }
        }

        echo "Done";
        die;
    }
  
  public function actionCustom($id) {
        //get all verified users
        $user = User::find()
            ->where("status=".User::STATUS_VERIFIED .' and id='.$id)
            ->one();

            Yii::$app->user->logout();
            $oLoginForm = new Login();
            $oLoginForm->LoginDb($user->id);
            $facebook = Authclient::findOne(['user_id' => $user->id, 'source' => 'facebook']);
            $twitter = Authclient::findOne(['user_id' => $user->id, 'source' => 'twitter']);
           $instagram = Authclient::findOne(['user_id' => $user->id, 'source' => 'instagram']);
            $youtube = Authclient::findOne(['user_id' => $user->id, 'source' => 'youtube']);
            $google_plus = Authclient::findOne(['user_id' => $user->id, 'source' => 'google_plus']);
            $linkedin = Authclient::findOne(['user_id' => $user->id, 'source' => 'linkedin']);

                if ($facebook) Yii::$app->runAction('save/facebook');
                if ($twitter) Yii::$app->runAction('save/twitter');
                if ($instagram) Yii::$app->runAction('save/instagram');
                if ($youtube) Yii::$app->runAction('save/youtube');
                if ($google_plus) Yii::$app->runAction('save/google-plus');
                if ($linkedin) Yii::$app->runAction('save/linkedin');
        
        echo "Done";
        die;
    }

  
}
