<?php

use \yii\web\Request;

$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl() . '/admin');

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'aliases' => [
        '@metronicTheme' => '@app/themes/metronic',
    ],
    'modules' => [
        /**
         * RBAC module
         */
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
        'treemanager' => [
            'class' => 'kartik\tree\Module',
        // other module settings, refer detailed documentation
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'class' => 'digi\web\User',
            'identityClass' => 'common\models\base\User',
            'enableAutoLogin' => true,
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
        /**
         * Yii authManager
         */
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        /**
         *  here you can set theme used for your backend application 
         */
        'view' => [
            'class' => 'digi\web\View',
            'theme' => [
                'pathMap' => ['@app/views' => '@metronicTheme'],
            ],
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => '@app/messages',
                    'forceTranslation' => true
                ],
            ],
        ],
        'metaTags' => [
            'class' => 'digi\metaTags\MetaTagsComponent',
            'generateCsrf' => false,
            'generateOg' => true,
        ],
    ],
    /**
     * RBAC access
     * 'as access' convention means an 'access' behavior applied to all app contrtolers and modules
     * User with id = 1 has full access
     */
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'rbac/*', // add or remove allowed actions to this list
            'site/login',
            'site/analytics',
        ]
    ],
    'params' => $params,
];
