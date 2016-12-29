<?php
use yii\helpers\Url;

	echo '<h3 class="internal-title noneBG">Best Time to Post</h3>';
    echo '<div class="internal-content">';
	if($best_time_to_post_json_table && ($total_interactions > 0)){
    $this->registerJs("GoogleCharts.drawStackedColumns(".$best_time_to_post_json_table.", 'yg', 'best_time_to_post')", yii\web\View::POS_END);	
        	echo '<div id="best_time_to_post"></div>';
    }else{
    	echo '<div id="best_time_to_post"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/stacked_no.png" ></div></div>';
    }
	echo '</div>';