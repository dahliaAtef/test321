<?php
if($page_posts_reach_json_table){
    $this->registerJs("GoogleCharts.drawLineArea(".$page_posts_reach_json_table.", 'fb', 'page_post_reach')", yii\web\View::POS_END);
    echo '<h3>Page posts Impressions</h3>';
	echo '<div id="page_post_reach"></div>';
}  
?>