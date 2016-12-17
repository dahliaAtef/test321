<?php

if($locations_view_duration_percentage_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$locations_view_duration_percentage_json_table.", 'yg', 'location_avg_views_duration_percentage')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Channel Avg Views Duration Percentage per Location</h3>';
	echo '<div class="internal-content circleChart">';
    	echo '<div id="location_avg_views_duration_percentage"></div>';
	echo '</div>';
}
