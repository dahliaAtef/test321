<?php

namespace digi\authclient\clients;

use Yii;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;
use yii\web\NotFoundHttpException;

class LinkedIn extends \yii\authclient\clients\LinkedIn
{
    const ACCOUNT = 0;
    const POST = 1;
    const IMAGE = 0;
    const VIDEO = 1;
    
    public $company_size = [
        'A' => 'Self-employed', 
        'B' => '1-10', 
        'C' => '11-50', 
        'D' => '51-200', 
        'E' => '201-500', 
        'F' => '501-1000', 
        'G' => '1001-5000', 
        'H' => '5001-10,000',  
        'I' => '10,001+', 
        ];
    
    public $country = [
        "bd" => "Bangladesh", "be" => "Belgium", "bf" => "Burkina Faso", "bg" => "Bulgaria", 
        "ba" => "Bosnia and Herzegovina", "bb" => "Barbados", "wf" => "Wallis and Futuna", 
        "bl" => "Saint Barthelemy", "bm" => "Bermuda", "bn" => "Brunei", "bo" => "Bolivia", 
        "bh" => "Bahrain", "bi" => "Burundi", "bj" => "Benin", "bt" => "Bhutan", "jm" => "Jamaica", 
        "bv" => "Bouvet Island", "bw" => "Botswana", "ws" => "Samoa", "bq" => "Bonaire, Saint Eustatius and Saba ", 
        "br" => "Brazil", "bs" => "Bahamas", "je" => "Jersey", "by" => "Belarus", "bz" => "Belize", 
        "ru" => "Russia", "rw" => "Rwanda", "rs" => "Serbia", "tl" => "East Timor", "re" => "Reunion", 
        "tm" => "Turkmenistan", "tj" => "Tajikistan", "ro" => "Romania", "tk" => "Tokelau", 
        "gw" => "Guinea-Bissau", "gu" => "Guam", "gt" => "Guatemala", 
        "gs" => "South Georgia and the South Sandwich Islands", "gr" => "Greece", 
        "gq" => "Equatorial Guinea", "gp" => "Guadeloupe", "jp" => "Japan", "gy" => "Guyana", 
        "gg" => "Guernsey", "gf" => "French Guiana", "ge" => "Georgia", "gd" => "Grenada", 
        "gb" => "United Kingdom", "ga" => "Gabon", "sv" => "El Salvador", "gn" => "Guinea", 
        "gm" => "Gambia", "gl" => "Greenland", "gi" => "Gibraltar", "gh" => "Ghana", "om" => "Oman", 
        "tn" => "Tunisia", "jo" => "Jordan", "hr" => "Croatia", "ht" => "Haiti", "hu" => "Hungary", 
        "hk" => "Hong Kong", "hn" => "Honduras", "hm" => "Heard Island and McDonald Islands", 
        "ve" => "Venezuela", "pr" => "Puerto Rico", "ps" => "Palestinian Territory", "pw" => "Palau", 
        "pt" => "Portugal", "sj" => "Svalbard and Jan Mayen", "py" => "Paraguay", "iq" => "Iraq", 
        "pa" => "Panama", "pf" => "French Polynesia", "pg" => "Papua New Guinea", "pe" => "Peru", 
        "pk" => "Pakistan", "ph" => "Philippines", "pn" => "Pitcairn", "pl" => "Poland", 
        "pm" => "Saint Pierre and Miquelon", "zm" => "Zambia", "eh" => "Western Sahara", 
        "ee" => "Estonia", "eg" => "Egypt", "za" => "South Africa", "ec" => "Ecuador", 
        "it" => "Italy", "vn" => "Vietnam", "sb" => "Solomon Islands", "et" => "Ethiopia", 
        "so" => "Somalia", "zw" => "Zimbabwe", "sa" => "Saudi Arabia", "es" => "Spain", 
        "er" => "Eritrea", "me" => "Montenegro", "md" => "Moldova", "mg" => "Madagascar", 
        "mf" => "Saint Martin", "ma" => "Morocco", "mc" => "Monaco", "uz" => "Uzbekistan", 
        "mm" => "Myanmar", "ml" => "Mali", "mo" => "Macao", "mn" => "Mongolia", 
        "mh" => "Marshall Islands", "mk" => "Macedonia", "mu" => "Mauritius", "mt" => "Malta", 
        "mw" => "Malawi", "mv" => "Maldives", "mq" => "Martinique", "mp" => "Northern Mariana Islands", 
        "ms" => "Montserrat", "mr" => "Mauritania", "im" => "Isle of Man", "ug" => "Uganda", 
        "tz" => "Tanzania", "my" => "Malaysia", "mx" => "Mexico", "il" => "Israel", 
        "fr" => "France", "io" => "British Indian Ocean Territory", "sh" => "Saint Helena", 
        "fi" => "Finland", "fj" => "Fiji", "fk" => "Falkland Islands", "fm" => "Micronesia", 
        "fo" => "Faroe Islands", "ni" => "Nicaragua", "nl" => "Netherlands", "no" => "Norway", 
        "na" => "Namibia", "vu" => "Vanuatu", "nc" => "New Caledonia", "ne" => "Niger", 
        "nf" => "Norfolk Island", "ng" => "Nigeria", "nz" => "New Zealand", "np" => "Nepal", 
        "nr" => "Nauru", "nu" => "Niue", "ck" => "Cook Islands", "xk" => "Kosovo", 
        "ci" => "Ivory Coast", "ch" => "Switzerland", "co" => "Colombia", "cn" => "China", 
        "cm" => "Cameroon", "cl" => "Chile", "cc" => "Cocos Islands", "ca" => "Canada", 
        "cg" => "Republic of the Congo", "cf" => "Central African Republic", 
        "cd" => "Democratic Republic of the Congo", "cz" => "Czech Republic", "cy" => "Cyprus", 
        "cx" => "Christmas Island", "cr" => "Costa Rica", "cw" => "Curacao", "cv" => "Cape Verde", 
        "cu" => "Cuba", "sz" => "Swaziland", "sy" => "Syria", "sx" => "Sint Maarten", 
        "kg" => "Kyrgyzstan", "ke" => "Kenya", "ss" => "South Sudan", "sr" => "Suriname", 
        "ki" => "Kiribati", "kh" => "Cambodia", "kn" => "Saint Kitts and Nevis", "km" => "Comoros", 
        "st" => "Sao Tome and Principe", "sk" => "Slovakia", "kr" => "South Korea", "si" => "Slovenia", 
        "kp" => "North Korea", "kw" => "Kuwait", "sn" => "Senegal", "sm" => "San Marino", 
        "sl" => "Sierra Leone", "sc" => "Seychelles", "kz" => "Kazakhstan", "ky" => "Cayman Islands", 
        "sg" => "Singapore", "se" => "Sweden", "sd" => "Sudan", "do" => "Dominican Republic", 
        "dm" => "Dominica", "dj" => "Djibouti", "dk" => "Denmark", "vg" => "British Virgin Islands", 
        "de" => "Germany", "ye" => "Yemen", "dz" => "Algeria", "us" => "United States", 
        "uy" => "Uruguay", "yt" => "Mayotte", "um" => "United States Minor Outlying Islands", 
        "lb" => "Lebanon", "lc" => "Saint Lucia", "la" => "Laos", "tv" => "Tuvalu", 
        "tw" => "Taiwan", "tt" => "Trinidad and Tobago", "tr" => "Turkey", "lk" => "Sri Lanka", 
        "li" => "Liechtenstein", "lv" => "Latvia", "to" => "Tonga", "lt" => "Lithuania", 
        "lu" => "Luxembourg", "lr" => "Liberia", "ls" => "Lesotho", "th" => "Thailand", 
        "tf" => "French Southern Territories", "tg" => "Togo", "td" => "Chad", 
        "tc" => "Turks and Caicos Islands", "ly" => "Libya", "va" => "Vatican", 
        "vc" => "Saint Vincent and the Grenadines", "ae" => "United Arab Emirates", 
        "ad" => "Andorra", "ag" => "Antigua and Barbuda", "af" => "Afghanistan", 
        "ai" => "Anguilla", "vi" => "U.S. Virgin Islands", "is" => "Iceland", "ir" => "Iran", 
        "am" => "Armenia", "al" => "Albania", "ao" => "Angola", "aq" => "Antarctica", 
        "as" => "American Samoa", "ar" => "Argentina", "au" => "Australia", "at" => "Austria", 
        "aw" => "Aruba", "in" => "India", "ax" => "Aland Islands", "az" => "Azerbaijan", 
        "ie" => "Ireland", "id" => "Indonesia", "ua" => "Ukraine", "qa" => "Qatar", "mz" => "Mozambique"
    ];
    
    public $seniority = [
        '1' => 'Unpaid',
        '2' => 'Training',
        '3' => 'Entry-level',
        '4' => 'Senior',
        '5' => 'Manager',
        '6' => 'Director',
        '7' => 'Vice President (VP)',
        '8' => 'Chief X Officer (CxO)',
        '9' => 'Partner',
        '10' => 'Owner',
    ];
    
    public $industry = [
        '47' => 'Accounting',
        '94' => 'Airlines/Aviation',
        '120' => 'Alternative Dispute Resolution',
        '125' => 'Alternative Medicine',
        '127' => 'Animation',
        '19' => 'Apparel & Fashion',
        '50' => 'Architecture & Planning',
        '111' => 'Arts and Crafts',
        '53' => 'Automotive',
        '52' => 'Aviation & Aerospace',
        '41' => 'Banking',
        '12' => 'Biotechnology',
        '36' => 'Broadcast Media',
        '49' => 'Building Materials',
        '138' => 'Business Supplies and Equipment',
        '129' => 'Capital Markets',
        '54' => 'Chemicals',
        '90' => 'Civic & Social Organization',
        '51' => 'Civil Engineering',
        '128' => 'Commercial Real Estate',
        '118' => 'Computer & Network Security',
        '109' => 'Computer Games',
        '3' => 'Computer Hardware',
        '5' => 'Computer Networking',
        '4' => 'Computer Software',
        '48' => 'Construction',
        '24' => 'Consumer Electronics',
        '25' => 'Consumer Goods',
        '91' => 'Consumer Services',
        '18' => 'Cosmetics',
        '65' => 'Dairy',
        '1' => 'Defense & Space',
        '99' => 'Design',
        '69' => 'Education Management',
        '132' => 'E-Learning',
        '112' => 'Electrical/Electronic Manufacturing',
        '28' => 'Entertainment',
        '86' => 'Environmental Services',
        '110' => 'Events Services',
        '76' => 'Executive Office',
        '122' => 'Facilities Services',
        '63' => 'Farming',
        '43' => 'Financial Services',
        '38' => 'Fine Art',
        '66' => 'Fishery',
        '34' => 'Food & Beverages',
        '23' => 'Food Production',
        '101' => 'Fund-Raising',
        '26' => 'Furniture',
        '29' => 'Gambling & Casinos',
        '145' => 'Glass, Ceramics & Concrete',
        '75' => 'Government Administration',
        '148' => 'Government Relations',
        '140' => 'Graphic Design',
        '124' => 'Health, Wellness and Fitness',
        '68' => 'Higher Education',
        '14' => 'Hospital & Health Care',
        '31' => 'Hospitality',
        '137' => 'Human Resources',
        '134' => 'Import and Export',
        '88' => 'Individual & Family Services',
        '147' => 'Industrial Automation',
        '84' => 'Information Services',
        '96' => 'Information Technology and Services',
        '42' => 'Insurance',
        '74' => 'International Affairs',
        '141' => 'International Trade and Development',
        '6' => 'Internet',
        '45' => 'Investment Banking',
        '46' => 'Investment Management',
        '73' => 'Judiciary',
        '77' => 'Law Enforcement',
        '9' => 'Law Practice',
        '10' => 'Legal Services',
        '72' => 'Legislative Office',
        '30' => 'Leisure, Travel & Tourism',
        '85' => 'Libraries',
        '116' => 'Logistics and Supply Chain',
        '143' => 'Luxury Goods & Jewelry',
        '55' => 'Machinery',
        '11' => 'Management Consulting',
        '95' => 'Maritime',
        '97' => 'Market Research',
        '80' => 'Marketing and Advertising',
        '135' => 'Mechanical or Industrial Engineering',
        '126' => 'Media Production',
        '17' => 'Medical Devices',
        '13' => 'Medical Practice',
        '139' => 'Mental Health Care',
        '71' => 'Military',
        '56' => 'Mining & Metals',
        '35' => 'Motion Pictures and Film',
        '37' => 'Museums and Institutions',
        '115' => 'Music',
        '114' => 'Nanotechnology',
        '81' => 'Newspapers',
        '100' => 'Non-Profit Organization Management',
        '57' => 'Oil & Energy',
        '113' => 'Online Media',
        '123' => 'Outsourcing/Offshoring',
        '87' => 'Package/Freight Delivery',
        '146' => 'Packaging and Containers',
        '61' => 'Paper & Forest Products',
        '39' => 'Performing Arts',
        '15' => 'Pharmaceuticals',
        '131' => 'Philanthropy',
        '136' => 'Photography',
        '117' => 'Plastics',
        '107' => 'Political Organization',
        '67' => 'Primary/Secondary Education',
        '83' => 'Printing',
        '105' => 'Professional Training & Coaching',
        '102' => 'Program Development',
        '79' => 'Public Policy',
        '98' => 'Public Relations and Communications',
        '78' => 'Public Safety',
        '82' => 'Publishing',
        '62' => 'Railroad Manufacture',
        '64' => 'Ranching',
        '44' => 'Real Estate',
        '40' => 'Recreational Facilities and Services',
        '89' => 'Religious Institutions',
        '144' => 'Renewables & Environment',
        '70' => 'Research',
        '32' => 'Restaurants',
        '27' => 'Retail',
        '121' => 'Security and Investigations',
        '7' => 'Semiconductors',
        '58' => 'Shipbuilding',
        '20' => 'Sporting Goods',
        '33' => 'Sports',
        '104' => 'Staffing and Recruiting',
        '22' => 'Supermarkets',
        '8' => 'Telecommunications',
        '60' => 'Textiles',
        '130' => 'Think Tanks',
        '21' => 'Tobacco',
        '108' => 'Translation and Localization',
        '92' => 'Transportation/Trucking/Railroad',
        '59' => 'Utilities',
        '106' => 'Venture Capital & Private Equity',
        '16' => 'Veterinary',
        '93' => 'Warehousing',
        '133' => 'Wholesale',
        '142' => 'Wine and Spirits',
        '119' => 'Wireless',
        '103' => 'Writing and Editing'
    ];
    
    public $job = [
        '-1' => 'None',
        '1' => 'Accounting',
        '2' => 'Administrative',
        '3' => 'Arts and Design',
        '4' => 'Business Development',
        '5' => 'Community & Social Services',
        '6' => 'Consulting',
        '7' => 'Education',
        '8' => 'Engineering',
        '9' => 'Entrepreneurship',
        '10' => 'Finance',
        '11' => 'Healthcare Services',
        '12' => 'Human Resources',
        '13' => 'Information Technology',
        '14' => 'Legal',
        '15' => 'Marketing',
        '16' => 'Media & Communications',
        '17' => 'Military & Protective Services',
        '18' => 'Operations',
        '19' => 'Product Management',
        '20' => 'Program & Product Management',
        '21' => 'Purchasing',
        '22' => 'Quality Assurance',
        '23' => 'Real Estate',
        '24' => 'Rersearch',
        '25' => 'Sales',
        '26' => 'Support'
    ];
    
    /**
     * Set instagram client session 
     **/
    public function setClient($client){
        Yii::$app->session->set('linkedin', $client);
    }
    
    /**
     * get instagram client session 
     **/
    public function getClient(){
        $client = Yii::$app->session->get('linkedin');
        if(Yii::$app->session->get('linkedin')){
            return Yii::$app->session->get('linkedin');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getUserAdminCompanies(){
        $client = $this->getClient();
        $companies = $client->api('companies?format=json&is-company-admin=true');
        return $companies;
    }
    
    public function getCompanyData($company_id){
        $client = $this->getClient();
        $company_data = $client->api('companies/'.$company_id.':(id,name,logo-url,num-followers)?format=json');
        return $company_data;
    }
    
    public function createCompanyModel($data, $authclient_id){
        $oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $data["id"];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $data["name"];
        $oAccountModel->media_url = $data["logoUrl"];
        $oAccountModel->followers = $data["numFollowers"];
        $oAccountModel->save();
        return $oAccountModel;
    }
    
    public function getCompanyUpdates($company_id){
        $client = $this->getClient();
        $company_updates = $client->api('companies/'.$company_id.'/updates?format=json');
        return $company_updates;
    }
    
    public function createUpdateModel($company_id, $parent_id, $authclient_id, $update, $since){
        $oUpdateModel = new Model();
        $oUpdateModel->authclient_id = $authclient_id;
        $oUpdateModel->parent_id = $parent_id;
        $oUpdateModel->entity_id = $update['updateKey'];
        $oUpdateModel->type = self::POST;
        $oUpdateModel->content = $update['updateContent']['companyStatusUpdate']['share']['content']['description'];
        $oUpdateModel->media_url = $update['updateContent']['companyStatusUpdate']['share']['content']['thumbnailUrl'];
        $oUpdateModel->likes = $update['numLikes'];
        $oUpdateModel->comments = $update['updateComments']['_total'];
        $oUpdateModel->creation_time = (($update['timestamp'])/1000);
        $update_statistics = $this->getUpdateStatisticsInTime($company_id, $update['updateKey'], $since);
        $sum_update_statistics = ['shares' => 0, 'clicks' => 0, 'impressions' => 0];
        foreach($update_statistics['values'] as $value){
            $sum_update_statistics['shares'] += $value['shareCount'];
            $sum_update_statistics['clicks'] += $value['clickCount'];
            $sum_update_statistics['impressions'] += $value['impressionCount'];
        }
        $oUpdateModel->shares = $sum_update_statistics['shares'];
        $oUpdateModel->clicks = $sum_update_statistics['clicks'];
        $oUpdateModel->impressions = $sum_update_statistics['impressions'];
        $oUpdateModel->interactions = $oUpdateModel->likes + $oUpdateModel->comments + $oUpdateModel->shares;
        if(!$oUpdateModel->save()){
            echo '<pre>'; var_dump($oUpdateModel->getErrors()); echo '</pre>'; die;
        }
    }
    
    public function updateUpdateModel($company_id, $oUpdate, $since){
        $update_statistics = $this->getUpdateStatisticsInTime($company_id, $oUpdate->entity_id, $since);
        $sum_update_statistics = ['likes' => 0, 'comments' => 0, 'shares' => 0, 'clicks' => 0, 'impressions' => 0];
        foreach($update_statistics['values'] as $value){
            $sum_update_statistics['likes'] += $value['likeCount'];
            $sum_update_statistics['comments'] += $value['commentCount'];
            $sum_update_statistics['shares'] += $value['shareCount'];
            $sum_update_statistics['clicks'] += $value['clickCount'];
            $sum_update_statistics['impressions'] += $value['impressionCount'];
        }
        $oUpdateModel->likes = $sum_update_statistics['likes'];
        $oUpdateModel->comments = $sum_update_statistics['comments'];
        $oUpdateModel->shares = $sum_update_statistics['shares'];
        $oUpdateModel->clicks = $sum_update_statistics['clicks'];
        $oUpdateModel->impressions = $sum_update_statistics['impressions'];
        $oUpdateModel->interactions = $oUpdateModel->likes + $oUpdateModel->comments + $oUpdateModel->shares;
        if(!$oUpdateModel->update()){
            echo '<pre>'; var_dump($oUpdateModel->getErrors()); echo '</pre>'; die;
        }
    }
    
    public function getUpdateStatisticsInTime($company_id, $update_key, $since){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?update-key='.$update_key.'&time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalFollowersStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_followers_statistics = $client->api('companies/'.$company_id.'/historical-follow-statistics?time-granularity=day&start-timestamp='.$since.'&format=json');
        //echo '<pre>'; var_dump($company_followers_statistics); echo '</pre>'; die;
        return $company_followers_statistics;
    }
    
    public function getCompanyStatistics($company_id = '5260201'){
        $client = $this->getClient();
        $company_statistics = $client->api('companies/'.$company_id.'/company-statistics?format=json');
        //echo '<pre>'; var_dump($company_statistics); echo '</pre>'; die;
        return $company_statistics;
    }
    
    public function firstTimeToLog($company_id, $authclient_id){
        $company_data = $this->getCompanyData($company_id);
        $oAccountModel = $this->createCompanyModel($company_data, $authclient_id);
        $company_updates = $this->getCompanyUpdates($company_id);
        foreach($company_updates['values'] as $update){
            $this->createUpdateModel($company_id, $oAccountModel->id, $authclient_id, $update, $since);
        }
        return $oAccountModel;
    }
    
    public function getUpdatesStatistics($company_id, $updates, $since, $until){
        $updates_statistics = [];
        foreach($updates as $oUpdate){
            $update_statistics = $this->getUpdateStatisticsInTime($company_id, $oUpdate->entity_id, $since)['values'];
            $updates_statistics[$oUpdate->entity_id] = ['statistics' => $update_statistics, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'clicks' => 0];
            foreach($update_statistics as $statistics){
                $updates_statistics[$oUpdate->entity_id]['likes'] += $statistics['likeCount'];
                $updates_statistics[$oUpdate->entity_id]['comments'] += $statistics['commentCount'];
                $updates_statistics[$oUpdate->entity_id]['shares'] += $statistics['shareCount'];
                $updates_statistics[$oUpdate->entity_id]['impressions'] += $statistics['impressionCount'];
                $updates_statistics[$oUpdate->entity_id]['clicks'] += $statistics['clickCount'];
            }
        }
        return $updates_statistics;
    }
    
    public function getSumsOfAllUpdatesStatistics($updates_statistics){
        $sum = ['likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'clicks' => 0, 'interactions' => 0];
        foreach($updates_statistics as $statistics){
            $sum['likes'] += $statistics['likes'];
            $sum['comments'] += $statistics['comments'];
            $sum['shares'] += $statistics['shares'];
            $sum['impressions'] += $statistics['impressions'];
            $sum['clicks'] += $statistics['clicks'];
        }
        $sum['interactions'] = $sum['likes'] + $sum['comments'] + $sum['shares'];
        return $sum;
    }
    
    public function statistics($oModel){
        $since = strtotime('-10 months') * 1000;
        $until = time() * 1000;
        $historical_statistics = $this->getHistoricalStatisticsInTime($oModel->entity_id, $since)['values'];
        $days = [];
        $statistics_array = ['clicks' => 0, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'days' => []];
        $company_views_statistics_by_day = [];
        foreach($historical_statistics as $statistics){
            $statistics_array['clicks'] += $statistics['clickCount'];
            $statistics_array['likes'] += $statistics['likeCount'];
            $statistics_array['comments'] += $statistics['commentCount'];
            $statistics_array['shares'] += $statistics['shareCount'];
            $statistics_array['impressions'] += $statistics['impressionCount'];
            $day_in_str = date('d M', (($statistics['time'])/1000));
            array_push($days, $day_in_str);
            $company_views_statistics_by_day[$day_in_str]['impressions'] = $statistics['impressionCount'];
            $company_views_statistics_by_day[$day_in_str]['shares'] = $statistics['shareCount'];
            $company_views_statistics_by_day[$day_in_str]['comments'] = $statistics['commentCount'];
            $company_views_statistics_by_day[$day_in_str]['likes'] = $statistics['likeCount'];
            $company_views_statistics_by_day[$day_in_str]['clicks'] = $statistics['clickCount'];
            $company_views_statistics_by_day[$day_in_str]['interactions'] = $company_views_statistics_by_day[$day_in_str]['shares'] + $company_views_statistics_by_day[$day_in_str]['likes'] + $company_views_statistics_by_day[$day_in_str]['comments'] = $statistics['commentCount'];
        }
        $statistics_array['company_views_statistics_by_day'] = $company_views_statistics_by_day;
        $statistics_array['days'] = $days;
        $days_max_index = count($days) - 1;
        $statistics_array['interactions'] = $statistics_array['likes'] + $statistics_array['comments'] + $statistics_array['shares'];
        $statistics_array['followers'] = $this->getHistoricalFollowersStatisticsInTime($oModel->entity_id, $since);
        $statistics_array['new_followers'] = $statistics_array['followers']['values'][$days_max_index]['totalFollowerCount'] - $statistics_array['followers']['values'][0]['totalFollowerCount'];
        $statistics_array['total_followers'] = $statistics_array['followers']['values'][$days_max_index]['totalFollowerCount'];
        $statistics_array['organic_followers'] = $statistics_array['followers']['values'][$days_max_index]['organicFollowerCount'];
        $statistics_array['paid_followers'] = $statistics_array['followers']['values'][$days_max_index]['paidFollowerCount'];
        $statistics_array['updates'] = Model::find()->Where(['parent_id' => $oModel->id])->andWhere(['between', 'creation_time', $since, $until])->all();
        $statistics_array['avg_daily_updates'] = (count($statistics_array['updates']) != 0) ? round(((count($statistics_array['updates']))/count($days)), 1) : 0;
        $statistics_array['avg_daily_reach'] = ($statistics_array['impressions'] != 0) ? round((($statistics_array['impressions'])/count($days)), 1) : 0;
        $statistics_array['avg_daily_interactions'] = ($statistics_array['interactions'] != 0) ? round((($statistics_array['interactions'])/count($days)), 1) : 0;
        $statistics_array['updates_statistics'] = $this->getUpdatesStatistics($oModel->entity_id, $statistics_array['updates'], $since, $until);
        $statistics_array['updates_statistics_by_day'] = $this->getUpdatesStatisticsByDay($statistics_array['days'], $statistics_array['updates'], $statistics_array['updates_statistics']);
        $statistics_array['sums_of_all_updates_statistics'] = $this->getSumsOfAllUpdatesStatistics($statistics_array['updates_statistics']);
        $statistics_array['followers_array'] = $this->getFollowersArray($statistics_array['followers']['values']);
        $statistics_array['company_statistics'] = $this->getCompanyStatistics($oModel->entity_id);
        return $statistics_array;
    }
    
    public function getUpdatesStatisticsByDay($days, $updates, $updates_statistics){
        foreach($days as $day){
            $update_statistics_by_day[$day] = ['new_updates' => 0, 'new_likes' => 0, 'new_comments' => 0, 'new_shares' => 0, 'new_interactions' => 0, 'new_impressions' => 0, 'new_clicks' => 0];
            foreach($updates as $oUpdate){
                if(date('d M', $oUpdate->creation_time) == $day){
                    $update_statistics_by_day[$day]['new_updates']++;
                    $update_statistics_by_day[$day]['new_likes'] += $updates_statistics[$oUpdate->entity_id]['likes'];
                    $update_statistics_by_day[$day]['new_comments'] += $updates_statistics[$oUpdate->entity_id]['comments'];
                    $update_statistics_by_day[$day]['new_shares'] += $updates_statistics[$oUpdate->entity_id]['shares'];
                    $update_statistics_by_day[$day]['new_interactions'] += ($update_statistics_by_day[$day]['new_likes'] + $update_statistics_by_day[$day]['new_comments'] + $update_statistics_by_day[$day]['new_shares']);
                    $update_statistics_by_day[$day]['new_impressions'] += $updates_statistics[$oUpdate->entity_id]['impressions'];
                    $update_statistics_by_day[$day]['new_clicks'] += $updates_statistics[$oUpdate->entity_id]['clicks'];
                }
            }
        }
        return $update_statistics_by_day;
    }
    
    public function getUpdatesByDayJsonTable($updates_by_day_statistics){
        $updates_by_day_json_table = ($updates_by_day_statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'updates', $updates_by_day_statistics, 'new_updates') : '';
        return $updates_by_day_json_table;
    }
    
    public function getInteractionsByDayJsonTable($days, $update_statistics_by_day, $company_views_statistics_by_day){
        $interactions_by_day_json_table = (($update_statistics_by_day) && ($company_views_statistics_by_day)) ? GoogleChartHelper::getTwoGraphsByDayDataTableUsingKeyNames('day', 'new interactions', 'total interactions', $days, $update_statistics_by_day, 'new_interactions', $company_views_statistics_by_day, 'interactions') : '';
        return $interactions_by_day_json_table;
    }
    
    public function getInteractionsDistributionByDayJsonTable($statistics){
        $interactions_distribution_by_day_json_table = ($statistics) ? GoogleChartHelper::getSameArrayThreeValuesDataTableUsingKeyNames('day', 'likes', 'comments', 'shares', $statistics, 'likes', 'comments', 'shares') : '';
        return $interactions_distribution_by_day_json_table;
    }
    
    public function getClicksByDayJsonTable($statistics){
        $clicks_by_day_json_table = ($statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'clicks', $statistics, 'clicks') : '';
        return $clicks_by_day_json_table;
    }
    
    public function getImpressionsByDayJsonTable($statistics){
        $impressions_by_day_json_table = ($statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'impressions', $statistics, 'impressions') : '';
        return $impressions_by_day_json_table;
    }
    
    public function getFollowersArray($followers){
        $followers_array = [];
        foreach($followers as $day){
            $day_t = date('d M', ($day['time']/1000));
            $followers_array[$day_t]['total'] = $day['totalFollowerCount'];
            $followers_array[$day_t]['organic'] = $day['organicFollowerCount'];
            $followers_array[$day_t]['paid'] = $day['paidFollowerCount'];
        }
        return $followers_array;
    }
    
    public function getFollowersByDayJsonTable($followers){
        $followers_by_day_json_table = ($followers) ? GoogleChartHelper::getSameArrayThreeValuesDataTableUsingKeyNames('day', 'total', 'organic', 'paid', $followers, 'total', 'organic', 'paid') : '';
        return $followers_by_day_json_table;
    }
    
    public function getCompanySize($followers_company_size_statistics){
        $company_size_statistics = [];
        foreach($followers_company_size_statistics as $value){
            $company_size_statistics[$this->company_size[$value['entryKey']]] = $value['entryValue'];
        }
        return $company_size_statistics;
    }
    
    public function getCompanySizeJsonTable($company_size_statistics){
        $company_size_statistics_json_table = ($company_size_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $company_size_statistics) : '';
        return $company_size_statistics_json_table;
    }
    
    public function getCountry($followers_country_statistics){
        $country_statistics = [];
        foreach($followers_country_statistics as $value){
            $country_statistics[$this->country[$value['entryKey']]] = $value['entryValue'];
        }
        return $country_statistics;
    }
    
    public function getCountryJsonTable($country_statistics){
        $country_statistics_json_table = ($country_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $country_statistics) : '';
        return $country_statistics_json_table;
    }
    
    public function getSeniority($followers_seniority_statistics){
        $seniority_statistics = [];
        foreach($followers_seniority_statistics as $value){
            $seniority_statistics[$this->seniority[$value['entryKey']]] = $value['entryValue'];
        }
        return $seniority_statistics;
    }
    
    public function getSeniorityJsonTable($seniority_statistics){
        $seniority_statistics_json_table = ($seniority_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $seniority_statistics) : '';
        return $seniority_statistics_json_table;
    }
    
    public function getIndustry($followers_industry_statistics){
        $industry_statistics = [];
        foreach($followers_industry_statistics as $value){
            $industry_statistics[$this->industry[$value['entryKey']]] = $value['entryValue'];
        }
        return $industry_statistics;
    }
    
    public function getIndustryJsonTable($industry_statistics){
        $industry_statistics_json_table = ($industry_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $industry_statistics) : '';
        return $industry_statistics_json_table;
    }
    
    public function getJobs($followers_job_statistics){
        $job_statistics = [];
        foreach($followers_job_statistics as $value){
            $job_statistics[$this->job[$value['entryKey']]] = $value['entryValue'];
        }
        return $job_statistics;
    }
    
    public function getJobsJsonTable($job_statistics){
        $job_statistics_json_table = ($job_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $job_statistics) : '';
        return $job_statistics_json_table;
    }
    
    /**
     * get array of hours per week days 
     **/
    public function getHoursArray(){
        $hours = array();
        for($i = 1 ; $i <= 12 ; $i++){
            $hours[$i.'am'] = ['Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0];
        }
        for($i = 1 ; $i <= 12 ; $i++){
            $hours[$i.'pm'] = ['Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0];
        }
        return $hours;
    }
    
    public function getBestTimeToPost($updates){
        $hour = $this->getHoursArray();
        foreach($updates as $update){
            $hour[date('ga', $update->creation_time)][date('D', $update->creation_time)] += ($update->likes + $update->comments + $update->shares);
        }
        return $hour;
    }
    
    public function getBestTimeToPostJsonTable($updates){
        $best_time_to_post = $this->getBestTimeToPost($updates);
        $best_time_to_post_json_table = InstagramGoogleChartHelper::getBestTimeToPost($best_time_to_post);
        return $best_time_to_post_json_table;
    }

    public function saveAccountInsights($parent_model, $since){
        $updates = $this->getCompanyUpdates($parent_model->entity_id);
        foreach($updates['values'] as $update){
            $oUpdate = Model::findOne(['entity_id' => $update['updateKey']]);
            if(!$oUpdate){
                $this->updateUpdateModel($parent_model->entity_id, $oUpdate, $since);
            }else{
                $this->createUpdateModel($parent_model->entity_id, $parent_model->id, $parent_model->authclient_id, $update, $since);
            }
        }
    }
    
}