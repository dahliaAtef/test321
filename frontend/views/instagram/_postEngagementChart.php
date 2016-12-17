<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Post Engagement Rate</h3>';
echo '<div class="internal-content">';
if($post_engagement_per_day_json_table){
    $this->registerJs("GoogleCharts.drawLine(".$post_engagement_per_day_json_table.", 'in', 'post_engagement_per_day')", yii\web\View::POS_END);
    echo '<div id="post_engagement_per_day"></div>';
}else{
	echo '<div id="post_engagement_per_day"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/line_no.png" /></div></div>';
}
echo '</div>';
