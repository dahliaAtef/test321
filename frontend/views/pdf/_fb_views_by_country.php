<?php
use yii\helpers\Url;


    echo '<h3 class="internal-title facebook short">Facebook</h3>';
	echo '<div class="internal-content">';
if($countries_json_table){
    $this->registerJs("GoogleCharts.drawMap(".$countries_json_table.", 'fb', 'fb_view_by_country')", yii\web\View::POS_END);
	echo '<div id="fb_view_by_country"></div>';
}else{
	echo '<div id="fb_view_by_country"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/map_no.png" /></div></div>';
}
echo '</div>';
