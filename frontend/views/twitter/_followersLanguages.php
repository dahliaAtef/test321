<?php
if($followers_language_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$followers_language_json_table.", 'tw', 'followers_language')", yii\web\View::POS_END);
    echo '<div id="followers_language" style="width: 500px; height: 500px;"></div>';
}
?>