<?php
    if($tags_by_interactions_json_table){
        $this->registerJs("GoogleCharts.drawBars(".$tags_by_interactions_json_table.", 'Top Tags by Interactions', 'top_tags_by_interaction')", yii\web\View::POS_END);
         echo '<h3 class="internal-title noneBG">Top Tags by Interactions</h3>';
         echo '<div class="internal-content">';
            echo '<div id="top_tags_by_interaction"></div>';
         echo '</div>';
    }