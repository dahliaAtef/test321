<?php
use yii\helpers\Url;
?><div class="row">
	<div class="col-md-12">		
		<?php
		echo '<h3 class="internal-title noneBG">Peak Time</h3>';
		    echo '<div class="internal-content">';
		if($peak_time_json_table){
		    $this->registerJs("GoogleCharts.drawLineArea(".$peak_time_json_table.", 'fb', 'peak_time')", yii\web\View::POS_END);
			echo '<div id="peak_time"></div>';
		}else{
        	echo '<div id="peak_time"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/line_area_no" /></div></div>';
        }
		echo '</div>';
		?>
	</div>
</div>