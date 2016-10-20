<?php

if($locations_views_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$locations_views_json_table.", 'yg', 'location_views')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Channel view per Location</h3>';
	echo '<div class="internal-content">';
    	echo '<div id="location_views"></div>';
	echo '</div>';
}