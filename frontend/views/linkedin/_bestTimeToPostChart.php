<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Best Time To Post</h3>';
echo '<div class="internal-content">';
if($updates){
    $this->registerJs("GoogleCharts.drawStackedColumns(".$best_time_to_post_json_table.", 'ln', 'best_time_to_post')", yii\web\View::POS_END);	
	echo '<div id="best_time_to_post"></div>';
}else{
	echo '<div id="best_time_to_post"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/stacked_no.png" /></div></div>';
}
	echo '</div>';