<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG" style="text-align:center; color: #6d6e71;">Page Posts by day</h3>';
echo '<div class="internal-content">';
		if($page_posts_by_day_json_table && $total_posts){
			//echo '<pre>'; var_dump($page_posts_by_day_json_table); echo '</pre>'; die;
		    $this->registerJs("GoogleCharts.drawColumns(".$page_posts_by_day_json_table.", 'fb', 'page_posts_by_day')", yii\web\View::POS_END);
				echo '<div id="page_posts_by_day"><img src="'.$page_posts_by_day_img.'"></div>';
		}else{
        	echo '<div id="page_posts_by_day"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
        }
echo '</div>';
		?>
	