<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Channel Avg Views Duration Percentage per Location</h3>';
echo '<div class="internal-content circleChart">';
if($locations_view_duration_percentage_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$locations_view_duration_percentage_json_table.", 'yg', 'location_avg_views_duration_percentage')", yii\web\View::POS_END);	
    echo '<div id="location_avg_views_duration_percentage"></div>';
}else{
	echo '<div id="location_avg_views_duration_percentage"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
}
echo '</div>';
