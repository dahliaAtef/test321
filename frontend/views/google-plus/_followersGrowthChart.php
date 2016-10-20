<?php

    $this->registerJs("GoogleCharts.drawLine(".$followers_growth_json_table.", 'yg', 'followers_growth')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Growth of Total Followers</h3>';
	echo '<div class="internal-content">';
    	echo '<div id="followers_growth"></div>';
	echo '</div>';
