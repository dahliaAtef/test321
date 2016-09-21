<?php

    $this->registerJs("GoogleCharts.drawBars(".$tags_interactions_json_table.", 'Top tags by interactions', 'top_tags_by_interaction')", yii\web\View::POS_END);	
	echo '<h3 class="internal-title noneBG">Top Tags by interactions</h3>';
	echo '<div class="internal-content">';
    	echo '<div id="top_tags_by_interaction"></div>';    
	echo '</div>';
