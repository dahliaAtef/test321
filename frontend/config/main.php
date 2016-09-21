<?php

use \yii\web\Request;
use \yii\helpers\Url;
//use InstagramEngine;

$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Social Insights',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'treemanager' => [
            'class' => 'kartik\tree\Module',
        // other module settings, refer detailed documentation
        ],
        'comment' => [
            'class' => 'yii2mod\comments\Module'
        ]
    ],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'class' => 'digi\web\User',
            'identityClass' => 'common\models\custom\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/#login',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            //'class' => 'webvimark\behaviors\multilanguage\MultiLanguageUrlManager', // \webvimark\behaviors\multilanguage\MultiLanguageUrlManager::className(),
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' =>false,
            'rules' => [
                // multilanguage rules
                //'<_c:[\w \-]+>/<id:\d+>' => '<_c>/view',
                //'<_c:[\w \-]+>/<_a:[\w \-]+>/<id:\d+>' => '<_c>/<_a>',
                //'<_c:[\w \-]+>/<_a:[\w \-]+>' => '<_c>/<_a>',//Make confiflect with cutome routes
                //'<_m:[\w \-]+>/<_c:[\w \-]+>/<_a:[\w \-]+>' => '<_m>/<_c>/<_a>',
                //'<_m:[\w \-]+>/<_c:[\w \-]+>/<_a:[\w \-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
                // custom rules
                'mobile-login' => 'site/mobile-login',
                'contact-us' => 'site/contact-us',
                'support' => 'site/support',
                'subscribe' => 'site/subscribe',
                'dashboard' => 'site/dashboard',
                'facebook' => 'site/facebook',
                'twitter' => 'site/twitter',
                'instagram' => 'site/instagram',
                'youtube/v/<v:\S+>' => 'site/youtube',
                'youtube/<p:\S+>' => 'site/youtube',
                'youtube' => 'site/youtube',
                'google-plus' => 'site/google-plus',
                'foursquare' => 'site/foursquare',
                'signup' => 'user/signup',
                'login' => 'user/login',
                'logout' => 'user/logout',
            ],
        ],
        'metaTags' => [
            'class' => 'digi\metaTags\MetaTagsComponent',
            'generateCsrf' => false,
            'generateOg' => true,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '433222083546076',
                    'clientSecret' => '9ef3fe719f2a7adee35db5e85de6d062',
                    'scope' => 'user_status, user_events,user_likes,user_posts,manage_pages,publish_pages,read_insights,read_audience_network_insights,email, public_profile, ads_management, pages_show_list',
                ],
                'twitter' => [
                    'class' => 'yii\authclient\clients\Twitter',
                    'consumerKey' => 'fDkXCFGCgBafJN7kCtD49YGlj',
                    'consumerSecret' => '6nSQJEa9lUMpdTr4YqrsY6JKIuPKfas9xPSY7XMU2GFVZf31G6',
                ],
                'instagram' => [
                    'class' => 'digi\authclient\clients\Instagram',
                    'clientId' => '1218802bd69f4bc9badfa80006bc0df9',
                    'clientSecret' => 'c4ec92c53a8b493f9c62c48c167b0ade',
                    'scope' => 'basic follower_list public_content',
                ],
                'youtube' => [
                    'class' => 'digi\authclient\clients\Youtube',
                    'clientId' => '858394479401-qb66iohgmb0811bgl1iradjdnn43sstm.apps.googleusercontent.com',
                    'clientSecret' => 'sJpx-lcRIep6yY52Ywh10SCY',
                    //'scope' => 'https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/youtubepartner-channel-audit https://www.googleapis.com/auth/youtube.force-ssl',
                    'scope' => 'https://www.googleapis.com/auth/yt-analytics.readonly https://www.googleapis.com/auth/yt-analytics-monetary.readonly https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/youtubepartner https://www.googleapis.com/auth/youtubepartner-channel-audit https://www.googleapis.com/auth/youtube.force-ssl'
                ],
                'google_plus' => [
                    'class' => 'digi\authclient\clients\GooglePlus',
//                    'clientId' => '691104327907-tfrcuui5a3gh4ib1rmf0rhrd3b7gul36.apps.googleusercontent.com',
//                    'clientSecret' => 'mDLEkw1z5ZtSQ8M3rrkzTTKC',
                    'clientId' => '858394479401-6cmta293biga6lbcd7kq269qs4u4ke6v.apps.googleusercontent.com',
                    'clientSecret' => 'MWZY8RvNq03g5TguHXvZ5YpH',
                    'scope' => 'profile email https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/plus.circles.read',
                    //'scope' => 'https://www.googleapis.com/auth/plus.me profile email https://www.googleapis.com/auth/plus.login',
                ],
                'foursquare' => [
                    'class' => 'digi\authclient\clients\Foursquare',
                    'clientId' => 'OP3O2BVLE41LUBNE0O4J5I2KWFVHMBGEIXQUFBSFFQCJRBNV',
                    'clientSecret' => '5E54ADIOBYGWOF2PRDVQXHLMALKY0T2GJ0NWXLJV0HAC0CK3',
                ],
            ],
        ],

    ],
    'params' => $params,
];
