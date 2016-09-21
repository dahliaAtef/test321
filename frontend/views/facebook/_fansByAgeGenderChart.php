<?php
if($fans_gender_age_json_table){
    //echo '<pre>'; var_dump($fans_gender_age_json_table); echo '</pre>'; die;
    $this->registerJs("GoogleCharts.drawColumns(".$fans_gender_age_json_table.", 'Distribution of fans by gender and age ranges', 'fans_age_gender')", yii\web\View::POS_END);
   	echo '<h3 class="internal-title noneBG">Distribution of fans by Gender and Age ranges</h3>';
    echo '<div class="internal-content">';
    	echo '<div id="fans_age_gender"></div>';
	echo '</div>';
}   
?>