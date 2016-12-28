<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Profile Tweets by day</h3>';
echo '<div class="internal-content">';
    if($tweets_per_day_json_table && $total_posts){
        $this->registerJs("GoogleCharts.drawColumns(".$tweets_per_day_json_table.", 'tw', 'tweets_per_day')", yii\web\View::POS_END);
   		echo '<div id="tweets_per_day"></div>';
    }else{
    	echo '<div id="tweets_per_day"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
    }
echo '</div>';