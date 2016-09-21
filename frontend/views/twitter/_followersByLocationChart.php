<?php
if($followers_location_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$followers_location_json_table.", 'followers by location', 'followers_location')", yii\web\View::POS_END);
    echo '<div id="followers_location" style="width: 500px; height: 500px;"></div>';
}
?>