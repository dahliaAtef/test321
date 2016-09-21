<?php
if($top_video_filters_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$top_video_filters_json_table.", 'Top Video Filters', 'top_video_filters')", yii\web\View::POS_END);
?>	
<h3 class="internal-title noneBG">Top Video Filters</h3>
<div class="internal-content">
    <div id="top_video_filters">
	</div>
</div>
<?php
}else{
    echo '<h4>Top Video Filters</h4><br/><p>No data to display</p>';
}
?>
