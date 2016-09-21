<?php
if($countries_json_table){
    echo '<h3 class="internal-title youtube short">Youtube</h3>';
    $this->registerJs("GoogleCharts.drawMap(".$countries_json_table.", 'views by country', 'yt_view_by_country')", yii\web\View::POS_END);
    echo '<div class="internal-content">';
    echo '<div id="yt_view_by_country"></div>';
    echo '</div>';
}
