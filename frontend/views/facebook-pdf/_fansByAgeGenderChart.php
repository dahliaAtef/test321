<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG" style="text-align:center; color: #6d6e71;">Distribution of fans by Gender and Age ranges</h3>';
    echo '<div class="internal-content">';
if($fans_gender_age_json_table){
    //echo '<pre>'; var_dump($fans_gender_age_json_table); echo '</pre>'; die;
    $this->registerJs("GoogleCharts.drawColumns(".$fans_gender_age_json_table.", 'fb', 'fans_age_gender')", yii\web\View::POS_END);
    	echo '<div id="fans_age_gender"><img src="'.$fans_age_gender_img.'"></div>';
}else{
	echo '<div id="fans_age_gender"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/column_no.png" /></div></div>';
}
echo '</div>';
?>