		<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG" style="text-align:center; color: #6d6e71;">Interaction per 1000 Fans</h3>';
echo '<div class="internal-content">';
	if($page_engagement_by_day_json_table &&$total_posts){
		    $this->registerJs("GoogleCharts.drawColumns(".$page_engagement_by_day_json_table.", 'fb', 'page_engagement_by_day')", yii\web\View::POS_END);
		    echo '<div id="page_engagement_by_day"><img src="'.$page_engagement_by_day_img.'"></div>';
	}else{
    	echo '<div id="page_engagement_by_day"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
    }
echo '</div>';
		?>
	