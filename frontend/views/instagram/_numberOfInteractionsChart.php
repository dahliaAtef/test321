<?php

    $this->registerJs("GoogleCharts.drawColumns(".$number_of_interactions_json_table.", 'in', 'interactions_per_day')", yii\web\View::POS_END);
   	echo '<h3 class="internal-title noneBG">Interactions</h3>';
    echo '<div class="internal-content">';
	    echo '<div id="interactions_per_day"></div>';
	echo '</div>';

