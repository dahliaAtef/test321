<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\authclient\clients;

use yii\authclient\InvalidResponseException;
use yii\authclient\OAuth2;
use yii\base\Exception;

/**
 * Facebook allows authentication via Facebook OAuth.
 *
 * In order to use Facebook OAuth you must register your application at <https://developers.facebook.com/apps>.
 *
 * Example application configuration:
 *
 * ~~~
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'yii\authclient\Collection',
 *         'clients' => [
 *             'facebook' => [
 *                 'class' => 'yii\authclient\clients\Facebook',
 *                 'clientId' => 'facebook_client_id',
 *                 'clientSecret' => 'facebook_client_secret',
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ~~~
 *
 * @see https://developers.facebook.com/apps
 * @see http://developers.facebook.com/docs/reference/api
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class Facebook extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://www.facebook.com/dialog/oauth?display=popup';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://graph.facebook.com/oauth/access_token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://graph.facebook.com';
    /**
     * @inheritdoc
     */
    public $scope = 'email';

    /**
    * @var array list of attribute names, which should be requested from API to initialize user attributes.
    * @since 2.0.5
    */
   public $attributeNames = [
       'name',
       'email',
   ];

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('me', 'GET', [
            'fields' => implode(',', $this->attributeNames),
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'facebook';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Facebook';
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
        ];
    }

    public function sendRequest($method, $url, array $params = [], array $headers = [])
    {
        $curlOptions = $this->mergeCurlOptions(
            $this->defaultCurlOptions(),
            $this->getCurlOptions(),
            [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => $url,
            ],
            $this->composeRequestCurlOptions(strtoupper($method), $url, $params)
        );
        $curlResource = curl_init();
        foreach ($curlOptions as $option => $value) {
            curl_setopt($curlResource, $option, $value);
        }
        $response = curl_exec($curlResource);
        $responseHeaders = curl_getinfo($curlResource);

        // check cURL error
        $errorNumber = curl_errno($curlResource);
        $errorMessage = curl_error($curlResource);

        curl_close($curlResource);

        if ($errorNumber > 0) {
            throw new Exception('Curl error requesting "' .  $url . '": #' . $errorNumber . ' - ' . $errorMessage);
        }
        if (strncmp($responseHeaders['http_code'], '20', 2) !== 0) {
            $error= json_decode($response, TRUE);
            //print_r($error['error']['type']);die;
            if($error['error']['type'] == "OAuthException"  or $error['error']['code']==190 ) {
                return null;
            }else{
                             return null;

             //   throw new InvalidResponseException($responseHeaders, $response, 'Request failed with code: ' . $responseHeaders['http_code'] . ', message: ' . $response);
            }
        }

        return $this->processResponse($response, $this->determineContentTypeByHeaders($responseHeaders));
    }
  
   public function api($apiSubUrl, $method = 'GET', array $params = [], array $headers = [])
    {
        if (preg_match('/^https?:\\/\\//is', $apiSubUrl)) {
            $url = $apiSubUrl;
        } else {
            $url = $this->apiBaseUrl . '/' . $apiSubUrl;
        }
        $accessToken = $this->getAccessToken();

        if (!is_object($accessToken) || !$accessToken->getIsValid()) {

            if( !$accessToken->getIsValid() ){
                //$accessToken = $this->refreshAccessToken($accessToken);
                if($accessToken == null){return null;}else{$this->setAccessToken($accessToken);}
            }else{
                return null ;

            }
           // throw new Exception('Invalid access token.');
        }
        return $this->apiInternal($accessToken, $url, $method, $params, $headers);
    }
  


}
