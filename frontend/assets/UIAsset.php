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
        'css/animate.css',
        'css/style.css',
    ];

    public $js = [
        'js/jquery-2.2.2.min.js',
        'js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js',
        'js/frontend.js',
    ];

    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\widgets\PjaxAsset',

    ];


}
