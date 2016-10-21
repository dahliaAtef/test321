<?php

if($page_fans_growth_json_table){
    $this->registerJs("GoogleCharts.drawColumns(".$page_fans_growth_json_table.", 'fb', 'fans_growth')", yii\web\View::POS_END);
    echo '<h3 class="internal-title noneBG">Growth of Total Fans</h3>';
    echo '<div class="internal-content">';
		echo '<div id="fans_growth" style="width:100%; height:100%"></div>';
	echo '</div>';
}
?>