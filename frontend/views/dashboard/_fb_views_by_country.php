<?php
//echo '<br/><br/>';
//var_dump($countries_json_table); die;
if($countries_json_table){
    echo '<h3 class="internal-title facebook short">Facebook</h3>';
    $this->registerJs("GoogleCharts.drawMap(".$countries_json_table.", 'views by country', 'fb_view_by_country')", yii\web\View::POS_END);
    echo '<div class="internal-content">';
	echo '<div id="fb_view_by_country"></div>';
    echo '</div>';
}
