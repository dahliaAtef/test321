<?php

    $this->registerJs("GoogleCharts.drawCircle(".$source_of_engagement_json_table.", 'in', 'source_of_engagement')", yii\web\View::POS_END);	
	echo '<h3 class="internal-title noneBG">Source of Engagement</h3>';
    echo '<div class="internal-content circleChart">';
    	echo '<div id="source_of_engagement"></div>';
	echo '</div>';
