<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace digi\authclient\clients;

use Yii;
use yii\authclient\InvalidResponseException;
use yii\authclient\OAuth2;
use common\helpers\GoogleChartHelper;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\Authclient;
use common\models\custom\CompChannels;
use common\models\custom\Competitors;
use yii\authclient\OAuthToken;
use yii\base\Exception;

/**
 * GoogleOAuth allows authentication via Google OAuth.
 *
 * In order to use Google OAuth you must create a project at <https://console.developers.google.com/project>
 * and setup its credentials at <https://console.developers.google.com/project/[yourProjectId]/apiui/credential>.
 * In order to enable using scopes for retrieving user attributes, you should also enable Google+ API at
 * <https://console.developers.google.com/project/[yourProjectId]/apiui/api/plus>
 *
 * Example application configuration:
 *
 * ~~~
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'yii\authclient\Collection',
 *         'clients' => [
 *             'google' => [
 *                 'class' => 'yii\authclient\clients\GoogleOAuth',
 *                 'clientId' => 'google_client_id',
 *                 'clientSecret' => 'google_client_secret',
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ~~~
 *
 * @see https://console.developers.google.com/project
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class Youtube extends OAuth2
{
	const ACCOUNT = 0;
	const POST = 1;
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://accounts.google.com/o/oauth2/auth?prompt=consent&access_type=offline';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://accounts.google.com/o/oauth2/token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://www.googleapis.com';

    public $autoRefreshAccessToken=true ;


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
        return 'youtube';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Youtube';
    }
    
    public static function setClient($client){
        Yii::$app->session->set('youtube', $client);
    }
    
    public function getClient(){
        $client = Yii::$app->session->get('youtube');
        if(Yii::$app->session->get('youtube')){
            return Yii::$app->session->get('youtube');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getChannelData(){
        $client = $this->getClient();
        $channels = $client->api("/youtube/v3/channels?part=id,contentDetails,snippet,statistics&mine=true", 'GET');
        //$channels = $client->api("/youtube/v3/channels?part=auditDetails,brandingSettings,contentDetails,contentOwnerDetails,id,invideoPromotion,localizations,snippet,statistics,status,topicDetails&mine=true");
        return $channels;
    }
    
  	
  	public function checkClientSession(){
    	if(Yii::$app->session['youtube']){
        	return $this->getClient();
        }else{
        	$oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'youtube']);
              if(! $oAuthclient ){
                  $oAuthclient = Authclient::findOne(['user_id' => 2, 'source' => 'youtube']);
                  $client = unserialize($oAuthclient->source_data);
                  $ReturnData = $client->getUserAttributes() ;
                    if( $ReturnData == null){
                        $oAuthclient->source_data =null;
                        $oAuthclient->save();
                          $client = null;
                    }
                return $client;
              }
              if($oAuthclient->source_data != null){
                 Youtube::setClient( unserialize($oAuthclient->source_data));
                 $ReturnData = $this->getChannelData() ;
                  if( $ReturnData == null){
                      $oAuthclient->source_data =null;
                      $oAuthclient->save();
                      Youtube::setClient( null);
                  }
                  return $this->getClient();
          }
        }
    }
  
  
	public function getChannelDataByUserName($username){
		$client = $this->checkClientSession();
        $channel = $client->api("/youtube/v3/channels?part=id,snippet,statistics&id=".$username, 'GET');
		if(!($channel['items'])){
			$channel = $client->api("/youtube/v3/channels?part=id,snippet,statistics&forUsername=".$username, 'GET');
		}
        return $channel;
	}
	
	public function getChannelUsernameFromUrl($url){
		$name = substr($url, 24);
		$username = explode('/', $name)[1];
		return $username;
	}
	
	public function getCompetitorNameAndSubscribers($url){
		$username = $this->getChannelUsernameFromUrl($url);
		$channel = $this->getChannelDataByUserName($username);
		$page['followers'] = $channel["items"][0]["statistics"]["subscriberCount"];
		$page['name'] = $channel["items"][0]["snippet"]["title"];
		$page['id'] = $channel["items"][0]["id"];
      	$page['img_url'] = $channel["items"][0]['snippet']['thumbnails']['default']['url'];
		return $page;
	}
	
  	
 	public function updateCompetitorsValues(){
      	$competitors = Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
  		foreach($competitors as $oCompetitor){
        	$oYoutube = CompChannels::findOne(['comp_id' => $oCompetitor->id, 'comp_channel' => 'youtube']);
          	if($oYoutube){
            	$this->updateCompetitorValue($oYoutube);
            }
        }
  	}
    
 	public function updateCompetitorValue($oYoutube){
  		$page_data = $this->getChannelDataByUserName($oYoutube->comp_channel_id);
      	if($page_data){
        	$oYoutube->comp_channel_followers = $page_data["items"][0]["statistics"]["subscriberCount"];
          	$oYoutube->update();
        }
  	}
  
    public function getChannelAnalytics($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('- 3 days'))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-1 days', time())));
        //$channel_analytics = $client->api("/youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&metrics=views,comments,likes,dislikes,shares,favoritesAdded,favoritesRemoved,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained,subscribersLost");
        $channel_analytics = $client->api("/youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&metrics=views,comments,likes,dislikes,shares,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained,subscribersLost");
        return $channel_analytics;
    }
    
    public function getChannelSubscribers(){
        $client = $this->getClient();
        $subscribers = $client->api('/youtube/v3/subscriptions?part=subscriberSnippet&mySubscribers=true&maxResults=50');
        return $subscribers;
    }
    
    public function getAnalyticsPerDeviceOs($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $devices = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=deviceType,operatingSystem&metrics=estimatedMinutesWatched,views&sort=-views", 'GET');
        return $devices;
    }
    
    public function getAnalyticsPerDevice($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $devices = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=deviceType&metrics=estimatedMinutesWatched,views&sort=-views", 'GET');
        return $devices;
    }
    
    public function getAnalyticsPerOs($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $os = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=operatingSystem&metrics=estimatedMinutesWatched,views&sort=-views", 'GET');
        return $os;
    }
    
    public function getAnalyticsPerGenderAge($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        //$gender_ages = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=ageGroup,gender&metrics=viewerPercentage&sort=gender,ageGroup", 'GET');
        $gender_ages = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&metrics=viewerPercentage&dimensions=ageGroup,gender&sort=ageGroup", 'GET');
        return $gender_ages;
    }
    
    public function getCountriesNames($countries){
	$countries_json = '{"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Barthelemy", "BM": "Bermuda", "BN": "Brunei", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BQ": "Bonaire, Saint Eustatius and Saba ", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "BZ": "Belize", "RU": "Russia", "RW": "Rwanda", "RS": "Serbia", "TL": "East Timor", "RE": "Reunion", "TM": "Turkmenistan", "TJ": "Tajikistan", "RO": "Romania", "TK": "Tokelau", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "PG": "Papua New Guinea", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "EE": "Estonia", "EG": "Egypt", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands", "FM": "Micronesia", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "XK": "Kosovo", "CI": "Ivory Coast", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos Islands", "CA": "Canada", "CG": "Republic of the Congo", "CF": "Central African Republic", "CD": "Democratic Republic of the Congo", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CW": "Curacao", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syria", "SX": "Sint Maarten", "KG": "Kyrgyzstan", "KE": "Kenya", "SS": "South Sudan", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "South Korea", "SI": "Slovenia", "KP": "North Korea", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "British Virgin Islands", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Laos", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "LV": "Latvia", "TO": "Tonga", "LT": "Lithuania", "LU": "Luxembourg", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libya", "VA": "Vatican", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "U.S. Virgin Islands", "IS": "Iceland", "IR": "Iran", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AQ": "Antarctica", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}';
        $countries_arr = json_decode($countries_json, true);
	if(array_key_exists('rows', $countries)){
            $counter = 0; $countries_names = $countries;
            foreach($countries['rows'] as $country){
		$country_name = (array_key_exists($country[0], $countries_arr)) ? ($countries_arr[$country[0]]) : $country[0];
                $countries_names['rows'][$counter][0] = $country_name;
                $counter++;
            }
        }else{
            $countries_names = null;
        }
        return $countries_names;
    }
	
    public function getAnalyticsPerLocation($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $locations = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=country&metrics=estimatedMinutesWatched,views,averageViewDuration,averageViewPercentage,subscribersGained&sort=-estimatedMinutesWatched", 'GET');
		//echo '<pre>'; var_dump($locations); echo '</pre>'; die;
        return $this->getCountriesNames($locations);
    }
    
    public function getAnalyticsPerLocationsViewsJsonTable($locations){
		if($locations && array_key_exists('rows', $locations)){
			$top_fifteen_locations = (count($locations['rows']) > 15) ? array_slice($locations['rows'], 0, 15) : $locations['rows'];
			$locations_views_json_table = GoogleChartHelper::getKeyAndValueByValueIndexDataTable('country', 'views', $top_fifteen_locations, 1);
		}else{
			$locations_views_json_table = '';
		}
		return $locations_views_json_table;
    }
    
	public function getAnalyticsPerLocationsViewsDashboardJsonTable($locations){
			$top_fifteen_locations = ($locations > 15) ? array_slice($locations, 0, 15) : $locations;
			$locations_views_json_table = GoogleChartHelper::getKeyAndValueByValueIndexDataTable('country', 'views', $top_fifteen_locations, 1);
		return $locations_views_json_table;
    }
	
    public function getAnalyticsPerLocationsMinutesWatchedJsonTable($locations){
		if($locations && array_key_exists('rows', $locations)){
			if($locations['rows'] > 15){
				foreach($locations['rows'] as $location){
					$locations_per_mins_watched[$location[0]] = $location[2];
				}
				arsort($locations_per_mins_watched);
				$top_fifteen_locations = array_slice($locations_per_mins_watched, 0, 15);
			}else{ $top_fifteen_locations = $locations['rows']; }
			$locations_minutes_watched_json_table = GoogleChartHelper::getDataTable('country', 'estimated minutes watched', $top_fifteen_locations);
		}else{
			$locations_minutes_watched_json_table = '';
		}
		return $locations_minutes_watched_json_table;
    }
    
    public function getAnalyticsPerLocationsViewDurationPercentageJsonTable($locations){
		if($locations && array_key_exists('rows', $locations)){
			if($locations['rows'] > 15){
				foreach($locations['rows'] as $location){
					$locations_per_view_duration[$location[0]] = $location[4];
				}
				arsort($locations_per_view_duration);
				$top_fifteen_locations = array_slice($locations_per_view_duration, 0, 15);
			}else{ $top_fifteen_locations = $locations['rows']; }
			$locations_view_duration_percentage_json_table = GoogleChartHelper::getDataTable('country', 'avg view duration percentage', $top_fifteen_locations);
		}else{
			$locations_view_duration_percentage_json_table = '';
		}
		return $locations_view_duration_percentage_json_table;
    }
    
    public function getAnalyticsPerTrafficSource($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $traffic_sources = $client->api("youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=insightTrafficSourceType&metrics=estimatedMinutesWatched,views", 'GET'); 
        return $traffic_sources;
    }
    
    public function getAnalyticsPerTrafficSourcesJsonTable($traffic_sources){
        $traffic_sources_json_table = (array_key_exists('rows', $traffic_sources)) ? GoogleChartHelper::getKeyAndValueByValueIndexDataTable('traffic source', 'views', $traffic_sources["rows"], 2) : '';
        return $traffic_sources_json_table;
    }
    
    public function getAnalyticsPerSharingService($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $sharing_services = $client->api("/youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=sharingService&metrics=shares&sort=-shares");
        return $sharing_services;
    }
    
    public function getAnalyticsPerSharingServiceJsonTable($sharing_services){
        $sharing_services_json_table = (array_key_exists('rows', $sharing_services)) ? GoogleChartHelper::getValuesSameArrayDataTable('sharing service', 'shares', $sharing_services["rows"]) : '';
        return $sharing_services_json_table;
    }
    
    public function getPlaylistVideos($playlist_id){
        $client = $this->getClient();
        $playlist_videos = $client->api("/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=10&playlistId=".$playlist_id, 'GET');
        return $playlist_videos;
    }
    
    public function getTheRestOfPlaylistVideos($playlist_id, $page_token){
        $client = $this->getClient();
        $playlist_videos = $client->api("/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=10&playlistId=".$playlist_id.'&pageToken='.$page_token, 'GET');
        return $playlist_videos;
    }
    
    public function getTopTenMostedVideosForChannel($start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $top_ten_viewed_videos = $client->api("/youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&dimensions=video&sort=-estimatedMinutesWatched&metrics=estimatedMinutesWatched,views,likes,subscribersGained&max-results=10");
        return $top_ten_viewed_videos;
    }
    
    public function getTopTenVideosAnalyticsJson($top_ten_viewed_videos){
        if(array_key_exists('rows', $top_ten_viewed_videos)){
            $counter = 0;
            foreach($top_ten_viewed_videos['rows'] as $video){
                $videos_analytics[$counter]['data'] = $this->getVideoData($video[0])['items'][0];
                $videos_analytics[$counter]['analytics'] = $this->getVideoAnalytics($video[0])['rows'];
                $counter++;
            }
            $top_ten_viewed_videos_analytics_json = json_encode($videos_analytics);
        }else{
            $top_ten_viewed_videos_analytics_json = null;
        }
        return $top_ten_viewed_videos_analytics_json;
    }
    
    public static function getVideoData($video_id){
        $client = Youtube::getClient();
        $data = $client->api("/youtube/v3/videos?id=".$video_id."&part=snippet");
        return $data;
    }
    
    public function getVideoAnalytics($video_id, $start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = date('Y-m-d', strtotime('-1 month', time()))) ;
        ($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $video_analytics = $client->api("/youtube/analytics/v1/reports?ids=channel==MINE&start-date=".$start_date."&end-date=".$end_date."&filters=video==".$video_id."&dimension=filters&sort=-views&metrics=views,comments,likes,dislikes,shares,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained,subscribersLost");
        return $video_analytics;
    }
    
    public function getAnalyticsPerDeviceJsonTable($device_types){
        $device_types_json_table = (array_key_exists('rows', $device_types)) ? GoogleChartHelper::getKeyAndValueByValueIndexDataTable('device', 'views', $device_types["rows"], 2) : '';
        return $device_types_json_table;
    }
    
    public function getAnalyticsPerOperatingSystemJsonTable($os){
        $os_json_table = (array_key_exists('rows', $os)) ? GoogleChartHelper::getKeyAndValueByValueIndexDataTable('operating system', 'views', $os["rows"], 2) : '';
        return $os_json_table;
    }
    
    public function getAnalyticsPerGenderAgesJsonTable($start_date = null, $end_date = null){
        $gender_ages = $this->getAnalyticsPerGenderAge($start_date, $end_date);
        //echo '<pre>'; var_dump($gender_ages); echo '</pre>'; die;
        if(array_key_exists('rows', $gender_ages)){
            $age_ranges = ['13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'];
            $male = $female = $table = $rows = array();
            foreach($gender_ages['rows'] as $gender_age){
                switch ($gender_age[0]){
                    case 'age13-17':
                        ($gender_age[1] == 'male') ? ($male['13-17'] = $gender_age[2]) : ($female['13-17'] = $gender_age[2]);
                        break;
                    case 'age18-24':
                        ($gender_age[1] == 'male') ? ($male['18-24'] = $gender_age[2]) : ($female['18-24'] = $gender_age[2]);
                        break;
                    case 'age25-34':
                        ($gender_age[1] == 'male') ? ($male['25-34'] = $gender_age[2]) : ($female['25-34'] = $gender_age[2]);
                        break;
                    case 'age35-44':
                        ($gender_age[1] == 'male') ? ($male['35-44'] = $gender_age[2]) : ($female['35-44'] = $gender_age[2]);
                        break;
                    case 'age45-54':
                        ($gender_age[1] == 'male') ? ($male['45-54'] = $gender_age[2]) : ($female['45-54'] = $gender_age[2]);
                        break;
                    case 'age55-64':
                        ($gender_age[1] == 'male') ? ($male['55-64'] = $gender_age[2]) : ($female['55-64'] = $gender_age[2]);
                        break;
                    case 'age65+':
                        ($gender_age[1] == 'male') ? ($male['65+'] = $gender_age[2]) : ($female['65+'] = $gender_age[2]);
                        break;
                }
//                
//                if($gender_age[1] == 'male'){
//                    $male[$gender_age[0]] = $gender_age[2];
//                    (!in_array($gender_age[0], $age_ranges)) ? ($age_ranges[] = $gender_age[0]) : '';
//                }else{
//                    $female[$gender_age[0]] = $gender_age[2];
//                    (!in_array($gender_age[0], $age_ranges)) ? ($age_ranges[] = $gender_age[0]) : '';
//                }
            }
            $table['cols'] = [
                ['label' => 'age range', 'type' => 'string'],
                ['label' => 'male', 'type' => 'number'],
                ['label' => 'female', 'type' => 'number'],
            ];
            foreach($age_ranges as $age_range){
                $rows[] = ['c' =>[
                    ['v' => $age_range],
                    ['v' => (array_key_exists($age_range, $male)) ? $male[$age_range] : 0],
                    ['v' => (array_key_exists($age_range, $female)) ? $female[$age_range] : 0],
                ]];
            }
            if($rows){
                $table['rows'] = $rows;
                $gender_ages_json_table = json_encode($table);
            }else{ $gender_ages_json_table = null; }
        }else{ $gender_ages_json_table = ''; }
        return $gender_ages_json_table;
    }
	
	public function getDashboardAnalyticsPerGenderAgesJsonTable($gender_ages, $start_date = null, $end_date = null){
            $age_ranges = ['13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'];
            $male = $female = $table = $rows = array();
            foreach($gender_ages as $gender_age){
                switch ($gender_age[0]){
                    case 'age13-17':
                        ($gender_age[1] == 'male') ? ($male['13-17'] = $gender_age[2]) : ($female['13-17'] = $gender_age[2]);
                        break;
                    case 'age18-24':
                        ($gender_age[1] == 'male') ? ($male['18-24'] = $gender_age[2]) : ($female['18-24'] = $gender_age[2]);
                        break;
                    case 'age25-34':
                        ($gender_age[1] == 'male') ? ($male['25-34'] = $gender_age[2]) : ($female['25-34'] = $gender_age[2]);
                        break;
                    case 'age35-44':
                        ($gender_age[1] == 'male') ? ($male['35-44'] = $gender_age[2]) : ($female['35-44'] = $gender_age[2]);
                        break;
                    case 'age45-54':
                        ($gender_age[1] == 'male') ? ($male['45-54'] = $gender_age[2]) : ($female['45-54'] = $gender_age[2]);
                        break;
                    case 'age55-64':
                        ($gender_age[1] == 'male') ? ($male['55-64'] = $gender_age[2]) : ($female['55-64'] = $gender_age[2]);
                        break;
                    case 'age65-':
                        ($gender_age[1] == 'male') ? ($male['65+'] = $gender_age[2]) : ($female['65+'] = $gender_age[2]);
                        break;
                }
            }
            $table['cols'] = [
                ['label' => 'age range', 'type' => 'string'],
                ['label' => 'male', 'type' => 'number'],
                ['label' => 'female', 'type' => 'number'],
            ];
            foreach($age_ranges as $age_range){
                $rows[] = ['c' =>[
                    ['v' => $age_range],
                    ['v' => (array_key_exists($age_range, $male)) ? $male[$age_range] : 0],
                    ['v' => (array_key_exists($age_range, $female)) ? $female[$age_range] : 0],
                ]];
            }
            if($rows){
                $table['rows'] = $rows;
                $gender_ages_json_table = json_encode($table);
            }else{ $gender_ages_json_table = null; }
        return $gender_ages_json_table;
    }

    public function getAccountInsightsInRange($account_model_id, $since = null, $until = null){
        $since = date('Y-m-d H:i:s', strtotime('last day of last month'));
        $until = date('Y-m-d H:i:s', $until);
    	$account_insights = Insights::find()->Where(['model_id' => $account_model_id])->andWhere(['between', 'created', $since, $until])->all();
    	return $account_insights;
    }

    public function getAndSaveChannelVideosInRange($playlist_id, $model_id, $start_date = null, $end_date = null){
        $client = $this->getClient();
        ($start_date) ? '' : ($start_date = strtotime('first day of last month')) ;
        //($end_date) ? '' : ($end_date = date('Y-m-d', strtotime('-2 days', time())));
        $videos = $client->api("/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=50&playlistId=".$playlist_id, 'GET')['items'];
        //echo '<pre>'; var_dump($videos); echo '</pre>'; die;
        foreach($videos as $video){
            
            if(strtotime($video['snippet']['publishedAt']) >= $start_date){
                //echo '<pre>'; var_dump($video); echo '</pre>';
                $this->createNewVideoModel($video, $model_id);
            }
        }
            //echo '<pre>'; var_dump($videos); echo '</pre>'; die;
            //ecdie;
        return $videos;
    }
    
    public function createNewVideoModel($video, $model_id){
        $oAccountModel = Model::findOne(['id' => $model_id]);
        $oVideo = new Model();
        $oVideo->type = self::POST;
        $oVideo->authclient_id = $oAccountModel->authclient_id;
        $oVideo->entity_id = $video['contentDetails']['videoId'];
        $oVideo->parent_id = $model_id;
        $oVideo->name = $video['snippet']['title'];
        $oVideo->content = $video['snippet']['description'];
        $oVideo->media_url = $video['snippet']['thumbnails']['maxres']['url'];
        $oVideo->creation_time = $video['snippet']['publishedAt'];
        $video_data = $this->getVideoAnalytics($video['contentDetails']['videoId']);
        if(array_key_exists('rows', $video_data)){
            $oVideo->likes = $video_data['rows'][0][2];
            $oVideo->comments = $video_data['rows'][0][1];
            $oVideo->shares = $video_data['rows'][0][4];
        }
        if(!$oVideo->save()){
            //echo '<pre>'; var_dump($oVideo); echo '</pre>'; die;
            echo 'Error saving Video Model'; die;
        }
    }
    
    public function getVideosInRange($model_id, $start_date, $end_date){
        $videos_in_range = Model::find()->Where(['parent_id' => $model_id])->andWhere(['between', 'creation_time', $start_date, $end_date])->all();
        return $videos_in_range;
    }
    
	public function createNewAuthclient($channels){
        $client = $this->getClient();
	//$client = $youtube->getClient();
        $oAuthclient = new Authclient();
        $oAuthclient->user_id = Yii::$app->user->getId();
        $oAuthclient->source = $client->name;
        $oAuthclient->source_data =serialize($client);
        $oAuthclient->source_id = $channels['items'][0]['id'];
        $oAuthclient->save();
        return $oAuthclient;
    }
	public function UpdateAuthclient($oAuthclient){
        $client = $this->getClient();
        $oAuthclient->source_data =serialize($client);
        $oAuthclient->save();
        return true;
    }

	public function firstTimeToLog($authclient_id){
		$channels = $this->getChannelData();
		$channel_analytics = $this->getChannelAnalytics();
      //echo '<pre>'; var_dump($oAccountInsights->insights_json); echo '</pre>'; die;
		$oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $channels['items'][0]['id'];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $channels['items'][0]['snippet']['title'];
        $oAccountModel->media_url = $channels['items'][0]['snippet']['thumbnails']['high']['url'];
        if($oAccountModel->save()){
            $oAccountInsights = new Insights();
            $oAccountInsights->model_id = $oAccountModel->id;
            $oAccountInsights->followers = $channels['items'][0]['statistics']['subscriberCount'];
            $oAccountInsights->number_of_posted_media = $channels['items'][0]['statistics']['videoCount'];
            if(array_key_exists('rows', $channel_analytics)){
                $oAccountInsights->gained_followers = $channel_analytics['rows'][0][8];
                $oAccountInsights->lost_followers = $channel_analytics['rows'][0][9];
                $oAccountInsights->total_views = $channel_analytics['rows'][0][0];
                $oAccountInsights->total_likes = $channel_analytics['rows'][0][2];
                $oAccountInsights->total_comments = $channel_analytics['rows'][0][1];
                $oAccountInsights->total_dislikes = $channel_analytics['rows'][0][3];
                $oAccountInsights->total_shares = $channel_analytics['rows'][0][4];
                $oAccountInsights->insights_json = $this->getInsightsJson();
              //echo '<pre>'; var_dump($oAccountInsights->insights_json); echo '</pre>'; die;
            }
            $oAccountInsights->save();
            $this->getAndSaveChannelVideosInRange($channels['items'][0]['contentDetails']['relatedPlaylists']['uploads'], $oAccountModel->id);
        }else{
            die('error saving Account Data');
	}
    }
	
    public function saveAccountInsights($model_id, $start_date = null){
        $client = $this->getClient();
        $channels = $this->getChannelData();
        $channel_analytics = $this->getChannelAnalytics($start_date);
        ($start_date) ? '' : ($start_date = strtotime('first day of last month')) ;
        $end_date = time();
        $videos = $client->api("/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=50&playlistId=".$channels['items'][0]['contentDetails']['relatedPlaylists']['uploads'], 'GET')['items'];
        foreach($videos as $video){
            $oVideo = Model::findOne(['entity_id' => $video['contentDetails']['videoId'], 'parent_id' => $model_id]);
            if(!$oVideo){
		if(strtotime($video['snippet']['publishedAt']) >= $start_date){
                    $this->createNewVideoModel($video, $model_id);
		}
            }
        }
        $oAccountInsights = new Insights();
	$oAccountInsights->model_id = $model_id;
	$oAccountInsights->followers = $channels['items'][0]['statistics']['subscriberCount'];
	$oAccountInsights->number_of_posted_media = $channels['items'][0]['statistics']['videoCount'];
        if(array_key_exists('rows', $channel_analytics)){
            $oAccountInsights->gained_followers = $channel_analytics['rows'][0][8];
            $oAccountInsights->lost_followers = $channel_analytics['rows'][0][9];
            $oAccountInsights->total_views = $channel_analytics['rows'][0][0];
            $oAccountInsights->total_likes = $channel_analytics['rows'][0][2];
            $oAccountInsights->total_comments = $channel_analytics['rows'][0][1];
            $oAccountInsights->total_dislikes = $channel_analytics['rows'][0][3];
            $oAccountInsights->total_shares = $channel_analytics['rows'][0][4];
            $oAccountInsights->insights_json = $this->getInsightsJson();
        }
	$oAccountInsights->save();
    }
	
    public function sortAnalyticsPerDevice($analytics){
	$sources['mobile/tablet'] = ($analytics[0][2] + $analytics[2][2]);
	$sources['desktop'] = $analytics[1][2];
	$sources['other'] = ($analytics[3][2] + $analytics[4][2] + $analytics[5][2]);
	return $sources;
    }
	
    public function getInsightsJson($since = null, $until = null){
        $since_str = (!$since) ? (date('Y-m-d', strtotime('first day of this month'))) : (date('Y-m-d', $since));
        $until_str = (!$until) ? (date('Y-m-d', time())) : (date('Y-m-d', $until));
        $insights['gender_age'] = $this->getAnalyticsPerGenderAge($since_str, $until_str)['rows'];
        $insights['device'] = $this->sortAnalyticsPerDevice($this->getAnalyticsPerDevice($since_str, $until_str)['rows']);
        $insights['location'] = $this->getAnalyticsPerLocation($since_str, $until_str)['rows'];
        return json_encode($insights);
    }
	
	public function getDeviceTypeJsonTable($devices){
		asort($devices);
		$devices_json_table = ($devices) ? GoogleChartHelper::getDataTable('device', 'views', $devices) : '';
        return $devices_json_table;
	}
	
    public function getcountriesJsonTable($countries){
        $countries_json_table = ($countries) ? GoogleChartHelper::getDataTable('country', 'views', $countries) : '';
        return $countries_json_table;
    }
	
	public function updatePostImageActualSize($page_id){
		$posts = Model::find()->Where(['parent_id' => $page_id])->all();
		echo '<pre>'; var_dump($posts); echo '</pre>'; die;
		foreach($posts as $post){
			$post_details = $this->getVideoData($post->entity_id);
			//echo '<pre>'; var_dump($post_details['items'][0]['snippet']['thumbnails']['maxres']['url']); echo '</pre>'; die;
			$post->media_url = $post_details['items'][0]['snippet']['thumbnails']['maxres']['url'];
			$post->update();
		}
	}

    // inherit this function to check the api return
    protected function sendRequest($method, $url, array $params = [], array $headers = [])
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
//            echo "<pre>";
//            print_r($error);
//            echo "</pre>";
//            die;
            if( $error['error']['message']  == "Invalid Credentials") {
                return null;
            }else{
                throw new InvalidResponseException($responseHeaders, $response, 'Request failed with code: ' . $responseHeaders['http_code'] . ', message: ' . $response);
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
                $accessToken = $this->refreshAccessToken($accessToken);
                if($accessToken == null){return null;}else{$this->setAccessToken($accessToken);}
            }else{
                return null ;

            }
            //throw new Exception('Invalid access token.');
        }
        return $this->apiInternal($accessToken, $url, $method, $params, $headers);
    }

   //to fix the lib issues for request new token
    public function refreshAccessToken(OAuthToken $token)
    {
        if(! isset($token->getParams()['refresh_token'])){
            return null ;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accounts.google.com/o/oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "client_id=$this->clientId&client_secret=$this->clientSecret&refresh_token=".$token->getParams()['refresh_token']."&grant_type=refresh_token",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $returnData= json_decode($response);
          //  echo  $returnData->access_token.'dddd';die;
            $token->setToken($returnData->access_token);
            return $token;
        }

    }

  public function getFansDemographics($insights){
  	$males = $females = 0; $age = []; $youtube =[];
	foreach($insights['gender_age'] as $value){
    	(array_key_exists($value[0], $age)) ? ($age[$value[0]] += $value[2]) : ($age[$value[0]] = $value[2]);
        ($value[1] == 'male') ? ($males += $value[2]) : ($females += $value[2]);
    }
	$viweres = $males + $females;
	$males_percentage = (round(($males/$viweres),1)*100);
	$females_percentage = (round(($females/$viweres),1)*100);
	if($males_percentage >= $$females_percentage){
    	$max_gender_type = 'males';
     	 $max_gender_value = $males_percentage;
    }else{
    	$max_gender_type = 'females';
     	 $max_gender_value = $females_percentage;
    }
    $youtube['gender'] = $max_gender_type.' '.$max_gender_value.'% ';
	$max_age_range = array_keys($age, max($age))[0];
	$max_age_range_value = ($viweres != 0) ? (round((($age[$max_age_range])/$viweres), 1)*100) : 0;
    $youtube['age'] = substr($max_age_range,3).' '.$max_age_range_value.'% ';
	$devices_sum = array_sum($insights['device']);
	$max_device_type = array_keys($insights['device'], max($insights['device']))[0];
	$max_device_value = ($devices_sum != 0) ? (round((($insights['device'][$max_device_type])/$devices_sum), 1)*100) : 0;
    $youtube['device'] = $max_device_type.' '.$max_device_value.'% ';
    foreach($insights['location'] as $value){
    	$country[$value[0]] = $value[1];
    }
	$countries_sum = array_sum($country);
	$max_country_type = array_keys($country, max($country))[0];
	$max_country_value = ($countries_sum != 0) ? (round((($country[$max_country_type])/$countries_sum), 1)*100) : 0;
    $youtube['country'] = $max_country_type.' '.$max_country_value.'% ';
    $youtube['language'] = $youtube['industry'] = $youtube['seniority'] = '...';
    return $youtube;
  }

  
    public function getComparison($model_id, $since, $until, $authclient_created){
	$start_month = date('Y-m', strtotime($since));
	$end_month = date('Y-m', strtotime($until));
	$months_limits = [];
	if($start_month == $end_month){
            array_push($months_limits, [
		'start' => date('Y-m-01', strtotime('-1 month')),
		'end' => date('Y-m-t', strtotime('-1 month'))
            ]);
            array_push($months_limits, [
                'start' => $since,
                'end' => $until
            ]);
        }elseif(strtotime($since) < $authclient_created){
            array_push($months_limits, [
                'start' => date('Y-m-01', strtotime('-1 month')),
                'end' => date('Y-m-t', strtotime('-1 month'))
            ]);
            array_push($months_limits, [
                'start' => date('Y-m-01', time()),
                'end' => date('Y-m-d', time())
            ]);
        }else{
            $months = [];
            $temp = 0;
            while(strtotime(date('Y-m', $temp)) <= strtotime(date('Y-m', strtotime($until)))){
                if($temp === 0){
                    array_push($months_limits, [
                        'start' => $since,
                        'end' => date('Y-m-t', strtotime($since))
                    ]);
                    $temp = strtotime('+1 month', strtotime($start_month));
                }elseif(date('Y-m', $temp) == $end_month){
                    array_push($months_limits, [
                        'start' => date('Y-m-01', strtotime($until)),
                        'end' => $until
                    ]);
                    $temp = strtotime('+1 month', $temp);
                }else{
                    array_push($months_limits, [
                        'start' => date('Y-m-01', $temp),
                        'end' => date('Y-m-t', $temp)
                    ]);
                    $temp = strtotime('+1 month', $temp);
                }
					
            }
        }
        
        foreach($months_limits as $key => $value){
            $analytics = $this->getChannelAnalytics($value['start'], $value['end']);
            $months_limits[$key]['month'] = date('M y', strtotime($value['start']));
            $months_limits[$key]['gained_followers'] = $analytics['rows'][0][8];
            $months_limits[$key]['lost_followers'] = $analytics['rows'][0][9];
            $months_limits[$key]['net_followers'] = $analytics['rows'][0][8] - $analytics['rows'][0][9];
            $months_limits[$key]['views'] = $analytics['rows'][0][0];
            $months_limits[$key]['likes'] = $analytics['rows'][0][2];
            $months_limits[$key]['dislikes'] = $analytics['rows'][0][3];
            $months_limits[$key]['comments'] = $analytics['rows'][0][1];
            $months_limits[$key]['shares'] = $analytics['rows'][0][4];
        }
	return $months_limits;
    }
  
}
