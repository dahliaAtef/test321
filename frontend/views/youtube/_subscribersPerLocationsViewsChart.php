<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Channel views per Location</h3>';
echo '<div class="internal-content circleChart">';
if($locations_views_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$locations_views_json_table.", 'yg', 'location_views')", yii\web\View::POS_END);	
    echo '<div id="location_views"></div>';
}else{
	echo '<div id="location_views"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
}
echo '</div>';