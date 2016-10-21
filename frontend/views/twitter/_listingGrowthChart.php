<?php

    $this->registerJs("GoogleCharts.drawLine(".$listed_growth_json_table.", 'tw', 'listing_growth')", yii\web\View::POS_END);
		echo '<h3 class="internal-title noneBG">Listing Growth</h3>';
		 echo '<div class="internal-content">';
    		echo '<div id="listing_growth"></div>';
	     echo '</div>';
