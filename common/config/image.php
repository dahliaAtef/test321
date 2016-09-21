<?php

/**
 * Image config file
 * controlles all image sizes and manipulations using yii\imagine\Image class
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 */
//use Yii;

return [
    'placeholders' => [
        'default' => ['path' => Yii::getAlias('@sharedUrl') . '/images/placeholders/', 'filename' => 'placeholder.png'],
        'person' => ['path' =>  Yii::getAlias('@sharedUrl') . '/images/placeholders/', 'filename' => 'person-placeholder.png'],
    ],
    'sizes' => [
        'micro' => ['thumbnail', 50, 50],
        'home-slider' => ['thumbnail', 1280, 1280],
        'person' => ['thumbnail', 250, 300],
        'list-product2' => ['thumbnail', 360, 360],
        'list_product3' => ['resize', 360, 360],
        'main-image' => ['thumbnail', 960, 240],
        'thumb' => ['thumbnail', 120, 120],
        'top_posts' => ['thumbnail', 130, 130]
    ]
];
