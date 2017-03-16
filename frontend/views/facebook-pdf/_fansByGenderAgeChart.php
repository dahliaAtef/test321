<?php
if($fans_gender_age_json_table){
    $this->registerJs("GoogleCharts.drawColumns(".$fans_gender_age_json_table.", 'fb', 'fans_gender_age')", yii\web\View::POS_END);
   	echo '<h3 class="internal-title noneBG" style="text-align:center; color: #6d6e71;">Distribution of fans by Gender and Age ranges</h3>';   
    echo '<div class="internal-content">';
    	echo '<div id="fans_gender_age"></div>';
	echo '</div>';
}   
?>