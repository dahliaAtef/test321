<?php
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\Json;
?>

<?php
echo 'Bonjour '.$page['name'].'<br/>';
if($total_page_fans){
    //echo '<pre>'; var_dump($total_page_fans); echo '</pre>'; die;
    echo '<br/>Total page fans : '.$total_page_fans;
}

if($page_fans_month_json_table){
    $this->registerJs("GoogleCharts.drawChart(".$page_fans_month_json_table.", 'fans adds', 'fan_adds', 'lineArea')", yii\web\View::POS_END);
    
    echo '<div id="fan_adds" style="width: 500px; height: 500px;"></div>';
    
}
        //page insights
/*if($today_fan_adds){
        //echo '<pre>'; var_dump($today_fan_adds); echo '</pre>'; die;
        echo "<br />Today's fan adds = ".$today_fan_adds[0]["values"][count($today_fan_adds[0]["values"])-1]["value"];
        //echo "Today's fan adds = ".$insights[1]["values"][count($insights[1]["values"])-1]["value"].'<br />';
        
        $fan_adds_per_month = $today_fan_adds[0]["values"];
        $sum_fan_adds_per_month = 0;
        for($i=0; $i< count($fan_adds_per_month); $i++){
            $sum_fan_adds_per_month += $fan_adds_per_month[$i]["value"];
        }
        echo '<br />Total number of fan adds this month = '.$sum_fan_adds_per_month;
}
if($today_fan_removes){
        echo "<br/>Today's fan removes = ".$today_fan_removes[0]["values"][count($today_fan_removes[0]["values"])-1]["value"].'<br />';
        
        $fan_removes_per_month = $today_fan_removes[0]["values"];
        $sum_fan_removes_per_month = 0;
        for($i=0; $i< count($fan_removes_per_month); $i++){
            $sum_fan_removes_per_month += $fan_removes_per_month[$i]["value"];
        }
        echo '<br />Total number of fan removes this month = '.$sum_fan_removes_per_month;
}*/
if($country_json_table){
        $this->registerJs("GoogleCharts.drawChart(".$country_json_table.", 'fans by country', 'fans_country', 'circle')", yii\web\View::POS_END);
    
//        echo "<br />Fans country :";
//        foreach($fans_country[0]["values"][count($fans_country[0]["values"])-1]["value"] as $country => $value){
//            echo '<br/>'.$country.' : '.$value;
//        }
        echo '<div id="fans_country" style="width: 500px; height: 500px;"></div>';
}

if($city_json_table){
    $this->registerJs("GoogleCharts.drawChart(".$city_json_table.", 'fans by city', 'fans_city', 'circle')", yii\web\View::POS_END);
    /*
        echo "<br /><br />Fans cities :";
        foreach($fans_city[0]["values"][count($fans_city[0]["values"])-1]["value"] as $city => $value){
            echo '<br/>'.$city.' : '.$value;
        } 
    */    
    echo '<div id="fans_city" style="width: 500px; height: 500px;"></div>';
}
if($gender_age_json_table){
        echo "<br /><br />Fans by gender and age ranges:";
        $this->registerJs("GoogleCharts.drawChart(".$gender_age_json_table.", 'fans by gender and age range', 'fans_gender_age', 'column')", yii\web\View::POS_END);
    
        //echo '<pre>'; var_dump($insights); echo '</pre>'; die;
        /*foreach($fans_gender_age[0]["values"][count($fans_gender_age[0]["values"])-1]["value"] as $gender => $value){
            echo '<br/>'.$gender.' : '.$value;
        }*/
        echo '<div id="fans_gender_age"></div>';
}        
        //echo '<br /><br />Total page posts Paid unique reach per week : '.$page_posts_paid_unique_reach_week["values"][count($page_posts_paid_unique_reach_week["values"])-1]["value"];      
        //echo '<br />Total page posts Paid unique per 28 days : '.$page_posts_paid_unique_reach_28days["values"][count($page_posts_paid_unique_reach_28days["values"])-1]["value"];
if($page_posts_paid_reach_week){          
        echo '<br />Total page posts Paid reach per week : '.$page_posts_paid_reach_week[0]["values"][count($page_posts_paid_reach_week[0]["values"])-1]["value"];
}
if($page_posts_paid_reach_28days){
        echo '<br />Total page posts Paid reach per 28 days : '.$page_posts_paid_reach_28days[0]["values"][count($page_posts_paid_reach_28days[0]["values"])-1]["value"];
}
        //echo '<br />Total page posts Organic unique reach per week : '.$page_posts_organic_unique_reach_week["values"][count($page_posts_organic_unique_reach_week["values"])-1]["value"];
        //echo '<br />Total page posts Organic unique per 28 days : '.$page_posts_organic_unique_reach_28days["values"][count($page_posts_organic_unique_reach_28days["values"])-1]["value"];
if($page_posts_organic_reach_week){        
        echo '<br />Total page posts Organic reach per week : '.$page_posts_organic_reach_week[0]["values"][count($page_posts_organic_reach_week[0]["values"])-1]["value"];
}
if($page_posts_organic_reach_28days){        
        echo '<br />Total page posts Organic reach per 28 days : '.$page_posts_organic_reach_28days[0]["values"][count($page_posts_organic_reach_28days[0]["values"])-1]["value"];
}
if($organic_reach_json_table){
    //echo '<pre>'; var_dump($organic_reach_json_table); echo '</pre>'; die;
    $this->registerJs("GoogleCharts.drawChart(".$organic_reach_json_table.", 'page posts reach', 'page_post_reach', 'line')", yii\web\View::POS_END);
    
    echo '<div id="page_post_reach" style="width: 500px; height: 500px;"></div>';
        //echo '<br />Total page posts Organic reach per 28 days : '.$page_posts_organic_reach_28days[0]["values"][count($page_posts_organic_reach_28days[0]["values"])-1]["value"];
}        
if($page_clicks){        
        echo "<br />Today's Clicks : ".$page_clicks[0]["values"][count($page_clicks[0]["values"])-1]["value"].'<br />';
}        
        /*$fan_adds_per_month = $today_fan_adds[0]["values"];
        $sum_fan_adds_per_month = 0;
        for($i=0; $i< count($fan_adds_per_month); $i++){
            $sum_fan_adds_per_month += $fan_adds_per_month[$i]["value"];
        }
        echo '<br />Total number of fan adds this month = '.$sum_fan_adds_per_month;*/
        
        /*$fan_removes_per_month = $today_fan_removes[0]["values"];
        $sum_fan_removes_per_month = 0;
        for($i=0; $i< count($fan_removes_per_month); $i++){
            $sum_fan_removes_per_month += $fan_removes_per_month[$i]["value"];
        }
        echo '<br />Total number of fan removes this month = '.$sum_fan_removes_per_month;*/
if($page_engagement_28days){
        echo '<br />Page engagement per 28 days : '.$page_engagement_28days[0]["values"][count($page_engagement_28days[0]["values"])-1]["value"];
}
if($page_engagement_week){
        echo '<br />Page engagement per week : '.$page_engagement_week[0]["values"][count($page_engagement_week[0]["values"])-1]["value"].'<hr />';
}        
        /////////////////////////////////////////////////
        //posts data
        foreach($posts["data"] as $post){
            if($post["type"] == 'photo'){
                echo '<br /><img src="'.$post["picture"].'" alt="post image" width=250px height= 250px/><br />';
            }elseif(array_key_exists('attachments', $post)){
                echo '<br /><img src="'.$post["attachments"]["data"][0]["media"]["image"]["src"].'" alt="post image" width=250px height= 250px/><br />';
            }
            
            if(array_key_exists('message', $post)){
                //echo '<pre>'; var_dump($post); echo '</pre>'; die;
                echo '<br/><a href="'.Url::to(['site/fb-page-post', 'post_id' => $post["id"]]).'">'.Html::encode($post["message"]).'</a><br/>';
            }elseif(array_key_exists('story', $post)){
                echo '<br /><a href="'.Url::to(['site/fb-page-post', 'post_id' => $post["id"]]).'">'.Html::encode($post["story"]).'</a><br/>';
            }
            
            echo 'Published at '.$post["created_time"].'<br/><hr/>';
        }
        ?>

