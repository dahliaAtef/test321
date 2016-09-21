<?php

namespace frontend\components;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\assets\AppAsset;

/**
 * Base controller
 */
class BaseController extends Controller {

    public function init() {
        parent::init();
        //\webvimark\behaviors\multilanguage\MultiLanguageHelper::catchLanguage();
        //$this->setLanguage();
        $this->regiterAssets();
    }

    protected function regiterAssets() {
        AppAsset::register($this->view);
    }

//    protected function setLanguage() {
//        Yii::$app->language = (isset(Yii::$app->params['mlConfig']['subdomains']['ar']) && Url::base(true) == Yii::$app->params['mlConfig']['subdomains']['ar']) ? 'ar' : 'en';
//    }

//    protected function assignClasses(){
//        
//    }
}
