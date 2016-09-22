<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace digi\authclient\clients;

use yii\authclient\OAuth2;
use yii\authclient\BaseOAuth;


class Pinterest extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://api.pinterest.com/oauth/';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.pinterest.com/v1/oauth/token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.pinterest.com/v1/';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(' ', [
                'profile',
                'email',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('people/me', 'GET');
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'pinterest';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Pinterest';
    }
    
    /*protected function createToken(array $tokenConfig = [])
    {
        $tokenConfig['tokenParamKey'] = 'oauth_token';
        //var_dump($tokenConfig);die;

        return BaseOAuth::createToken($tokenConfig);
    }*/
    
}
