
		<?php

		if($page_posts_by_day_json_table){
			//echo '<pre>'; var_dump($page_posts_by_day_json_table); echo '</pre>'; die;
		    $this->registerJs("GoogleCharts.drawColumns(".$page_posts_by_day_json_table.", 'Page Posts by day', 'page_posts_by_day')", yii\web\View::POS_END);
		    echo '<h3 class="internal-title noneBG">Page Posts by day</h3>';
			echo '<div class="internal-content">';
				echo '<div id="page_posts_by_day"></div>';
			echo '</div>';
		}
		?>
	