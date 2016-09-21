<?php
    if($tweets_interactions_per_day_json_table){
        $this->registerJs("GoogleCharts.drawColumns(".$tweets_interactions_per_day_json_table.", 'Number of Tweets Interactions', 'tweets_interactions_per_day')", yii\web\View::POS_END);
        echo '<h3 class="internal-title noneBG">Daily Interaction</h3>';
		 echo '<div class="internal-content">';
        	echo '<div id="tweets_interactions_per_day"></div>';
	     echo '</div>';
    }