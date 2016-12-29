<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG" style="font-size:18px">Channel Estimated Minutes Watched per Location</h3>';
echo '<div class="internal-content circleChart">';
if($locations_minutes_watched_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$locations_minutes_watched_json_table.", 'yg', 'location_minutes_watched')", yii\web\View::POS_END);
    echo '<div id="location_minutes_watched"></div>';
}else{
  	echo '<div id="location_minutes_watched"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
}
echo '</div>';