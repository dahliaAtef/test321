<?php

namespace digi\authclient\clients;

use Yii;
use common\helpers\GoogleChartHelper;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\UserPosts;
use common\models\custom\Authclient;
use common\models\custom\CompChannels;
use common\models\custom\Competitors;

class Facebook extends \yii\authclient\clients\Facebook
{
    const ACCOUNT = 0;
    const POST = 1;
    const IMAGE = 0;
    const VIDEO = 1;
    const STATUS = 2;
    const LINK = 3;
    const EVENT = 4;
    const OFFER = 5;
    
    public static function setClient($client){
            Yii::$app->session->set('facebook', $client);
    }
    
    public function getClient(){
        $client = Yii::$app->session->get('facebook');
        if(Yii::$app->session->get('facebook')){
            return Yii::$app->session->get('facebook');
        }else{
            return false;
        }
    }


    public static function getUserPages(){
        $fb = new Facebook();
        $client = $fb->getClient();
        $user_pages = $client->api("/me/accounts", 'GET');
        return $user_pages;
    }
    
    public function getPageViews($page_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-92 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_views = $client->api($page_id."/insights/page_views?since=".$since."&until".$until)["data"];
        return $page_views;
    }
    
    public function getPageViewsJsonTable($page_id, $since = null, $until = null){
        $page_views = $this->getPageViews($page_id, $since, $until);
        $page_views_json_table = ($page_views) ? GoogleChartHelper::getTimeDataTable('day', 'views', $page_views[0]["values"]) : '';
        return $page_views_json_table;
    }
    
    public function getPageData($page_id){
        $client = $this->getClient();
        $page_data = $client->api($page_id."?fields=name,likes,link,picture,unread_message_count,unseen_message_count");
        //echo '<pre>'; var_dump($page_data); echo '</pre>'; die;
        return $page_data;
    }
    
    public function getAllFans($page_id, $since, $until){
        $client = $this->getClient();
        $all_fans = $client->api($page_id."/insights/page_fans?since=".$since."&until=".$until)["data"];
        return $all_fans;
    }
    
    public function getAllFansJsonTable($all_fans, $since = null, $until = null){
        $all_fans_json_table = ($all_fans) ? GoogleChartHelper::getTimeDataTable('day', 'fans', $all_fans[0]["values"]) : '';
        return $all_fans_json_table;
    }
    
    /*
     * Get fans by country the day before the specified range, to help in calculating growth
     */
    public function getFansByCountryBefore($page_id, $since){
        $client = $this->getClient();
        $before_since = strtotime('-1 days', $since);
        $fans_country = $client->api($page_id."/insights/page_fans_country/lifetime?since=".$before_since."&until=".$since, 'GET');
        return $fans_country;
    }
    
    /*
     * Get fans by countryin the specified range
     */
    public function getFansByCountry($page_id, $since, $until){
        $client = $this->getClient();
        $fans_country = $client->api($page_id."/insights/page_fans_country/lifetime?since=".$since."&until=".$until, 'GET');
        return $fans_country;
    }
  
  public function getFansByCountryValues($page_id, $since, $until){
    $fans_country_req = $this->getFansByCountry($page_id, $since, $until);
    if($fans_country_req['data']){
  		$fans_country = $this->getFansByCountry($page_id, $since, $until)['data'][0]['values'];
    	$count = $this->checkAndGetValueIndex($fans_country);
        if(array_key_exists('value', $fans_country[$count])){
            arsort($fans_country[$count]["value"]);
          	return $fans_country[$count]["value"];
        }else{
            return null;
        }
    }else{
     	return null;
    }
  }
    
    public function getFansLanguage($page_id, $since, $until){
       $client = $this->getClient();
       $fans_language = $client->api($page_id."/insights/page_fans_locale?since=".$since."&until=".$until, 'GET')['data'];
       return $fans_language;
    }
    
	public function getLanguageInEnglish($languages){
		$languages_lib = ["af_ZA" => "Afrikaans (South Africa)", "ak_GH" => "Akan (Ghana)", "am_ET" => "Amharic (Ethiopia)", "ar_AR" => "Arabic", "as_IN" => "Assamese (India)", "ay_BO" => "Aymara (Bolivia)", "az_AZ" => "Azerbaijani (Azerbaijan (latin))", "be_BY" => "Belarusian (Belarus)", "bg_BG" => "Bulgarian (Bulgaria)", "bn_IN" => "Bengali (India)", "br_FR" => "Breton (France)", "bs_BA" => "Bosnian (Bosnia)", "ca_ES" => "Catalan (Spain)", "cb_IQ" => "Sorani Kurdish", "ck_US" => "Cherokee (USA)", "co_FR" => "Corsican", "cs_CZ" => "Czech", "cx_PH" => "Cebuano", "cy_GB" => "Welsh (Britain)", "da_DK" => "Danish (Denmark)", "de_DE" => "German (Germany)", "el_GR" => "Greek (Greece)", "en_GB" => "English (UK)", "en_IN" => "English (India)", "en_PI" => "English (Pirate)", "en_UD" => "English (Upside Down)", "en_US" => "English (USA)", "eo_EO" => "Esperanto", "es_CL" => "Spanish (Chile)", "es_CO" => "Spanish (Colombia)", "es_ES" => "Spanish (Spain)", "es_LA" => "Spanish", "es_MX" => "Spanish (Mexico)", "es_VE" => "Spanish (Venezuela)", "et_EE" => "Estonian (Estonia)", "eu_ES" => "Basque (Spain)", "fa_IR" => "Persian (Iran)", "fb_LT" => "Leet Speak", "ff_NG" => "Fulah", "fi_FI" => "Finnish (Finland)", "fo_FO" => "Faroese (Faroe Islands)", "fr_CA" => "French (Canada)", "fr_FR" => "French (France)", "fy_NL" => "Frisian (Netherlands)", "ga_IE" => "Irish (Ireland)", "gl_ES" => "Galician (Spain)", "gn_PY" => "Guarani (Paraguay)", "gu_IN" => "Gujarati (India)", "gx_GR" => "Greek (Greece)", "ha_NG" => "Hausa (Nigeria)", "he_IL" => "Hebrew (Israel)", "hi_IN" => "Hindi (India)", "hr_HR" => "Croatian (Croatia)", "ht_HT" => "Haitian (Haiti)", "hu_HU" => "Hungarian (Hungary)", "hy_AM" => "Armenian (Armenia)", "id_ID" => "Indonesian (Indonesia)", "ig_NG" => "Igbo (Nigeria)", "is_IS" => "Icelandic (Iceland)", "it_IT" => "Italian (Italy)", "ja_JP" => "Japanese (Japan)", "ja_KS" => "Japanese (Kansai)", "jv_ID" => "Javanese", "ka_GE" => "Georgian (Georgia)", "kk_KZ" => "Kazakh (Kazakhstan)", "km_KH" => "Khmer (Cambodia)", "kn_IN" => "Kannada (India)", "ko_KR" => "Korean (Korea)", "ku_TR" => "Kurdish-Latin (Turkey)", "ky_KG" => "Kyrgyz (Kyrgyzstan)", "la_VA" => "Latin", "lg_UG" => "Ganda (Uganda)", "li_NL" => "Limburgish (Netherlands)", "ln_CD" => "Lingala (Congo)", "lo_LA" => "Lao (Laos)", "lt_LT" => "Lithuanian (Lithuania)", "lv_LV" => "Latvian (Latvia)", "mg_MG" => "Malagasy (Madagascar)", "mi_NZ" => "Māori (New Zealand)", "mk_MK" => "Macedonian (Macedonia)", "ml_IN" => "Malayalam (India)", "mn_MN" => "Mongolian (Mongolia)", "mr_IN" => "Marathi (India)", "ms_MY" => "Malay (Malaysia)", "mt_MT" => "Maltese (Malta)", "my_MM" => "Burmese (Myanmar)", "nb_NO" => "Norwegian-bokmal (Norway)", "nd_ZW" => "Ndebele", "ne_NP" => "Nepali (Nepal)", "nl_BE" => "Dutch (Belgium)", "nl_NL" => "Dutch (Netherlands)", "nn_NO" => "Norwegian-nynorsk (Norway)", "ny_MW" => "Chewa", "or_IN" => "Oriya (India)", "pa_IN" => "Punjabi (India)", "pl_PL" => "Polish", "ps_AF" => "Pashto (Afghanistan)", "pt_BR" => "Portuguese (Brazil)", "pt_PT" => "Portuguese (Portugal)", "qc_GT" => "Quiché", "qu_PE" => "Quechua", "rm_CH" => "Romansh", "ro_RO" => "Romanian (Romania)", "ru_RU" => "Russian (Russia)" ,"rw_RW" => "Kinyarwanda (Rwanda)", "sa_IN" => "Sanskrit (India)", "sc_IT" => "Sardinian (Italy)", "se_NO" => "Northern Sámi (Norway)", "si_LK" => "Sinhala (Sri Lanka)", "sk_SK" => "Slovak (Slovak)", "sl_SI" => "Slovenian (Slovenia)", "sn_ZW" => "Shona", "so_SO" => "Somali (Somalia)", "sq_AL" => "Albanian (Albania)", "sr_RS" => "Serbian (Serbia)", "sv_SE" => "Swedish (Sweden)", "sw_KE" => "Swahili (Kenya)", "sy_SY" => "Syriac", "sz_PL" => "Silesian", "ta_IN" => "Tamil (India)", "te_IN" => "Telugu (India)", "tg_TJ" => "Tajik (Tajikistan)", "th_TH" => "Thai (Thailand)", "tk_TM" => "Turkmen (Turkmenistan)", "tl_PH" => "Filipino (Philippines)", "tl_ST" => "Klingon", "tr_TR" => "Turkish (Turky)", "tt_RU" => "Tatar (Russia)", "tz_MA" => "Tamazight (Morocco)", "uk_UA" => "Ukrainian (Ukraine)", "ur_PK" => "Urdu (Pakistan)", "uz_UZ" => "Uzbek (Uzbekistan)", "vi_VN" => "Vietnamese (Vietnam)", "wo_SN" => "Wolof (Senegal)", "xh_ZA" => "Xhosa (South Africa)", "yi_DE" => "Yiddish (Germany)", "yo_NG" => "Yoruba (Nigeria)", "zh_CN" => "Chinese (China)", "zh_HK" => "Chinese (Hong Kong)", "zh_TW" => "Chinese (Taiwan)", "zu_ZA" => "Zulu (South Africa)", "zz_TR" => "Zazaki (Turkey)"];
		foreach($languages as $language => $value){
			$language_eng = (array_key_exists($language, $languages_lib)) ? ($languages_lib[$language]) : $language;
			$languages_eng[$language_eng] = $value;
		}
		return $languages_eng;
	}
  
  public function getFansLanguageValues($page_id, $since, $until){
    $fans_languages_req = $this->getFansLanguage($page_id, $since, $until);
    if($fans_languages_req){
  	$fans_language = $this->getFansLanguage($page_id, $since, $until)[0]['values'];
    $count = $this->checkAndGetValueIndex($fans_language);
        if(array_key_exists('value', $fans_language[$count])){
          	$fans_language_english = $this->getLanguageInEnglish($fans_language[$count]["value"]);
            arsort($fans_language_english);
          	return $fans_language_english;
        }else{
            return null;
        }
    }else return null;
  }
    
	
    public function getFansByLanguageJsonTable($fans_language){
      if($fans_language){
          $count = $this->checkAndGetValueIndex($fans_language[0]['values']);
          if(array_key_exists('value', $fans_language[0]['values'][$count])){
              arsort($fans_language[0]['values'][$count]["value"]);
              $languages_eng = $this->getLanguageInEnglish($fans_language[0]['values'][$count]["value"]);
              $fans_language_json_table = GoogleChartHelper::getDataTable('language', 'value', $languages_eng);
          }else{
              $fans_language_json_table = '';
          }
        }else $fans_language_json_table = '';
        return $fans_language_json_table;
    }
    
    public function getCountryName($countries_codes){
        $countries_json = '{"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Barthelemy", "BM": "Bermuda", "BN": "Brunei", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BQ": "Bonaire, Saint Eustatius and Saba ", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "BZ": "Belize", "RU": "Russia", "RW": "Rwanda", "RS": "Serbia", "TL": "East Timor", "RE": "Reunion", "TM": "Turkmenistan", "TJ": "Tajikistan", "RO": "Romania", "TK": "Tokelau", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "PG": "Papua New Guinea", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "EE": "Estonia", "EG": "Egypt", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands", "FM": "Micronesia", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "XK": "Kosovo", "CI": "Ivory Coast", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos Islands", "CA": "Canada", "CG": "Republic of the Congo", "CF": "Central African Republic", "CD": "Democratic Republic of the Congo", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CW": "Curacao", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syria", "SX": "Sint Maarten", "KG": "Kyrgyzstan", "KE": "Kenya", "SS": "South Sudan", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "South Korea", "SI": "Slovenia", "KP": "North Korea", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "British Virgin Islands", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Laos", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "LV": "Latvia", "TO": "Tonga", "LT": "Lithuania", "LU": "Luxembourg", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libya", "VA": "Vatican", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "U.S. Virgin Islands", "IS": "Iceland", "IR": "Iran", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AQ": "Antarctica", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}';
        $countries_arr = json_decode($countries_json, true);
        foreach($countries_codes as $country_code => $value){
            $country_name = (array_key_exists($country_code, $countries_arr)) ? ($countries_arr[$country_code]) : $country_code;
            $countries_names[$country_name] = $value;
        }
        return $countries_names;
    }
    
    public function getFansByCountryJsonTable($fans_country){
      if($fans_country){
        $count = $this->checkAndGetValueIndex($fans_country['data'][0]['values']);
          if(array_key_exists('value', $fans_country['data'][0]['values'][$count])){
              arsort($fans_country['data'][0]['values'][$count]["value"]);
              $countries_names = $this->getCountryName($fans_country['data'][0]['values'][$count]["value"]);
              $fans_country_json_table = GoogleChartHelper::getDataTable('country', 'percentage', $countries_names);
          }else{
              $fans_country_json_table = '';
          }
      }else $fans_country_json_table = null;
        return $fans_country_json_table;
    }
    
    public function getFansByCountryTableTest($fans_by_country, $fans_by_country_before, $total_fans){
        $fans_country = $fans_by_country['data'][0]['values'];
        $fans_country_before = $fans_by_country_before['data'][0]['values'][0];
        $countries = [];
      $count = $this->checkAndGetValueIndex($fans_country);
        foreach($fans_country[$count - 1]['value'] as $country => $value){
            $countries[$country]['fans'] = $value;
            $countries[$country]['percentage'] = ((($value)/($total_fans))*100);
            if(array_key_exists($country, $fans_country[0]['value'])){
                $countries[$country]['growth'] = (($value) - ($fans_country[0]['value'][$country]));
                $countries[$country]['growth_percentage'] = 0;
            }else{
                $countries[$country]['growth'] = $value;
                $countries[$country]['growth_percentage'] = 0;
            }   
        }
        return $countries;
    }
    
    public function getFansByCountryTable($fans_by_country, $fans_by_country_before, $total_fans){
      	if($fans_by_country){
          $fans_country = $fans_by_country['data'][0]['values'];
          $fans_country_before = ($fans_by_country_before) ? $fans_by_country_before['data'][0]['values'][0]['value'] : null;
          $countries = [];
          $count = $this->checkAndGetValueIndex($fans_country);
          arsort($fans_country[$count]['value']);
          $top_fifteen_countries = array_slice($fans_country[$count]['value'], 0, 15);
          $countries_json = '{"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Barthelemy", "BM": "Bermuda", "BN": "Brunei", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BQ": "Bonaire, Saint Eustatius and Saba ", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "BZ": "Belize", "RU": "Russia", "RW": "Rwanda", "RS": "Serbia", "TL": "East Timor", "RE": "Reunion", "TM": "Turkmenistan", "TJ": "Tajikistan", "RO": "Romania", "TK": "Tokelau", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "PG": "Papua New Guinea", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "EE": "Estonia", "EG": "Egypt", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands", "FM": "Micronesia", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "XK": "Kosovo", "CI": "Ivory Coast", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos Islands", "CA": "Canada", "CG": "Republic of the Congo", "CF": "Central African Republic", "CD": "Democratic Republic of the Congo", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CW": "Curacao", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syria", "SX": "Sint Maarten", "KG": "Kyrgyzstan", "KE": "Kenya", "SS": "South Sudan", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "South Korea", "SI": "Slovenia", "KP": "North Korea", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "British Virgin Islands", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Laos", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "LV": "Latvia", "TO": "Tonga", "LT": "Lithuania", "LU": "Luxembourg", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libya", "VA": "Vatican", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "U.S. Virgin Islands", "IS": "Iceland", "IR": "Iran", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AQ": "Antarctica", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}';
          $countries_arr = json_decode($countries_json, true);
          foreach($top_fifteen_countries as $country_code => $value){
              $country_name = (array_key_exists($country_code, $countries_arr)) ? ($countries_arr[$country_code]) : $country_code;
              $countries[$country_name]['fans'] = $value;
              $countries[$country_name]['percentage'] = ((($value)/($total_fans))*100);
              if($fans_country_before && array_key_exists($country_code, $fans_country_before)){
                  $countries[$country_name]['growth'] = (($value) - ($fans_country_before[$country_code]));
                  $countries[$country_name]['growth_percentage'] = ((($countries[$country_name]['growth'])/($value))*100);
              }else{
                  $countries[$country_name]['growth'] = $value;
                  $countries[$country_name]['growth_percentage'] = 0;
              }   
          }
          return $countries;
        } return null;
    }
    
    public function getFansByCity($page_id, $since, $until){
        $client = $this->getClient();
        $fans_city = $client->api($page_id."/insights/page_fans_city/lifetime?since=".$since."&until=".$until, 'GET')['data'][0]['values'];
        //echo '<pre>'; var_dump($fans_city); echo '</pre>'; die;
        return $fans_city;
    }
    
	public function getFansByCityFifteenCities($fans_by_city){
      if($fans_by_city){
		$count = $this->checkAndGetValueIndex($fans_by_city);
        if(array_key_exists('value', $fans_by_city[$count])){
            arsort($fans_by_city[$count]["value"]);
			$top_fifteen_cities = (count($fans_by_city[$count]["value"]) > 15) ? (array_slice($fans_by_city[$count]["value"], 0, 15)) : ($fans_by_city[$count]["value"]);
			foreach($top_fifteen_cities as $city => $value){
				$city_exploaded = explode(', ', $city);
				$top_fifteen_cities_exploaded[$city_exploaded[0].', '.$city_exploaded[2]] = $value;
			}
		}else{
			$top_fifteen_cities_exploaded = null;
		}
      }else $top_fifteen_cities_exploaded = null;
		return $top_fifteen_cities_exploaded;
	}
	
    public function getFansByCityJsonTable($top_fifteen_cities){
		if($top_fifteen_cities){
			$fans_by_city_json_table = GoogleChartHelper::getDataTable('country', 'percentage', $top_fifteen_cities);
        }else{
            $fans_by_city_json_table = '';
        }
        return $fans_by_city_json_table;
    }
    
    public function getFansByGenderAge($page_id, $since, $until){
        $client = $this->getClient();
        $fans_gender_age = $client->api($page_id."/insights/page_fans_gender_age/lifetime?since=".$since."&until=".$until, 'GET')['data'];
        return $fans_gender_age;
    }
  
  	public function getViewsByGenderAge($page_id, $since, $until){
        $client = $this->getClient();
        $views_gender_age = $client->api($page_id."/insights/page_views_by_age_gender_logged_in_unique/day?since=".$since."&until=".$until, 'GET')['data'];
      return $views_gender_age;
    }
  
    public function getFansByAgeGenderArrays($id, $since, $until){
        $fans_gender_age = $this->getFansByGenderAge($id, $since, $until);
        if($fans_gender_age){
          	$count = $this->checkAndGetValueIndex($fans_gender_age[0]["values"]);
            $age_gender_array = array();
            $age_gender_array["female"] = $age_gender_array["male"] = $age_gender_array["age_ranges"] = array();
            $age_gender_array["female_count"] = $age_gender_array["male_count"] = 0;
            if(array_key_exists('value', $fans_gender_age[0]["values"][$count])){
               foreach($fans_gender_age[0]["values"][$count]["value"] as $key => $value){
                    if(preg_match("/F./", $key)){
                        $age_gender_array["female_count"] += $value;
                        $index = trim($key, "F.");
                        $age_gender_array["female"][$index] = $value;
                        (!in_array($index, $age_gender_array["age_ranges"])) ? ($age_gender_array["age_ranges"][] = $index) : '';
                    }elseif(preg_match("/M./", $key)){
                        $age_gender_array["male_count"] += $value;
                        $index = trim($key, "M.");
                        $age_gender_array["male"][$index] = $value;
                        (!in_array($index, $age_gender_array["age_ranges"])) ? ($age_gender_array["age_ranges"][] = $index) : '';
                    }
                }
                sort($age_gender_array["age_ranges"]);
            }else{
                $age_gender_array = '';
            }
            
            return $age_gender_array;
        }
        return $age_gender_array = null;
    }
      
      public function getPageReachByAgeGenderArrays($id, $since, $until){
        $fans_gender_age = $this->getPageReachByAgeGender($id, $since, $until);
        if($fans_gender_age){
            $age_gender_array = array();
            $age_gender_array["female"] = $age_gender_array["male"] = $age_gender_array["age_ranges"] = array();
            $age_gender_array["female_count"] = $age_gender_array["male_count"] = 0;
               foreach($fans_gender_age as $key => $value){
                    if(preg_match("/F./", $key)){
                        $age_gender_array["female_count"] += $value;
                        $index = trim($key, "F.");
                        $age_gender_array["female"][$index] = $value;
                        (!array_key_exists($index, $age_gender_array["age_ranges"])) ? ($age_gender_array["age_ranges"][$index] = $value) : ($age_gender_array["age_ranges"][$index] += $value);
                    }elseif(preg_match("/M./", $key)){
                        $age_gender_array["male_count"] += $value;
                        $index = trim($key, "M.");
                        $age_gender_array["male"][$index] = $value;
                        (!array_key_exists($index, $age_gender_array["age_ranges"])) ? ($age_gender_array["age_ranges"][$index] = $value) : ($age_gender_array["age_ranges"][$index] += $value);
                    }
                }
            
            return $age_gender_array;
        }
        return null;
    }
    
  	
    public function getViewsByAgeGenderArrays($id, $since, $until){
        $views_gender_age = $this->getViewsByGenderAge($id, $since, $until);
        if($views_gender_age){
          	$count = $this->checkAndGetValueIndex($views_gender_age[0]["values"]);
            $age_gender_array = array();
            $age_gender_array["female"] = $age_gender_array["male"] = $age_gender_array["age_ranges"] = [];
            $age_gender_array["female_count"] = $age_gender_array["male_count"] = 0;
            if(array_key_exists('value', $views_gender_age[0]["values"][$count])){
               foreach($views_gender_age[0]["values"][$count]["value"] as $key => $value){
                  $age_gender_array["female_count"] += $value['F'];
                  $age_gender_array["female"][$key] = $value['F'];
                 $age_gender_array["male_count"] += $value['M'];
                  $age_gender_array["male"][$key] = $value['M'];
                 (!array_key_exists($key, $age_gender_array["age_ranges"])) ? ($age_gender_array["age_ranges"][$key] = array_sum($value)) : ($age_gender_array["age_ranges"][$key] += array_sum($value));
                }
            }else{
                $age_gender_array = '';
            }
            return $age_gender_array;
        }
        return $age_gender_array = null;
    }
    
  
    public function getFansByAgeGenderJsonTable($age_gender_array){
        //echo '<pre>'; var_dump($age_gender_array); echo '</pre>'; die;
        $fans_gender_age_json_table = ($age_gender_array) ? GoogleChartHelper::getGenderAgesDataTable($age_gender_array["age_ranges"], $age_gender_array["male"], $age_gender_array["female"]) : '';
        return $fans_gender_age_json_table;
    }
    
    //default time 1 month (31 days)
    public function getPagePostsPaidReach($page_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_posts_paid_reach = $client->api($page_id."/insights/page_posts_impressions_paid?since=".$since."&until=".$until, 'GET')['data'];
        return $page_posts_paid_reach;
    }
    
    //default time 1 month (31 days)
    public function getPagePostsOrganicReach($page_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_posts_organic_reach = $client->api($page_id."/insights/page_posts_impressions_organic?since=".$since."&until=".$until, 'GET')['data'];
        return $page_posts_organic_reach;
    }
    
    public function getPagePostsReachJsonTable($page_id, $since = null, $until = null){
        $page_posts_paid_reach = $this->getPagePostsPaidReach($page_id, $since, $until);
        $page_posts_organic_reach = $this->getPagePostsOrganicReach($page_id, $since, $until);
        $page_posts_reach_json_table = (($page_posts_paid_reach) && ($page_posts_organic_reach)) ? GoogleChartHelper::getTwoTimeGraphsDataTable('day', 'organic impressions', 'paid impressions', $page_posts_organic_reach[0]["values"], $page_posts_paid_reach[0]["values"]) : '';
        return $page_posts_reach_json_table;
    }
    
    //default time 1 month (31 days)
    public function getPageClicks($page_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-92 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_consumptions = $client->api($page_id."/insights/page_consumptions?since=".$since."&until=".$until, 'GET')['data'];
        $page_clicks = 0;
        if($page_consumptions){
            foreach($page_consumptions[0]["values"] as $value){
                $page_clicks += $value["value"];
            }
        }
        return $page_clicks;
    }
    
    
    //use getPagePositiveFeedbacks function to get total likes, comments and shares
    public function getPageLikesCommentsShares($page_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-92 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_likes_comments_shares = array();
        $page_likes_comments_shares['shares'] = $page_likes_comments_shares['likes'] = $page_likes_comments_shares['comments'] = 0;
        $page_positive_feedback = $client->api($page_id."/insights/page_positive_feedback_by_type?since=".$since."&until=".$until)["data"];
        if($page_positive_feedback){
            foreach($page_positive_feedback[0]["values"] as $value){
                $page_likes_comments_shares['shares'] += $value["value"]["link"];
                $page_likes_comments_shares['likes'] += $value["value"]["like"];
                $page_likes_comments_shares['comments'] += $value["value"]["comment"];
            }
        }
        return $page_likes_comments_shares;
    }
    
    public function getPageEngagementPerWeek($page_id){
        $since = date('Y-m-d',strtotime('-1 week',time()));
        $until = date('Y-m-d', strtotime('+1 days', time()));
        $page_likes_comments_shares_clicks_per_week = $this->getPageLikesCommentsShares($page_id, $since, $until);
        $page_likes_comments_shares_clicks_per_week['clicks'] = $this->getPageClicks($page_id, $since, $until);
        return $page_likes_comments_shares_clicks_per_week;
    }
    
    public function getPageEngagementRatePerWeek($page_id){
        $page_engagement_per_week = Facebook::getPageEngagementPerWeek($page_id);
        $page_fans = $this->getPageData($page_id)["likes"];
        $engagement_rate_per_week = round(((array_sum($page_engagement_per_week))/($page_fans))*100);
        return $engagement_rate_per_week;
    }
    
    public function getPageEngagement($page_id, $since = null, $until = null){
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_likes_comments_shares_clicks = $this->getPageLikesCommentsShares($page_id, $since, $until);
        $page_likes_comments_shares_clicks['clicks'] = $this->getPageClicks($page_id, $since, $until);
        return $page_likes_comments_shares_clicks;
    }
    
    public function getPageEngagementRate($page_id, $since = null, $until = null){
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $page_engagement = $this->getPageEngagement($page_id, $since, $until);
        $page_fans = $this->getPageData($page_id)["likes"];
        $engagement_rate = round(((array_sum($page_engagement))/($page_fans))*100);
        return $engagement_rate;
    }
    
    //default time 1 month (31 days)
    public function getNumberOfEngagedUsers($page_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $engaged_users = $client->api($page_id."/insights/page_engaged_users?since=".$since."&until=".$until, 'GET')['data'];
        return $engaged_users;
    }
    
    public function getNumberOfEngagedUsersJsonTable($page_id, $since = null, $until = null){
        $engaged_users = $this->getNumberOfEngagedUsers($page_id, $since, $until);
        $engaged_users_json_table = ($engaged_users) ? GoogleChartHelper::getTimeDataTable('country', 'percentage', $engaged_users[0]["values"]) : '';
        return $engaged_users_json_table;
    }
    
    public function getPagePosts($page_id, $since, $until){
        $client = $this->getClient();
        $page_posts = $client->api($page_id."/posts?since=".$since."&until=".$until."&limit=100&fields=name,full_picture,link,type,message,story,picture,sharedposts,created_time,source,attachments{media}", 'GET');
        return $page_posts;
    }
    
    public function getPageFeed($page_id, $since, $until){
        $client = $this->getClient();
        //$page_posts = $client->api($page_id."/tagged?limit=100&since=".strtotime($since)."&until=".strtotime($until), 'GET');
      	$page_posts = $client->api($page_id."/feed?limit=100&since=".$since."&until=".$until, 'GET');
        return $page_posts;
    }
    
    public function getAllPagePosts($id, $since, $until){
        $all_posts = [];
        $posts = $this->getPagePosts($id, $since, $until);
        while($posts['data']){
            $all_posts = array_merge($all_posts, $posts['data']);
            $posts = json_decode(file_get_contents($posts['paging']['next']), true);
        }
        return $all_posts;
    }
    
    public function getPostDetails($post_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $post_details = $client->api($post_id."?fields=name,type,sharedposts,link,created_time,comments.summary(true),message,from,likes,full_picture,shares,story,story_tags,caption,source,attachments{description,media,title,type},event&since=".$since."&until=".$until, "GET");
        return $post_details;
    }
    
    /**
     * Get All Post insights, during the specified range of time 
     **/
    public function getPostInsights($post_id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $post_insights = $client->api($post_id."/insights?since=".$since."&until=".$until, 'GET')["data"];
        return $post_insights;
    }
    
    /**
     * Get Page Impression by story type
     **/
    public function getImpressionsByStoryType($id){
        $client = $this->getClient();
        $page_impressions_by_type = $client->api($id."/insights/page_impressions_by_story_type");
        return $page_impressions_by_type;
    }
    
    /**
     * Get page positive feedback
     **/
    public function getPagePositiveFeedback($id){
        $client = $this->getClient();
        $page_positive_feedback = $client->api($id."/insights/page_positive_feedback_by_type")["data"];
        return $page_positive_feedback;
    }
    
    /**
     * Get page negative feedback
     **/
    public function getPageNegativeFeedback($id){
        $client = $this->getClient();
        $page_negative_feedback = $client->api($id."/insights/page_negative_feedback_by_type/days_28")["data"];
        if(array_key_exists('value', $page_negative_feedback[0]["values"][count($page_negative_feedback[0]["values"])-1])){
            $negative_feedback_values = $page_negative_feedback[0]["values"][count($page_negative_feedback[0]["values"])-1]["value"];
            $negative_feedback["hide_all_clicks"] = $negative_feedback_values["hide_all_clicks"];
            $negative_feedback["hide_clicks"] = $negative_feedback_values["hide_clicks"];
            $negative_feedback["unlike_page_clicks"] = $negative_feedback_values["unlike_page_clicks"];
            $negative_feedback["report_spam_clicks"] = $negative_feedback_values["report_spam_clicks"];
        }else
            $negative_feedback = null;
        return $negative_feedback;
    }
    
    public function getActivities($id){
        $impressions = $this->getImpressionsByStoryType($id);
        $positive_feedback = $this->getPagePositiveFeedback($id);
        $activities = array(); $activities["daily_activities"] = $activities["weekly_activities"] = $activities["monthly_activities"] = array();
        //echo '<pre>'; var_dump($impressions); echo '</pre>'; die;
        $activities["daily_activities"] = $impressions[0]["values"][count($impressions[0]["values"])-1]["value"];
        $activities["daily_activities"]+= $positive_feedback[0]["values"][count($positive_feedback[0]["values"])-1]["value"];
        $activities["weekly_activities"] = $impressions[1]["values"][count($impressions[0]["values"])-1]["value"];
        $activities["weekly_activities"]+= $positive_feedback[1]["values"][count($positive_feedback[0]["values"])-1]["value"];
        $activities["monthly_activities"] = $impressions[2]["values"][count($impressions[0]["values"])-1]["value"];
        $activities["monthly_activities"]+= $positive_feedback[2]["values"][count($positive_feedback[0]["values"])-1]["value"];
        return $activities;
    }
    
    /**
     * Get Peak Time of fans online
     **/
    public function getPeakTime($id, $since = null, $until = null){
        $client = $this->getClient();
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
        $online_per_hour = $client->api($id."/insights/page_fans_online?since=".$since.'&until='.$until)["data"];
        $total_page_fans_online = array(); $total_page_fans_online = array_fill(1, 24, 0);
        foreach($online_per_hour[0]["values"] as $page_fans_online_per_day){
            if(array_key_exists('value', $page_fans_online_per_day)){
				//echo '<pre>'; var_dump($page_fans_online_per_day["value"]); echo '</pre>'; die;
                for($i = 0; $i < 24; $i++){
					$total_page_fans_online[$i+1] += $page_fans_online_per_day["value"][$i];
                }
            }
        }
        for($i = 1; $i <= 24; $i++){
            $fans_online_per_hour[$i] = round($total_page_fans_online[$i]/((strtotime($until) - strtotime($since))/86400));
        } 
        return $fans_online_per_hour;
    }
    
    /**
     * Get Peak Time Json Table
     **/
    public function getPeakTimeJsonTable($id, $since = null, $until = null){
        $fans_online_per_hour = $this->getPeakTime($id, $since, $until);
        $peak_time_json_table = GoogleChartHelper::getDataTable('hour', 'online fans', $fans_online_per_hour);
        return $peak_time_json_table;
    }
    
    public function getTest($id){
        
        $client = $this->getClient();
        //$test_results = $client->api($id."/videos")["data"];
        //$test_results = $client->api($id."/conversations");
        $test_results = $client->api($id."/insights");
        return $test_results;
    }
    
    /**
     * Get Page ID using Page Name
     **/
    public function getPageId($slug = 'SamsungEgypt'){
        $client = $this->getClient();
        $page_id = $client->api($slug);
        return $page_id;
    }
    
    /**
     * Get All Fan Adds in the specified range of time
     **/
    public function getAllFanAdds($page_id, $since, $until){
        $client = $this->getClient();
        $all_fans = $client->api($page_id."/insights/page_fan_adds?since=".$since."&until=".$until)["data"][0]['values'];
      	return $all_fans;
    }
    
    /**
     * Get All Fan Removes in the specified range of time
     **/
    public function getAllFanRemoves($page_id, $since, $until){
        $client = $this->getClient();
        $all_fans = $client->api($page_id."/insights/page_fan_removes?since=".$since."&until=".$until)["data"][0]['values'];
      	return $all_fans;
    }
    
    /**
     * Get Fan Adds And Fan Removes during the specified range of time
     **/
    public function getFansAddsAndRemoves($page_id, $since, $until){
        $fan = [];
        $fan['adds'] = $this->getAllFanAdds($page_id, $since, $until);
        $fan['removes'] = $this->getAllFanRemoves($page_id, $since, $until);
        return $fan;
    }
    
    /**
     * Get Fans Growth
     **/
    public function getFanGrowth($page_id, $since, $until){
        $net = [];
        $counter = 0;
        $fan = $this->getFansAddsAndRemoves($page_id, $since, $until);
        foreach($fan['adds'] as $fan_add){
          $date = (date('d', strtotime($fan_add['end_time'])) != '01') ?  date('d', strtotime($fan_add['end_time'])) : date('M d', strtotime($fan_add['end_time']));
          if(array_key_exists('value', $fan_add) && array_key_exists('value', $fan['removes'][$counter])){
          	$net[$date] = ($fan_add['value'] - $fan['removes'][$counter]['value']);
          }else{
            $net[$date] = null;
          }
            $counter++;
        }
        return $net;
    }
    
    /**
     * Get Fans Groth Json Table
     **/
    public function getFanGrowthJsonTable($fan_growth){
        $fan_growth_json_table = ($fan_growth) ? GoogleChartHelper::getDataTable('day', 'growth', $fan_growth) : '';
        return $fan_growth_json_table;
    }
    
    
    /**
     * Calculate net change in fans in the specified range of time
     **/
    public function getChangeInFans($fans_in_range){
      	$count = $this->checkAndGetValueIndex($fans_in_range);
      	if($count > 0 || array_key_exists('value', $fans_in_range[0])){
        	$change_in_fans = ($fans_in_range[$count]['value']) - ($fans_in_range[0]['value']);
        }else $change_in_fans = 'N/A';
        return $change_in_fans;
    }
    
    /**
     * Calculate Max Change in fans
     **/
    public function getMaxChangeInFans($fans_in_range){
        $counter = 1;
        $max = [];
        $max['value'] = 0;
        foreach($fans_in_range as $value){
            if((array_key_exists('value', $value)) && ($counter != count($fans_in_range) && (array_key_exists('value', $fans_in_range[$counter])))){
                $diff = $fans_in_range[$counter]['value'] - $value['value'];
                if(abs($diff) > abs($max['value'])){
                    $max['value'] = $diff;
                    $max['date'] = $fans_in_range[$counter]['end_time'];
                }
            }
            $counter++;
        }
        return $max;
    }
    
    /**
     * Returns post constant value using corresponding type
     **/
    public function getPostType($type){
        switch ($type){
            case 'photo':
                $post_type = self::IMAGE;
                break;
            case 'video':
                $post_type = self::VIDEO;
                break;
            case 'status':
                $post_type = self::STATUS;
                break;
            case 'link':
                $post_type = self::LINK;
                break;
            case 'event':
                $post_type = self::EVENT;
                break;
            case 'offer':
                $post_type = self::OFFER;
                break;
        }
        return $post_type;
    }
    
    /**
     * Returns post type using corresponding constant value
     **/
    public function getPostTypeName($type){
        switch ($type){
            case self::IMAGE:
                $post_type = 'photo';
                break;
            case self::VIDEO:
                $post_type = 'video';
                break;
            case self::STATUS:
                $post_type = 'status';
                break;
            case self::LINK:
                $post_type = 'link';
                break;
            case self::EVENT:
                $post_type = 'event';
                break;
            case self::OFFER:
                $post_type = 'offer';
                break;
        }
        return $post_type;
    }
    
    public function getPostInteractionsCount($id){
        $client = $this->getClient();
        $interactions = $client->api($id."/insights/post_stories")['data'][0]['values'][0]['value'];
        return $interactions;
    }
    
    /**
     * Get Page Stories By Action Type [like-comment-share]
     **/
    public function getPageStoriesByActionType($id){
        $client = $this->getClient();
        $stories = $client->api($id."/insights/post_stories_by_action_type");
        return $stories;
    }
    
    /**
     * Get Post Reactions By Type
     **/
    public function getPostReactionsByType($id){
        $client = $this->getClient();
        $reactions = $client->api($id."/insights/post_reactions_by_type_total");
        return $reactions;
    }
    
    /**
     * Save posts in database when user uses the app for the first time
     **/
    public function firstLogNewPostModel($oAccountModel, $post, $followers){
        $stories = $this->getPageStoriesByActionType($post['id'])['data'][0]['values'][0]['value'];
        $reactions = array_sum($this->getPostReactionsByType($post['id'])['data'][0]['values'][0]['value']);
        $oPostModel = new Model();
        $oPostModel->authclient_id = $oAccountModel->authclient_id;
        $oPostModel->parent_id = $oAccountModel->id;
        $oPostModel->entity_id = $post["id"];
        $oPostModel->type = self::POST;
        $oPostModel->post_type = $this->getPostType($post['type']);
        if(array_key_exists('full_picture', $post)){
            $oPostModel->media_url = $post['full_picture'];
        }
	if(array_key_exists('message', $post)){
            $oPostModel->content = $post['message'];
	}elseif(array_key_exists('story', $post)){
            $oPostModel->content = $post['story'];
	}
        $oPostModel->likes = (array_key_exists('like' , $stories) ? $stories['like'] : 0);
        $oPostModel->comments = (array_key_exists('comment' , $stories) ? $stories['comment'] : 0);
        $oPostModel->shares = (array_key_exists('share' , $stories) ? $stories['share'] : 0);
        $oPostModel->reactions = $reactions;
        $oPostModel->interactions = $this->getPostInteractionsCount($post['id']);
        $oPostModel->creation_time = strtotime($post["created_time"]);
        $oPostModel->followers = $followers;
        $oPostModel->url = (array_key_exists('link' , $post) ? $post["link"] : null);
        //echo '<pre>'; var_dump($this->getAllFans($oAccountModel->id, date('Y-m-d', time()), date('Y-m-d', strtotime('+1 days', time())))); echo '</pre>'; die;
        $oPostModel->save();
        return $oPostModel;
    }
    
    public function updatePostModel($oPostModel){
        $stories = $this->getPageStoriesByActionType($oPostModel->entity_id)['data'][0]['values'][0]['value'];
        $reactions = array_sum($this->getPostReactionsByType($oPostModel->entity_id)['data'][0]['values'][0]['value']);
        $oPostModel->likes = (array_key_exists('like' , $stories) ? $stories['like'] : 0);
        $oPostModel->comments = (array_key_exists('comment' , $stories) ? $stories['comment'] : 0);
        $oPostModel->shares = (array_key_exists('share' , $stories) ? $stories['share'] : 0);
        $oPostModel->reactions = $reactions;
        $oPostModel->interactions = $this->getPostInteractionsCount($oPostModel->entity_id);
        $oPostModel->update();
        return $oPostModel;
    }
	
    /**
     * First Time To Log function, that gets all user's content and saves them in the database
     **/
    public function firstTimeToLog($id, $authclient_id){
        $page_data = $this->getPageData($id);
        $oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $page_data["id"];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $page_data["name"];
        $oAccountModel->media_url = $page_data["picture"]["data"]["url"];
        if($oAccountModel->save()){
            $since = date('Y-m-d', strtotime("first day of this month"));
            $until = date('Y-m-d', time());
            $all_posts = $this->getAllPagePosts($id, $since, $until);
            $total_likes = $total_comments = $total_reactions = $total_shares = $total_reactions = $total_interactions = 0;
            if($all_posts){
                $followers_by_day = array();
                $followers = $this->getAllFans($id, $since, $until)[0]['values'];
                foreach($followers as $value){
                    if(array_key_exists('value', $value)){
                        $followers_by_day[date('Y-m-d', strtotime($value['end_time']))] = $value['value'];
                    }
                }
                foreach($all_posts as $post){
                    $post_followers = (array_key_exists(date('Y-m-d', strtotime($post["created_time"])), $followers_by_day)) ? $followers_by_day[date('Y-m-d', strtotime($post["created_time"]))] : null;
                    $oPostModel = $this->firstLogNewPostModel($oAccountModel, $post, $post_followers);
                    $total_likes += $oPostModel->likes;
                    $total_comments += $oPostModel->comments;
                    $total_shares += $oPostModel->shares;
                    $total_reactions += $oPostModel->reactions;
                    $total_interactions += $oPostModel->interactions;
                }
            }
            $oAccountInsights = new Insights();
            $oAccountInsights->model_id = $oAccountModel->id;
            $oAccountInsights->followers = $page_data["likes"];
            $oAccountInsights->number_of_posted_media = count($all_posts);
            $oAccountInsights->total_likes = $total_likes;
            $oAccountInsights->total_comments = $total_comments;
            $oAccountInsights->total_shares = $total_shares;
            $oAccountInsights->total_reactions = $total_reactions;
            $oAccountInsights->total_interactions = $total_interactions;
          	$oAccountInsights->insights_json = $this->getInsightsJson($oAccountModel->entity_id, $since, $until);
            if($oAccountInsights->save()){
                $this->saveUserPosts($id, $oAccountModel->id, $since, $until);
            }
        
        }else{
            echo'<pre>'; var_dump($oAccountModel); echo '</pre>'; die("couldn't save model");
        }
    }
    
    /**
     * Get fans posts in database
     **/
    public function getAllUserPosts($id, $since, $until){
      	$all_posts = [];
        $posts = $this->getPageFeed($id, $since, $until);
        while($posts['data']){
            $all_posts = array_merge($all_posts, $posts['data']);
            $posts = json_decode(file_get_contents($posts['paging']['next']), true);
        }
      	$all_posts = array_merge($all_posts, $posts['data']);
        return $all_posts;
    }
  
  	/**
     * Get User Post
     **/
    public function getUserPost($id){
		$client = $this->getClient();
		$post_details = $client->api($id);
        return $post_details;
    }
	
    /**
     * Save fans posts in database
     **/
    public function saveUserPosts($page_id, $page_model_id, $since, $until){
        $all_user_posts = $this->getAllUserPosts($page_id, $since, $until);
        foreach($all_user_posts as $user_post){
          	if(! Model::findOne(['parent_id' => $page_model_id, 'entity_id' => $user_post['id']])){
            	$oUserPost = UserPosts::findOne(['post_id' => $user_post['id']]);
              if(!$oUserPost){
                  $oUserPost = new UserPosts();
                  $oUserPost->page_model_id = $page_model_id;
                  $oUserPost->post_id = $user_post['id'];
                  $oUserPost->creation_time = strtotime($user_post['created_time']);
                  $oUserPost->save();
              }
           }
        }
    }
    
    /**
     * Retrieve user posts from db in the specified range of time 
     **/
    public function getUserPostsInRange($page_id, $since, $until){
        $oPage = Model::findOne(['entity_id' => $page_id]);
        //var_dump($since); die;
        $user_posts_in_range = UserPosts::find()->Where(['page_model_id' => $oPage->id])->andWhere(['between', 'creation_time', $since, $until])->all();
        return $user_posts_in_range;
    }
    
    /**
     * Get User Posts Per Day
     **/
    public function getUserPostsByDay($days_in_range, $page_id, $since, $until){
        $user_posts_in_range = $this->getUserPostsInRange($page_id, $since, $until);
        //echo '<pre>'; var_dump($user_posts_in_range); echo '</pre>'; die;
        $user_posts_per_day = [];
        foreach($days_in_range as $day){
            $date_day = date('M d', $day);
            $refine_date = date('d', $day);
            $date = ($refine_date != '01') ?  $refine_date : $date_day;
            $user_posts_per_day[$date] = 0;
            foreach($user_posts_in_range as $user_post){
                if((date('M d', $user_post->creation_time)) == $date_day){
                    $user_posts_per_day[$date] ++;
                }
            }
        }
        //echo '<pre>'; var_dump($user_posts_per_day); echo '</pre>'; die;
        return $user_posts_per_day;
    }
    
    /**
     * Get User Posts Per Day Json Table
     **/
    public function getUserPostsByDayJsonTable($user_posts_per_day){
        //echo '<pre>'; var_dump($user_posts_per_day); echo '</pre>'; die;
        $user_posts_per_day_json_table =  ($user_posts_per_day) ? GoogleChartHelper::getDataTable('day', 'user posts', $user_posts_per_day) : '';
        return $user_posts_per_day_json_table;
    }
    
    /**
     * Retrieve page posts from db in the specified range of time 
     **/
    public function getPostsInRange($page_id, $since, $until){
        $parent_id = Model::findOne(['entity_id' => $page_id])->id;
        $posts_in_range = Model::find()->Where(['parent_id' => $parent_id])->andWhere(['between', 'creation_time', $since, $until])->orderBy(['interactions' => SORT_DESC])->all();
        return $posts_in_range;
    }
    
    /**
     * get array of days in the specified range of days 
     **/
    public function getDaysInRange($from, $to){
        $days_in_range = [];
        $current = $from/*strtotime('+1 days', $from)*/;
      	//$days_in_range_date = [];
        while($current <= $to){
            array_push($days_in_range, $current);
          	//array_push($days_in_range_date, date('d M', $current));
            $current = strtotime('+1 days', $current);
        }
        return $days_in_range;
    }
    
    /**
     * Get json table of the page posts
     **/
    public function getPagePostsJsonTable($page_posts_by_day){
        $page_posts_by_day_json_table = ($page_posts_by_day) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'posts', $page_posts_by_day, 'posts') : '';
        return $page_posts_by_day_json_table;
    }
    
    /**
     * Get json table of the page engagement
     **/
    public function getPageEngagementJsonTable($page_engagement_by_day){
        //echo '<pre>'; var_dump($page_engagement_by_day); echo '</pre>'; die;
        $page_engagement_by_day_json_table = ($page_engagement_by_day) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'interaction per 1000 fans', $page_engagement_by_day, 'engagement') : '';
        return $page_engagement_by_day_json_table;
    }
    
    /**
     * Get json table of the page interactions
     **/
    public function getPageInteractionJsonTable($page_interaction_by_day){
        $page_interaction_by_day_json_table = ($page_interaction_by_day) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'Daily Interaction', $page_interaction_by_day, 'interactions') : '';
        return $page_interaction_by_day_json_table;
    }
    
    /**
     * Get json table of the post types
     **/
    public function getPostTypesJsonTable($post_types){
        $post_types_json_table = ($post_types) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('type', 'value', $post_types, 'value') : '';
        return $post_types_json_table;
    }
    
    /**
     * Get json table of the most engaging post types
     **/
    public function getMostEngagingPostTypesJsonTable($post_types){
        $most_engaging_post_types_json_table = ($post_types) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('type', 'value', $post_types, 'interaction') : '';
        return $most_engaging_post_types_json_table;
    }
    
    /**
     * Get statistics posts by day
     **/
    public function getPostsByDayStatistics($days_in_range, $posts_in_range){
        $statistics = array();
        $types_array = ['value' => 0, 'interaction' => 0, 'engagement' => 0];
        $statistics['posts_by_day'] = array(); $statistics['post_types'] = [
            'photo' => $types_array, 'video' => $types_array, 'status' => $types_array, 'event' => $types_array, 'link' => $types_array, 'offer' => $types_array
            ];
        $statistics['total_posts_count'] = count($posts_in_range);
        $statistics['total_interactions_count'] = $statistics['max_interaction'] = $statistics['max_interaction_day'] = 0;
        $statistics['min_interaction'] = $posts_in_range[0]->interactions; $statistics['min_interaction_day'] = date('M d, y', $posts_in_range[0]->creation_time);
        $statistics['total_likes_count'] = $statistics['total_reactions_count'] = $statistics['total_comments_count'] = $statistics['total_shares_count'] = 0;
        foreach($days_in_range as $day){
            $refine_date = date('d', $day);
            $date_day = date('M d', $day);
            $date = (($refine_date != '01') ? $refine_date : $date_day);
            $statistics['posts_by_day'][$date] = [];
            $statistics['posts_by_day'][$date]['posts'] = 0;
            $statistics['posts_by_day'][$date]['reactions'] = 0;
            $statistics['posts_by_day'][$date]['likes'] = 0;
            $statistics['posts_by_day'][$date]['comments'] = 0;
            $statistics['posts_by_day'][$date]['shares'] = 0;
            $statistics['posts_by_day'][$date]['interactions'] = 0;
            $statistics['posts_by_day'][$date]['followers'] = 0;
            $statistics['posts_by_day'][$date]['engagement'] = 0;
            foreach($posts_in_range as $post){
                //echo '<pre>'; var_dump(date('Y-m-d', $post->creation_time)); echo '</pre>'; die;
                if(date('M d', $post->creation_time) == $date_day){
                    $statistics['post_types'][$this->getPostTypeName($post->post_type)]['value']++;
                    $statistics['posts_by_day'][$date]['posts']++;
                    $statistics['posts_by_day'][$date]['reactions'] += $post->reactions;
                    $statistics['total_reactions_count'] += $post->reactions;
                    $statistics['posts_by_day'][$date]['likes'] += $post->likes;
                    $statistics['total_likes_count'] += $post->likes;
                    $statistics['posts_by_day'][$date]['comments'] += $post->comments;
                    $statistics['total_comments_count'] += $post->comments;
                    $statistics['posts_by_day'][$date]['shares'] += $post->shares;
                    $statistics['total_shares_count'] += $post->shares;
                    $statistics['posts_by_day'][$date]['interactions'] += $post->interactions;
                    if($post->interactions > $statistics['max_interaction']){
                        $statistics['max_interaction'] = $post->interactions;
                        $statistics['max_interaction_day'] = date('M d, y', $post->creation_time);
                    }
                    if($post->interactions < $statistics['min_interaction']){
                        $statistics['min_interaction'] = $post->interactions;
                        $statistics['min_interaction_day'] = date('M d, y', $post->creation_time);
                    }
                    $statistics['total_interactions_count'] += $post->interactions;
                    $statistics['post_types'][$this->getPostTypeName($post->post_type)]['interaction'] += $post->interactions;
                    $statistics['posts_by_day'][$date]['engagement'] += (($post->followers) ? round((((($post->interactions)/($post->followers)) * 1000)*100),1) : 0);
                    $statistics['post_types'][$this->getPostTypeName($post->post_type)]['engagement'] += $statistics['posts_by_day'][$date]['engagement'];
                }
            }
        }
        //echo '<pre>'; var_dump($statistics); echo '</pre>'; die;
        return $statistics;
    }
    
    public function statistics($id, $total_fans, $since, $until){
        $days_in_range = $this->getDaysInRange($since, $until);
        $statistics['fans_lang'] = $this->getFansLanguage($id, $since, $until);
        $statistics['age_gender_array'] = $this->getFansByAgeGenderArrays($id, $since, $until);
        $statistics['fans_growth'] = $this->getFanGrowth($id, $since, $until);
        $statistics['fans_in_range'] = $this->getAllFans($id, $since, $until);
        $statistics['change_in_fans'] = ($statistics['fans_in_range']) ? $this->getChangeInFans($statistics['fans_in_range'][0]['values']) : 0;
        $statistics['max_change_in_fans'] = ($statistics['fans_in_range']) ? $this->getMaxChangeInFans($statistics['fans_in_range'][0]['values']) : 0;
        $statistics['avg_fan_change_per_day'] = ($statistics['change_in_fans'] != 'N/A') ? round((($statistics['change_in_fans'])/(count($statistics['fans_in_range'][0]['values']))), 2) : 0;
        $fans_by_country = $this->getFansByCountry($id, $since, $until);
      	$fans_by_country_before = $this->getFansByCountryBefore($id, $since);
      	$statistics['fans_by_country'] = ($fans_by_country['data']) ? $fans_by_country : null;
        $statistics['fans_by_country_before'] = ($fans_by_country_before['data']) ? $fans_by_country_before : null;
      	$statistics['fans_by_city'] = $this->getFansByCity($id, $since, $until);
        $statistics['posts_in_range'] = $this->getPostsInRange($id, $since, $until);
        $statistics['fans_by_country_table'] = $this->getFansByCountryTable($statistics['fans_by_country'], $statistics['fans_by_country_before'], $total_fans);
        $statistics['posts_by_day_statistics'] = $this->getPostsByDayStatistics($days_in_range, $statistics['posts_in_range']);
        $statistics['user_posts_per_day'] = $this->getUserPostsByDay($days_in_range, $id, $since, $until);
        $statistics['user_posts_per_day_json_table'] = $this->getUserPostsByDayJsonTable($statistics['user_posts_per_day']);
        return $statistics;
    }
    
    /***
     * compares insights of current month with last month's
     */
    public function getComparisonInsights($id){
        $client = $this->getClient();
        $comparison = [];
        $comparison_points = ['newlikes' => 0, 'dislikes' => 0, 'netlikes' => 0, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'post_reach' => 0];
        $comparison['last_month'] = $comparison['this_month'] = [
            'total' => $comparison_points,
            'paid' => $comparison_points,
            'unpaid' => $comparison_points,
        ];
        
        $first_day_last_month = date('Y-m-2', (strtotime('first day of last month')));
        $last_day_last_month = date('Y-m-d', (strtotime('first day of this month')));
        $first_day_this_month = date('Y-m-2', (strtotime('first day of this month')));
        $today = (strtotime(date('Y-m-d', time())) > (strtotime($first_day_this_month))) ? date('Y-m-d', time()) : (date($first_day_this_month, strtotime('+1 days')));
        
        $new_likes_last_month = $client->api($id."/insights/page_fan_adds_by_paid_non_paid_unique/day?since=".$first_day_last_month."&until=".$last_day_last_month)["data"];
        if(array_key_exists(0, $new_likes_last_month)){
            foreach($new_likes_last_month[0]['values'] as $new_like){
                if(array_key_exists('value', $new_like)){
                    $comparison['last_month']['total']['newlikes'] += $new_like['value']['total'];
                    $comparison['last_month']['paid']['newlikes'] += $new_like['value']['paid'];
                    $comparison['last_month']['unpaid']['newlikes'] += $new_like['value']['unpaid'];
                }
            }
        }
        $new_likes_this_month = $client->api($id."/insights/page_fan_adds_by_paid_non_paid_unique/day?since=".$first_day_this_month."&until=".$today)["data"];
        if(array_key_exists(0, $new_likes_this_month)){
            foreach($new_likes_this_month[0]['values'] as $new_like){
                if(array_key_exists('value', $new_like)){
                    $comparison['this_month']['total']['newlikes'] += $new_like['value']['total'];
                    $comparison['this_month']['paid']['newlikes'] += $new_like['value']['paid'];
                    $comparison['this_month']['unpaid']['newlikes'] += $new_like['value']['unpaid'];
                }
            }
        }

        $new_dislikes_last_month = $client->api($id."/insights/page_fan_removes_unique/day?since=".$first_day_last_month."&until=".$last_day_last_month)["data"];
        if(array_key_exists(0, $new_dislikes_last_month)){
            foreach($new_dislikes_last_month[0]['values'] as $new_like){
                if(array_key_exists('value', $new_like)){
                    $comparison['last_month']['total']['dislikes'] += $new_like['value'];
                }
            }
        }
        $new_dislikes_this_month = $client->api($id."/insights/page_fan_removes_unique/day?since=".$first_day_this_month."&until=".$today)["data"];
        if(array_key_exists(0, $new_dislikes_this_month)){
            foreach($new_dislikes_this_month[0]['values'] as $new_like){
                if(array_key_exists('value', $new_like)){
                    $comparison['this_month']['total']['dislikes'] += $new_like['value'];
                }
            }
        }
        $comparison['last_month']['total']['netlikes'] = ($comparison['last_month']['total']['newlikes']) - ($comparison['last_month']['total']['dislikes']);
        $comparison['this_month']['total']['netlikes'] = ($comparison['this_month']['total']['newlikes']) - ($comparison['this_month']['total']['dislikes']);
        $page_posts_reach_last_month = $client->api($id."/insights/page_impressions_by_paid_non_paid/day?since=".$first_day_last_month."&until=".$last_day_last_month)["data"];
        if(array_key_exists(0, $page_posts_reach_last_month)){
            foreach($page_posts_reach_last_month[0]['values'] as $new_reach){
                if(array_key_exists('value', $new_reach)){
                    $comparison['last_month']['total']['post_reach'] += $new_reach['value']['total'];
                    $comparison['last_month']['paid']['post_reach'] += $new_reach['value']['paid'];
                    $comparison['last_month']['unpaid']['post_reach'] += $new_reach['value']['unpaid'];
                }
            }
        }
        $page_posts_reach_this_month = $client->api($id."/insights/page_impressions_by_paid_non_paid_unique/day?since=".$first_day_this_month."&until=".$today)["data"];
        if(array_key_exists(0, $page_posts_reach_this_month)){
            foreach($page_posts_reach_this_month[0]['values'] as $new_reach){
                if(array_key_exists('value', $new_reach)){
                    $comparison['this_month']['total']['post_reach'] += $new_reach['value']['total'];
                    $comparison['this_month']['paid']['post_reach'] += $new_reach['value']['paid'];
                    $comparison['this_month']['unpaid']['post_reach'] += $new_reach['value']['unpaid'];
                }
            }
        }
        $page_positive_feedbacks_last_month = $client->api($id."/insights/page_positive_feedback_by_type_unique/day?since=".$first_day_last_month."&until=".$last_day_last_month)['data'];
        if(array_key_exists(0, $page_positive_feedbacks_last_month)){
            foreach($page_positive_feedbacks_last_month[0]['values'] as $positive_feedback){
                if(array_key_exists('value', $new_reach)){
                    $comparison['last_month']['total']['shares'] += $positive_feedback['value']['link'];
                    $comparison['last_month']['total']['likes'] += $positive_feedback['value']['like'];
                    $comparison['last_month']['total']['comments'] += $positive_feedback['value']['comment'];
                }
            }
        }
        $page_positive_feedbacks_this_month = $client->api($id."/insights/page_positive_feedback_by_type_unique/day?since=".$first_day_this_month."&until=".$today)['data'];
        if(array_key_exists(0, $page_positive_feedbacks_this_month)){
            foreach($page_positive_feedbacks_this_month[0]['values'] as $positive_feedback){
                if(array_key_exists('value', $new_reach)){
                    $comparison['this_month']['total']['shares'] += $positive_feedback['value']['link'];
                    $comparison['this_month']['total']['likes'] += $positive_feedback['value']['like'];
                    $comparison['this_month']['total']['comments'] += $positive_feedback['value']['comment'];
                }
            }
        }
        return $comparison;
    }
    
    public function test($page_id, $since = '', $until = ''){
        $client = $this->getClient();
        //($since)? '' : $since = strtotime('2015-11-15');
        //($until)? '' : $until = strtotime('2016-01-30');
        
        //$fans_gender_age = $client->api($page_id."/insights/page_fans_gender_age/lifetime?since=".$since."&until=".$until)['data'];
        return $this->getFansByAgeGenderArrays($page_id, $since, $until);
    }
	
    public function getAccountInsightsInRange($account_model_id, $since, $until){
	$since_str = date('Y-m-d H:i:s', strtotime('last day of last monyh'));
	$until_str = date('Y-m-d H:i:s', $until);
	$account_insights = Insights::find()->Where(['model_id' => $account_model_id])->andWhere(['between', 'created', $since_str, $until_str])->all();
	return $account_insights;
    }

    public function saveAccountInsights($oAccountModel, $followers){
	$since = date('Y-m-d', strtotime('first day of this month'));
	$until = date('Y-m-d', strtotime('+1days', time()));
	$posts = $this->getAllPagePosts($oAccountModel->entity_id, $since, $until); 
	$total_likes = $total_comments = $total_reactions = $total_shares = $total_reactions = $total_interactions = 0;
	foreach($posts as $post){
            $oPost = Model::findOne(['entity_id' => $post['id'],'parent_id' => $oAccountModel->id]);
            if(!$oPost){
				$oPostModel = $this->firstLogNewPostModel($oAccountModel, $post, $followers);
                $total_likes += $oPostModel->likes;
                $total_comments += $oPostModel->comments;
                $total_shares += $oPostModel->shares;
                $total_reactions += $oPostModel->reactions;
                $total_interactions += $oPostModel->interactions;
            }else{

		$oPostModel = $this->updatePostModel($oPost);
		$total_likes += $oPostModel->likes;
                $total_comments += $oPostModel->comments;
                $total_shares += $oPostModel->shares;
                $total_reactions += $oPostModel->reactions;
                $total_interactions += $oPostModel->interactions;
            }
	}
      
	$oAccountInsights = new Insights();
        $oAccountInsights->model_id = $oAccountModel->id;
        $oAccountInsights->followers = $followers;
        $oAccountInsights->number_of_posted_media = count($posts);
        $oAccountInsights->total_likes = $total_likes;
        $oAccountInsights->total_comments = $total_comments;
        $oAccountInsights->total_shares = $total_shares;
        $oAccountInsights->total_reactions = $total_reactions;
        $oAccountInsights->total_interactions = $total_interactions;
	$oAccountInsights->insights_json = $this->getInsightsJson($oAccountModel->entity_id, $since, $until);
      
        if($oAccountInsights->save()){
            $this->saveUserPosts($oAccountModel->entity_id, $oAccountModel->id, $since, $until);
        }
    }
	
  	public function getPageFansLikeSource($id, $since, $until){
    	$client = $this->getClient();
      	$fans_by_source_req = $client->api($id.'/insights/page_fans_by_like_source?since='.$since.'&until='.$until)['data'];
      	if($fans_by_source_req){
        	$fans_by_source = $fans_by_source_req[0]['values'];
          	$fans_by_source_array = [];
            foreach($fans_by_source as $day){
                if(array_key_exists('value', $day)){
                  foreach($day['value'] as $key => $value){
                    (array_key_exists($key, $fans_by_source_array)) ? ($fans_by_source_array[$key] = $value) : ($fans_by_source_array[$key] += $value);
                  }
                }
            }
        return $fans_by_source_array;
        }else return null;
    }
  
    public function getPageViewsByDevice($id, $since, $until){
        $client = $this->getClient();
      	$views_by_device_req = $client->api($id.'/insights/page_views_by_site_logged_in_unique?since='.$since.'&until='.$until)['data'];
      	if($views_by_device_req){
        $views_by_device = $views_by_device_req[0]['values'];
        if($views_by_device){
        	$views_by_device_array = ['desktop' => 0, 'mobile/tablet' => 0, 'other' => 0];
            foreach($views_by_device as $day){
                if(array_key_exists('value', $day)){
                    $views_by_device_array['desktop'] += $day['value']['WWW'];
                    $views_by_device_array['mobile/tablet'] += $day['value']['MOBILE'];
                    $views_by_device_array['other'] += ($day['value']['OTHER'] + $day['value']['OTHER']['API']);
                }
            }
          return $views_by_device_array;
        }else return null;
    }else return null;
    }
    
    public function getPageReachArray($page_id, $since = null, $until = null){
        $client = $this->getClient();
        $page_reach = ['organic' => 0, 'paid' => 0, 'unpaid' => 0];
        ($since)? '' : $since = date('Y-m-d',strtotime('-30 days',time()));
        ($until)? '' : $until = date('Y-m-d',strtotime('+1 days',time()));
      	$page_paid_unpaid_reach_req = $client->api($page_id."/insights/page_impressions_by_paid_non_paid/day?since=".$since."&until=".$until, 'GET')['data'];
      	if($page_paid_unpaid_reach_req){
          $page_paid_unpaid_reach = $page_paid_unpaid_reach_req[0]['values'];
          foreach($page_paid_unpaid_reach as $day){
              if(array_key_exists('value', $day)){
                  $page_reach['paid'] += $day['value']['paid'];
                  $page_reach['unpaid'] += $day['value']['unpaid'];
                  $page_reach['organic'] += $day['value']['total'];
              }
          }
        }
        return $page_reach;
    }
	
    public function getPageReachByCountry($page_id, $since, $until){
        $client = $this->getClient();
      	$reach_by_country_req = $client->api($page_id.'/insights/page_impressions_by_country_unique/day?since='.$since.'&until='.$until)['data'];
      if($reach_by_country_req){
        $reach_by_country = $reach_by_country_req[0]['values'];
      	$counter = $this->checkAndGetValueIndex($reach_by_country);
      	if(array_key_exists('value', $reach_by_country[$count])){
        	return ((array_key_exists('value', $reach_by_country[$counter])) ? $reach_by_country[$counter]['value'] : null);
        }else{
        	return null;
        }
      }else return null;
    }
  
  public function getPageReachByAgeGender($page_id, $since, $until){
        $client = $this->getClient();
    	$reach_by_gender_age_req = $client->api($page_id.'/insights/page_impressions_by_age_gender_unique/day?since='.$since.'&until='.$until)['data'];
    	if($reach_by_gender_age_req){
          $reach_by_gender_age = $reach_by_gender_age_req[0]['values'];
          $counter = $this->checkAndGetValueIndex($reach_by_gender_age);
          if(array_key_exists('value', $reach_by_gender_age[$count])){
              return ((array_key_exists('value', $reach_by_gender_age[$counter])) ? $reach_by_gender_age[$counter]['value'] : null);
          }else{
              return null;
          }
        }else return null;
    }
  
  public function getPageReachByLanguage($page_id, $since, $until){
        $client = $this->getClient();
    	$reach_by_lang_req = $client->api($page_id.'/insights/page_impressions_by_locale_unique/day?since='.$since.'&until='.$until)['data'];
    	if($reach_by_lang_req){
          $reach_by_lang = $reach_by_lang_req[0]['values'];
          $counter = $this->checkAndGetValueIndex($reach_by_lang);
          if(array_key_exists('value', $reach_by_lang[$count])){
              return ((array_key_exists('value', $reach_by_lang[$counter])) ? $reach_by_lang[$counter]['value'] : null);
          }else{
              return null;
          }
        }else return null;
    }
  
  public function getPageReachByLanguageInEnglish($page_id, $since, $until){
  	$reach_by_language= $this->getPageReachByLanguage($page_id, $since, $until);
    $languages_lib = ["af_ZA" => "Afrikaans (South Africa)", "ak_GH" => "Akan (Ghana)", "am_ET" => "Amharic (Ethiopia)", "ar_AR" => "Arabic", "as_IN" => "Assamese (India)", "ay_BO" => "Aymara (Bolivia)", "az_AZ" => "Azerbaijani (Azerbaijan (latin))", "be_BY" => "Belarusian (Belarus)", "bg_BG" => "Bulgarian (Bulgaria)", "bn_IN" => "Bengali (India)", "br_FR" => "Breton (France)", "bs_BA" => "Bosnian (Bosnia)", "ca_ES" => "Catalan (Spain)", "cb_IQ" => "Sorani Kurdish", "ck_US" => "Cherokee (USA)", "co_FR" => "Corsican", "cs_CZ" => "Czech", "cx_PH" => "Cebuano", "cy_GB" => "Welsh (Britain)", "da_DK" => "Danish (Denmark)", "de_DE" => "German (Germany)", "el_GR" => "Greek (Greece)", "en_GB" => "English (UK)", "en_IN" => "English (India)", "en_PI" => "English (Pirate)", "en_UD" => "English (Upside Down)", "en_US" => "English (USA)", "eo_EO" => "Esperanto", "es_CL" => "Spanish (Chile)", "es_CO" => "Spanish (Colombia)", "es_ES" => "Spanish (Spain)", "es_LA" => "Spanish", "es_MX" => "Spanish (Mexico)", "es_VE" => "Spanish (Venezuela)", "et_EE" => "Estonian (Estonia)", "eu_ES" => "Basque (Spain)", "fa_IR" => "Persian (Iran)", "fb_LT" => "Leet Speak", "ff_NG" => "Fulah", "fi_FI" => "Finnish (Finland)", "fo_FO" => "Faroese (Faroe Islands)", "fr_CA" => "French (Canada)", "fr_FR" => "French (France)", "fy_NL" => "Frisian (Netherlands)", "ga_IE" => "Irish (Ireland)", "gl_ES" => "Galician (Spain)", "gn_PY" => "Guarani (Paraguay)", "gu_IN" => "Gujarati (India)", "gx_GR" => "Greek (Greece)", "ha_NG" => "Hausa (Nigeria)", "he_IL" => "Hebrew (Israel)", "hi_IN" => "Hindi (India)", "hr_HR" => "Croatian (Croatia)", "ht_HT" => "Haitian (Haiti)", "hu_HU" => "Hungarian (Hungary)", "hy_AM" => "Armenian (Armenia)", "id_ID" => "Indonesian (Indonesia)", "ig_NG" => "Igbo (Nigeria)", "is_IS" => "Icelandic (Iceland)", "it_IT" => "Italian (Italy)", "ja_JP" => "Japanese (Japan)", "ja_KS" => "Japanese (Kansai)", "jv_ID" => "Javanese", "ka_GE" => "Georgian (Georgia)", "kk_KZ" => "Kazakh (Kazakhstan)", "km_KH" => "Khmer (Cambodia)", "kn_IN" => "Kannada (India)", "ko_KR" => "Korean (Korea)", "ku_TR" => "Kurdish-Latin (Turkey)", "ky_KG" => "Kyrgyz (Kyrgyzstan)", "la_VA" => "Latin", "lg_UG" => "Ganda (Uganda)", "li_NL" => "Limburgish (Netherlands)", "ln_CD" => "Lingala (Congo)", "lo_LA" => "Lao (Laos)", "lt_LT" => "Lithuanian (Lithuania)", "lv_LV" => "Latvian (Latvia)", "mg_MG" => "Malagasy (Madagascar)", "mi_NZ" => "Māori (New Zealand)", "mk_MK" => "Macedonian (Macedonia)", "ml_IN" => "Malayalam (India)", "mn_MN" => "Mongolian (Mongolia)", "mr_IN" => "Marathi (India)", "ms_MY" => "Malay (Malaysia)", "mt_MT" => "Maltese (Malta)", "my_MM" => "Burmese (Myanmar)", "nb_NO" => "Norwegian-bokmal (Norway)", "nd_ZW" => "Ndebele", "ne_NP" => "Nepali (Nepal)", "nl_BE" => "Dutch (Belgium)", "nl_NL" => "Dutch (Netherlands)", "nn_NO" => "Norwegian-nynorsk (Norway)", "ny_MW" => "Chewa", "or_IN" => "Oriya (India)", "pa_IN" => "Punjabi (India)", "pl_PL" => "Polish", "ps_AF" => "Pashto (Afghanistan)", "pt_BR" => "Portuguese (Brazil)", "pt_PT" => "Portuguese (Portugal)", "qc_GT" => "Quiché", "qu_PE" => "Quechua", "rm_CH" => "Romansh", "ro_RO" => "Romanian (Romania)", "ru_RU" => "Russian (Russia)" ,"rw_RW" => "Kinyarwanda (Rwanda)", "sa_IN" => "Sanskrit (India)", "sc_IT" => "Sardinian (Italy)", "se_NO" => "Northern Sámi (Norway)", "si_LK" => "Sinhala (Sri Lanka)", "sk_SK" => "Slovak (Slovak)", "sl_SI" => "Slovenian (Slovenia)", "sn_ZW" => "Shona", "so_SO" => "Somali (Somalia)", "sq_AL" => "Albanian (Albania)", "sr_RS" => "Serbian (Serbia)", "sv_SE" => "Swedish (Sweden)", "sw_KE" => "Swahili (Kenya)", "sy_SY" => "Syriac", "sz_PL" => "Silesian", "ta_IN" => "Tamil (India)", "te_IN" => "Telugu (India)", "tg_TJ" => "Tajik (Tajikistan)", "th_TH" => "Thai (Thailand)", "tk_TM" => "Turkmen (Turkmenistan)", "tl_PH" => "Filipino (Philippines)", "tl_ST" => "Klingon", "tr_TR" => "Turkish (Turky)", "tt_RU" => "Tatar (Russia)", "tz_MA" => "Tamazight (Morocco)", "uk_UA" => "Ukrainian (Ukraine)", "ur_PK" => "Urdu (Pakistan)", "uz_UZ" => "Uzbek (Uzbekistan)", "vi_VN" => "Vietnamese (Vietnam)", "wo_SN" => "Wolof (Senegal)", "xh_ZA" => "Xhosa (South Africa)", "yi_DE" => "Yiddish (Germany)", "yo_NG" => "Yoruba (Nigeria)", "zh_CN" => "Chinese (China)", "zh_HK" => "Chinese (Hong Kong)", "zh_TW" => "Chinese (Taiwan)", "zu_ZA" => "Zulu (South Africa)", "zz_TR" => "Zazaki (Turkey)"];
    if($reach_by_language){
      //echo '<pre>'; var_dump($reach_by_language); echo '</pre>'; die;
      foreach($reach_by_language as $lang => $value){
          $reach_by_language_array[$languages_lib[$lang]] = $value;
      }
      return $reach_by_language_array;
    }else{
    	return null;
    }
  }
    
    public function getInsightsJson($page_id, $since, $until){
        $insights['gender_age'] = $this->getFansByAgeGenderArrays($page_id, $since, $until);
      	$insights['country'] = $this->getFansByCountryValues($page_id, $since, $until);
      	$insights['language'] = $this->getFansLanguageValues($page_id, $since, $until);
      	$insights['page_views_gender_age'] = $this->getViewsByAgeGenderArrays($page_id, $since, $until);
        $insights['page_views'] = $this->getPageViewsByDevice($page_id, $since, $until);
      	$insights['fans_like_source'] = $this->getPageFansLikeSource($page_id, $since, $until);
      	$insights['reach_by_age_gender'] = $this->getPageReachByAgeGenderArrays($page_id, $since, $until);
      	$insights['reach_by_language'] = $this->getPageReachByLanguageInEnglish($page_id, $since, $until);
        $insights['page_reach'] = $this->getPageReachArray($page_id, $since, $until);
		$insights['reach_by_country'] = $this->getPageReachByCountry($page_id, $since, $until);
      	$page_posts_paid_reach = $this->getPagePostsPaidReach($page_id, $since, $until);
        $page_posts_organic_reach = $this->getPagePostsOrganicReach($page_id, $since, $until);
      	$insights['page_posts_paid_reach'] = ($page_posts_paid_reach) ? $this->getSumOfValuesInArray($page_posts_paid_reach[0]['values']) : 0;
      	$insights['page_posts_organic_reach'] = ($page_posts_organic_reach) ? $this->getSumOfValuesInArray($page_posts_organic_reach[0]['values']) : 0;
		$insights['organic_paid_reach_json_table'] = $this->getPagePostsReachJsonTableByArray($page_posts_paid_reach, $page_posts_organic_reach);
        return json_encode($insights);
    }
  
  	public function getSumOfValuesInArray($array){
    	$sum = 0;
          foreach($array as $value){
          	if(array_key_exists('value', $value)) ($sum += $value['value']);
          }
      return $sum;
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
	
    public function getPost($id){
	$client = $this->getClient();
	$post_details = $client->api($id."?fields=full_picture,message,story", "GET");
        return $post_details;
    }
	
    public function getImageActualSize($page_id){
	$posts = Model::find()->Where(['parent_id' => $page_id])->all();
	foreach($posts as $post){
            $post_details = $this->getPost($post->entity_id);
            if(array_key_exists('full_picture', $post_details)){
		$post->media_url = $post_details['full_picture'];
		$post->update();
            }
	}
    }
	
    public function getPostContent($page_id){
	$posts = Model::find()->Where(['parent_id' => $page_id])->all();
	foreach($posts as $post){
            $post_details = $this->getPost($post->entity_id);
            if(array_key_exists('message', $post_details)){
		$post->content = $post_details['message'];
		$post->update();
            }elseif(array_key_exists('story', $post_details)){
		$post->content = $post_details['story'];
		$post->update();
            }
	}
    }
  
  	
  	public function checkClientSession(){
    	if(Yii::$app->session['facebook']){
        	return $this->getClient();
        }else{
        	$oAuthclient = Authclient::findOne(['user_id' => Yii::$app->user->getId(), 'source' => 'facebook']);
              if(! $oAuthclient ){
                  $oAuthclient = Authclient::findOne(['user_id' => 2, 'source' => 'facebook']);
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
                 Facebook::setClient( unserialize($oAuthclient->source_data));
                 $client = $this->getClient();
                 $ReturnData = $client->getUserAttributes() ;
                  if( $ReturnData == null){
                      $oAuthclient->source_data =null;
                      $oAuthclient->save();
                      Facebook::setClient( null);
                  }
                return $this->getClient();
              }
        }
    }
  
    public function getPageNameAndIdUsingPageUrl($url){
      $client = $this->checkClientSession();
      $page_name_id = $client->api("?id=".$url);
      return $page_name_id;
    }
	
    public function getCompetitorData($url){
	$page_name_id = $this->getPageNameAndIdUsingPageUrl($url);
	$page_data = $this->getPageData($page_name_id["id"]);
	return $page_data;
    }
	
    public function getCompetitorNameAndFollowersFromUrl($url){
	$page_data = $this->getCompetitorData($url);
	$page['name'] = $page_data["name"];
	$page['followers'] = $page_data["likes"];
	$page['id'] = $page_data['id'];
    $page['img_url'] = (array_key_exists('picture', $page_data) && array_key_exists('url', $page_data['picture']['data'])) ? $page_data['picture']['data']['url'] : null;
	return $page;
    }
  
 	public function updateCompetitorsValues(){
      	$competitors = Competitors::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
  		foreach($competitors as $oCompetitor){
        	$oFacebook = CompChannels::findOne(['comp_id' => $oCompetitor->id, 'comp_channel' => 'facebook']);
          	if($oFacebook){
            	$this->updateCompetitorValue($oFacebook);
            }
        }
  	}
    
  
 	public function updateCompetitorValue($oFacebook){
  		$page_data = $this->getPageData($oFacebook->comp_channel_id);
      	if($page_data){
        	$oFacebook->comp_channel_followers = $page_data["likes"];
          	$oFacebook->update();
        }
  	}
    
  
  	public function getFansDemographicsDashboard($insights){
      	$facebook = [];
      	$followers = $insights['gender_age']['male_count'] + $insights['gender_age']['female_count'];
    	$facebook['gender'] = (($insights['gender_age']['male_count'] != 0) && $insights['gender_age']['male_count'] >= $insights['gender_age']['female_count']) ? ('males '.round(((($insights['gender_age']['male_count'])/$followers)*100),1).'%') : (($insights['gender_age']['male_count'] < $insights['gender_age']['female_count']) ? ('females '.round(((($insights['gender_age']['female_count'])/$followers)*100), 2).'%') : '0%');
      	foreach($insights['gender_age']['age_ranges'] as $age){
        	$ages[$age] = $insights['gender_age']['male'][$age] + $insights['gender_age']['female'][$age];
        }
      	$max_age_value = max($ages);
      	$max_age_index = array_keys($ages, $max_age_value)[0];
      	$facebook['age'] = $max_age_index.' '.round((($max_age_value)/$followers), 1).'%';
      
        $max_country_value = max($insights['country']);
        $max_country_index = array_keys($insights['country'], $max_country_value)[0];
        $facebook['country'] = $max_country_index.' '.round(((($max_country_value)/array_sum($insights['country']))*100), 1).'%';
        $max_language_value = max($insights['language']);
        $max_language_index = array_keys($insights['language'], $max_language_value)[0];
        $facebook['language'] = $max_language_index.' '.round(((($max_language_value)/array_sum($insights['language']))*100), 1).'%';
      	$facebook['device'] = $facebook['industry'] = $facebook['seniority'] = '...';
      return $facebook;
    }
  
  	public function checkAndGetValueIndex($array){
  		$count = count($array) - 1;
        while(($count != 0) && (!array_key_exists('value', $array[$count]))){
            $count--;
        }
      return $count;
  	}
  
  public function getPagePostsReachJsonTableByArray($page_posts_paid_reach, $page_posts_organic_reach){
        $page_posts_reach_json_table = (($page_posts_paid_reach) && ($page_posts_organic_reach)) ? GoogleChartHelper::getTwoTimeGraphsDataTable('day', 'organic impressions', 'paid impressions', $page_posts_organic_reach[0]["values"], $page_posts_paid_reach[0]["values"]) : '';
        return $page_posts_reach_json_table;
    }
  
}
