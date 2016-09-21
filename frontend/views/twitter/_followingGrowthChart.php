<?php

    $this->registerJs("GoogleCharts.drawLine(".$following_growth_json_table.", 'Growth of Total Following', 'following_growth')", yii\web\View::POS_END);
		echo '<h3 class="internal-title noneBG">Following Growth</h3>';
		 echo '<div class="internal-content">';
    		echo '<div id="following_growth"></div>';
	     echo '</div>';
