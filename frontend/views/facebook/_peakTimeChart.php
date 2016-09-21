<div class="row">
	<div class="col-md-12">		
		<?php
		if($peak_time_json_table){
		    $this->registerJs("GoogleCharts.drawLineArea(".$peak_time_json_table.", 'Peak time', 'peak_time')", yii\web\View::POS_END);
		    echo '<h3 class="internal-title noneBG">Peak Time</h3>';
		    echo '<div class="internal-content">';
				echo '<div id="peak_time"></div>';
			echo '</div>';
		}
		?>
	</div>
</div>