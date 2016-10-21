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

        $id=77;

        $oLoginForm = new Login();
        $oLoginForm->LoginDb($id);

        Yii::$app->runAction('site/twitter');
        Yii::$app->runAction('site/facebook');
//        Yii::$app->runAction('site/linkedin');
//        Yii::$app->runAction('site/googleplus');
//        Yii::$app->runAction('site/youtube');
//        Yii::$app->runAction('site/instagram');

        var_dump( Yii::$app->user->getId());

        echo "Done";
        die;


    }
}
