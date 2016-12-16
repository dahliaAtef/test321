<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Growth of Total Followers</h3>';
	echo '<div class="internal-content">';
if($followers_growth_json_table){
    $this->registerJs("GoogleCharts.drawLine(".$followers_growth_json_table.", 'yg', 'followers_growth')", yii\web\View::POS_END);	
    echo '<div id="followers_growth"></div>';
}else{
	echo '<div id="followers_growth"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/line_no" /></div></div>';
}
echo '</div>';