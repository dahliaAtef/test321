<?php
if($peak_time_json_table){
    $this->registerJs("GoogleCharts.drawColumns(".$peak_time_json_table.", 'Peak time', 'peak_time')", yii\web\View::POS_END);
    echo '<div id="peak_time" style="width: 500px; height: 500px;"></div>';
}
?>