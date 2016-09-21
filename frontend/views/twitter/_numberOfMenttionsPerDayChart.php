<?php
    if($mentions_per_day_json_table){
        $this->registerJs("GoogleCharts.drawColumns(".$mentions_per_day_json_table.", 'Mentions', 'mentions_per_day')", yii\web\View::POS_END);
         echo '<h3 class="internal-title noneBG">Mentions Interaction</h3>';
         echo '<div class="internal-content">';
            echo '<div id="mentions_per_day"></div>';
         echo '</div>';
    }