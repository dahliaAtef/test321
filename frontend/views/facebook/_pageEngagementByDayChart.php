
		<?php

		if($page_engagement_by_day_json_table){
		    $this->registerJs("GoogleCharts.drawColumns(".$page_engagement_by_day_json_table.", 'fb', 'page_engagement_by_day')", yii\web\View::POS_END);
		   	echo '<h3 class="internal-title noneBG">Interaction per 1000 Fans</h3>';
		    echo '<div class="internal-content">';
		    	echo '<div id="page_engagement_by_day"></div>';
			echo '</div>';
		}
		?>
	