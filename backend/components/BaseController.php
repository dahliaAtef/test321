<?php

namespace backend\components;

use Yii;
use yii\web\Controller;
use backend\assets\AppAsset;
use digi\metronic\AdminAsset as MetronicAdminAsset;

/**
 * Base controller
 */
class BaseController extends Controller {

    /**
     * @var string used to find the view file if the child class doesn't has its own one.   
     */
    public $baseViewPath = '';

    public function init() {
        parent::init();
        //\webvimark\behaviors\multilanguage\MultiLanguageHelper::catchLanguage();
        $this->regiterAssets();
    }

    public function actions() {
        return [
            'sort' => [
                'class' => \digi\sortable\actions\Sort::className(),
            ],
        ];
    }

    protected function regiterAssets() {
        MetronicAdminAsset::register($this->view);
        AppAsset::register($this->view);
    }
    
//    /**
//     * @inheritdoc
//     * Overwite the function to render the view file at the $baseViewPath if it was not found at the default path.
//     */
//    public function render($view, $params = array()) {
//        try {
//            return parent::render($view, $params);
//        } catch (yii\base\InvalidParamException $exc) {
//            return parent::render($this->baseViewPath . DIRECTORY_SEPARATOR . $view, $params);
//        }
//    }

}
