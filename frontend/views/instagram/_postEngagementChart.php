<?php

    $this->registerJs("GoogleCharts.drawLine(".$post_engagement_per_day_json_table.", 'in', 'post_engagement_per_day')", yii\web\View::POS_END);
   	echo '<h3 class="internal-title noneBG">Post Engagement Rate</h3>';
    echo '<div class="internal-content">';
    	echo '<div id="post_engagement_per_day"></div>';
	echo '</div>';
