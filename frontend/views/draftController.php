<?php
public function actionPage($page_id){
        //echo date('Y-m-d', strtotime('2015-10-07T07:00:00+0000')); die;
        ini_set('max_execution_time', 700000);
        $client = Yii::$app->session->get('facebook');
       // echo '<pre>';
        //var_dump($client->api($page_id.'/insights/page_views_unique/day?since=1-11-2015&until=12-1-2016'));
        //var_dump($client->api($page_id."/insights/page_impressions/day?since=".date('Y-m-d',strtotime('-91 days',time()))."&until=".date('Y-m-d',strtotime('+2 days',time()))));
        //var_dump($client->api($page_id."/insights/page_posts_impressions_organic/day?since=".date('Y-m-d',strtotime('-91 days',time()))."&until=".date('Y-m-d',strtotime('+2 days',time()))));
        //echo '</pre>';
        //die;
        //echo '<pre>'; var_dump($client->api(str_replace("https://graph.facebook.com/v2.5", "", $posts["paging"]["next"]))); echo '</pre>'; die;
        
        
        $page = $client->api($page_id);
        //$insights = $client->api($page_id."/insights?since=".date('Y-m-d',strtotime('-91 days',time()))."&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')["data"];
        //echo '<pre>'; var_dump($insights); echo '</pre>'; die;
        
        //$total_page_fans = $client->api($page_id."?fields=likes", 'GET');
        $page_fans_month = $client->api($page_id."/insights/page_fans?since=".date('Y-m-d',strtotime('-91 days',time()))."&until=".date('Y-m-d',strtotime('+2 days',time())))["data"];
        if($page_fans_month){
            $page_fans_month_json_table = $this->dataTableOneArray('day', 'fans', $page_fans_month[0]["values"]);
        }else{ $page_fans_month_json_table = null;}
        
        $fans_country = $client->api($page_id."/insights/page_fans_country/lifetime?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        if($fans_country){
            $country_json_table = $this->dataTable('country', 'percentage', $fans_country[0]["values"][count($fans_country[0]["values"])-1]["value"]);
        }else{ $country_json_table = null;}
        
        $fans_city = $client->api($page_id."/insights/page_fans_city/lifetime?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        if($fans_city){
            $city_json_table = $this->dataTable('city', 'percentage', $fans_city[0]["values"][count($fans_city[0]["values"])-1]["value"]);
        }else{ $city_json_table = null;}
        
        $fans_gender_age = $client->api($page_id."/insights/page_fans_gender_age/lifetime?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        if($fans_gender_age){
            $gender_age_json_table = $this->dataTable('gender.age range', 'percentage', $fans_gender_age[0]["values"][count($fans_gender_age[0]["values"])-1]["value"]);
        }else{ $gender_age_json_table = null;}
        
        //$page_posts_paid_unique_reach_week = $client->api($page_id."/insights/page_posts_impressions_paid_unique/week?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'][0];
        //$page_posts_paid_unique_reach_28days = $client->api($page_id."/insights/page_posts_impressions_paid_unique/days_28?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'][0];
        $page_posts_paid_reach_week = $client->api($page_id."/insights/page_posts_impressions_paid/week?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        $page_posts_paid_reach_28days = $client->api($page_id."/insights/page_posts_impressions_paid/days_28?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        //$page_posts_organic_unique_reach_week = $client->api($page_id."/insights/page_posts_impressions_organic_unique/week?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'][0];
        //$page_posts_organic_unique_reach_28days = $client->api($page_id."/insights/page_posts_impressions_organic_unique/days_28?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'][0];
        $page_posts_organic_reach_week = $client->api($page_id."/insights/page_posts_impressions_organic/week?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        $page_posts_organic_reach_28days = $client->api($page_id."/insights/page_posts_impressions_organic/days_28?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        if($page_posts_organic_reach_28days){
            
            $table = array();
            $table['cols'] = [
                ['label' => 'day', 'type' => 'string'],
                ['label' => 'organic', 'type' => 'number'],
                ['label' => 'paid', 'type' => 'number']
            ];
            $rows = array();
            $paid_reach = $page_posts_paid_reach_28days[0]["values"];
            $counter = 0;
            foreach($page_posts_organic_reach_28days[0]["values"] as $value){
                $temp = array();
                $temp[] = ['v' => (string) date('Y-m-d', strtotime($value["end_time"]))];
                $temp[] = ['v' => (int) $value["value"]];
                $temp[] = ['v' => (int) $paid_reach[$counter]["value"]];
                $rows[] = ['c' => $temp];
                $counter++;
            }
            if($rows){
                $table['rows'] = $rows;
                $organic_reach_json_table = json_encode($table);
            }else{
                $organic_reach_json_table = null;
            }
        }else{ $organic_reach_json_table = null;}
        
        
        $page_clicks = $client->api($page_id."/insights/page_consumptions/day?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        $page_engagement_week = $client->api($page_id."/insights/page_engaged_users/week?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        $page_engagement_28days = $client->api($page_id."/insights/page_engaged_users/days_28?since=".date('Y-m', time())."-1&until=".date('Y-m-d',strtotime('+2 days',time())), 'GET')['data'];
        
        //echo '<pre>'; var_dump($insights); echo '</pre>'; die;
        /*$ext_referrals = $insights[181]["values"][count($insights[181]["values"])-1];
        var_dump($ext_referrals);die;
        echo ' Top referrering external domains sending traffic to your Page = '.count().'<br />';
        if(count($insights[181]["values"][count($insights[181]["values"])-1]["value"]) > 0){
            foreach(count($insights[181]["values"][count($insights[181]["values"])-1]["value"]) as $external_referrals){
                echo $external_referrals.'<br />';
            }
        }*/
        
        //posts data
        $posts = $client->api($page_id."/posts?limit=10&fields=type,message,story,picture,sharedposts,created_time,source,attachments{media}", 'GET');
        //echo '<pre>'; var_dump($posts['paging']); echo '</pre>'; die;
        return $this->render('page', [
            'client' => $client,
            'page' => $page,
            //'insights' => $insights,
            'total_page_fans' => $page_fans_month[0]["values"][count($page_fans_month[0]["values"])-1]["value"],
            //'today_fan_adds' => $today_fan_adds,
            //'today_fan_removes' => $today_fan_removes,
            //'fans_country' => $fans_country,
            //'fans_city' => $fans_city,
            //'fans_gender_age' => $fans_gender_age,
            'city_json_table' => $city_json_table,
            'gender_age_json_table' => $gender_age_json_table,
            'country_json_table' => $country_json_table,
            'page_fans_month_json_table' => $page_fans_month_json_table,
            //'page_posts_paid_unique_reach_week' => $page_posts_paid_unique_reach_week,
            //'page_posts_paid_unique_reach_28days' => $page_posts_paid_unique_reach_28days ,
            'page_posts_paid_reach_week' => $page_posts_paid_reach_week ,
            'page_posts_paid_reach_28days' => $page_posts_paid_reach_28days ,
            //'page_posts_organic_unique_reach_week' => $page_posts_organic_unique_reach_week ,
            //'page_posts_organic_unique_reach_28days' => $page_posts_organic_unique_reach_28days ,
            'page_posts_organic_reach_week' => $page_posts_organic_reach_week ,
            'page_posts_organic_reach_28days' => $page_posts_organic_reach_28days ,
            'organic_reach_json_table' => $organic_reach_json_table,
            'page_clicks' => $page_clicks ,
            'page_engagement_week' => $page_engagement_week ,
            'page_engagement_28days' => $page_engagement_28days ,
            'posts' => $posts]);
    }
    
    
    
    
    
    
    
    
    
    