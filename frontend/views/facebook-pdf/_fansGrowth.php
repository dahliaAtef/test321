<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Growth of Total Fans</h3>';
echo '<div class="internal-content">';
if($page_fans_growth_json_table && ($sum > 0)){
    $this->registerJs("GoogleCharts.drawColumns(".$page_fans_growth_json_table.", 'fb', 'fans_growth')", yii\web\View::POS_END);
	echo '<div id="fans_growth"><img src="'.$fans_growth_img.'"></div>';
}else{
	echo '<div id="fans_growth"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no" /></div></div>';
}
echo '</div>';
?>