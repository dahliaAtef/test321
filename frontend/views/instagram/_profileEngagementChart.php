<?php

    $this->registerJs("GoogleCharts.drawLine(".$profile_engagement_per_day_json_table.", 'Profile Engagement Rate', 'profile_engagement_per_day')", yii\web\View::POS_END);	
	echo '<h3 class="internal-title noneBG">Profile Engagement Rate</h3>';
	echo '<div class="internal-content">';
    	echo '<div id="profile_engagement_per_day"></div>';
	echo '</div>';
