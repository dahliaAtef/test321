<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Distribution of fans by Language</h3>';    
echo '<div class="internal-content circleChart">';
if($fans_language_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$fans_language_json_table.", 'fb', 'fans_language')", yii\web\View::POS_END);
	echo '<div id="fans_language"><img src="'.$fans_language_img.'"></div>';
}else{
	echo '<div id="fans_language"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
}
echo '</div>';
?>