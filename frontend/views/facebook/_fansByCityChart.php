		<?php
		if($fans_city_json_table){
		    $this->registerJs("GoogleCharts.drawCircle(".$fans_city_json_table.", 'fb', 'fans_city')", yii\web\View::POS_END); 
		    echo '<h3 class="internal-title noneBG">Distribution of fans by City</h3>';
			echo '<div class="internal-content">';
				echo '<div id="fans_city"></div>';
			echo '</div>';
		}
		?>
	