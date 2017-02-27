
	<?php

	if($page_fans_month_json_table){
	    $this->registerJs("GoogleCharts.drawLineArea(".$page_fans_month_json_table.", 'fb', 'fan_likes')", yii\web\View::POS_END);
		echo '<h3 class="internal-title noneBG">Total Fans</h3>';
		 echo '<div class="internal-content">';
	    	echo '<div id="fan_likes"  style="width:100%; height:100%"><img src="'.$fan_likes_img.'"></div>';
	     echo '</div>';
	}
	?>
