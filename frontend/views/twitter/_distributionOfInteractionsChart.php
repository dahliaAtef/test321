<?php
    if($interactions_by_type_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$interactions_by_type_json_table.", 'Distribution Interactions', 'interactions_by_type')", yii\web\View::POS_END);
       
        echo '<h3 class="internal-title noneBG">Distribution Interaction</h3>';
         echo '<div class="internal-content">';
            echo '<div id="interactions_by_type"></div>';
         echo '</div>';
    }
    