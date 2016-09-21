<?php
if($fans_language_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$fans_language_json_table.", 'Distribution of fans by Language', 'fans_language')", yii\web\View::POS_END);
	echo '<h3 class="internal-title noneBG">Distribution of fans by Language</h3>';    
	echo '<div class="internal-content">';
		echo '<div id="fans_language"></div>';
	echo '</div>';
}
?>