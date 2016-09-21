<?php

    $this->registerJs("GoogleCharts.drawStackedColumns(".$best_time_to_post_json_table.", 'Best Time To Post', 'best_time_to_post')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Best Time to Post</h3>';
    echo '<div class="internal-content">';
    	echo '<div id="best_time_to_post"></div>';
	echo '</div>';
