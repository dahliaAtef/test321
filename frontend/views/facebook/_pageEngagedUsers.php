<?php
if($engaged_users_json_table){
    $this->registerJs("GoogleCharts.drawLineArea(".$engaged_users_json_table.", 'engaged users', 'engaged_users')", yii\web\View::POS_END);	echo '<h3>Engaged Users</h3>';
    echo '<div id="engaged_users"></div>';
}  
?>