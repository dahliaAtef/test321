<?php
if($followers_locations_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$followers_locations_json_table.", 'followers locations', 'followers_locations')", yii\web\View::POS_END);
    echo '<div id="followers_locations" style="width: 500px; height: 500px;"></div>';
}
?>