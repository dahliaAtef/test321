<?php

if($gender_ages_json_table){
    $this->registerJs("GoogleCharts.drawColumns(".$gender_ages_json_table.", 'age ranges', 'age_ranges')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Age Ranges</h3>';
	echo '<div class="internal-content">';
    	echo '<div id="age_ranges"></div>';
	echo '</div>';
}
