<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Growth of Total Followers</h3>';
echo '<div class="internal-content">';
if($followers_growth_json_table && ($followers_growth > 0)){
    $this->registerJs("GoogleCharts.drawLine(".$followers_growth_json_table.", 'in', 'followers_growth_2')", yii\web\View::POS_END);
    echo '<div id="followers_growth_2"></div>';
}else{
  	echo '<div id="followers_growth_2"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/line_no.png" /></div></div>';
}
	echo '</div>';