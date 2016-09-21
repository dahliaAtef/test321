<?php
    if($tweets_per_day_json_table){
        $this->registerJs("GoogleCharts.drawColumns(".$tweets_per_day_json_table.", 'Number of Tweets', 'tweets_per_day')", yii\web\View::POS_END);
        
		echo '<h3 class="internal-title noneBG">Profile Tweets by day</h3>';
		 echo '<div class="internal-content">';
        	echo '<div id="tweets_per_day"></div>';
	     echo '</div>';
    }