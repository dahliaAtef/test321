<?php

    $this->registerJs("GoogleCharts.drawColumns(".$followers_gained_lost_json_table.", 'in', 'followers_gained_lost')", yii\web\View::POS_END);
   	echo '<h3 class="internal-title noneBG">Gained and Lost Followers</h3>';
    echo '<div class="internal-content">';
    	echo '<div id="followers_gained_lost"></div>';
	echo '</div>';