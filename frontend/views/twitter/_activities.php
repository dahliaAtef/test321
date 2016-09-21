<?php
use digi\authclient\clients\Twitter;

echo '<br/><br/>Weekly Activities :';
    
echo '<br/>Retweets : '/*.$retweets_result["retweets_weekly_count"]*/;
echo '<br/>Mentions : '/*.$mentions_result["mentions_weekly_count"]*/;

echo '<br/><br/>Monthly Activities :';
    
echo '<br/>Retweets : '/*.$retweets_result["retweets_monthly_count"]*/;
echo '<br/>Mentions : '/*.$mentions_result["mentions_monthly_count"]*/;


//$peak_time = array('0-2' => 0, '3-5' => 0, '6-8' => 0, '9-11' => 0, '12-14' => 0, '15-17' => 0, '18-20' => 0, '21+' => 0);
//foreach($peak_time as $hour => $value){
//    $peak_time[$hour] = $retweets_result["peak_time"][$hour] + $mentions_result["peak_time"][$hour];
//}
//echo $this->render('_peakTimeChart', ['peak_time_json_table' => Twitter::getPeakTimeJsonTable($peak_time)]);