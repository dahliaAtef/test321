<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Age Ranges</h3>';
echo '<div class="internal-content">';
if($gender_ages_json_table){
    $this->registerJs("GoogleCharts.drawColumns(".$gender_ages_json_table.", 'yg', 'age_ranges')", yii\web\View::POS_END);	
    echo '<div id="age_ranges"></div>';
}else{
	echo '<div id="age_ranges"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
}
echo '</div>';