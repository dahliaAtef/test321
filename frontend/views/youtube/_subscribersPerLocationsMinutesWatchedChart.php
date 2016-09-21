<?php

if($locations_minutes_watched_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$locations_minutes_watched_json_table.", 'Channel Estimated Minutes Watched per Location', 'location_minutes_watched')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Channel Estimated Minutes Watched per Location</h3>';
	echo '<div class="internal-content">';
    	echo '<div id="location_minutes_watched"></div>';
	echo '</div>';
}
