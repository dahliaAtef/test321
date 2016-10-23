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
            $linkedin = Authclient::findOne(['user_id' => $user->id, 'source' => 'linkedin']);
            $google_plus = Authclient::findOne(['user_id' => $user->id, 'source' => 'google-plus']);
            $youtube = Authclient::findOne(['user_id' => $user->id, 'source' => 'youtube']);
            $instagram = Authclient::findOne(['user_id' => $user->id, 'source' => 'instagram']);
            if($user->id >1) {
                if ($twitter) Yii::$app->runAction('site/twitter');
                if ($facebook) Yii::$app->runAction('site/facebook');
                if ($linkedin) Yii::$app->runAction('site/linkedin');
                if ($google_plus) Yii::$app->runAction('site/google-plus');
                if ($youtube) Yii::$app->runAction('site/youtube');
                if ($instagram) Yii::$app->runAction('site/instagram');
            }
        }

        echo "Done";
        die;
    }
}
