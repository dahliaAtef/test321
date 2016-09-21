<?php

    $this->registerJs("GoogleCharts.drawColumns(".$number_of_posts_json_table.", 'Number of Posts', 'posts_per_day')", yii\web\View::POS_END);	
    echo '<h3 class="internal-title noneBG">Number of Posts</h3>';
    echo '<div class="internal-content">';
    	echo '<div id="posts_per_day"></div>';
	echo '</div>';
