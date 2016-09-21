<?php
/**
 * @copyright Copyright (c) 2014 Newerton Vargas de Araújo
 * @link http://newerton.com.br
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace digi\fancybox;

use yii\web\AssetBundle;

class FancyBoxAsset extends AssetBundle
{
    public $sourcePath = '@digi/fancybox/assets/';

    public $js = [];
    
    public $css = [
        'jquery.fancybox.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    
    public function registerAssetFiles($view) {
        $this->js[] = 'jquery.fancybox' . (!YII_DEBUG ? '.pack' : '') . '.js';
        parent::registerAssetFiles($view);
    }
} 