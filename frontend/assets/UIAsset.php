<?php

/**
 * Metronic Admin Asset
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright Copyright (c) 2015 Digitree
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class UIAsset extends AssetBundle {

    //public $sourcePath = '@frontThemePath';
    public $basePath = '@frontThemePath';
    public $baseUrl = '@frontThemeUrl';

    public $css = [
        'css/bootstrap.min.css',
        //'css//daterangepicker.css',
        //'css/datepicker.css',
        'css/animate.css',
        'css/style.css',
    ];

    public $js = [
        'js/jquery-2.2.2.min.js',
        'js/bootstrap.min.js',
      	//'js/moment.min.js',
      	//'js//daterangepicker.js',
        'js/frontend.js',
        //'js/datepicker.js',
        'js/app.js',
    ];

    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\widgets\PjaxAsset',

    ];


}
