<?php
if($top_photo_filters_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$top_photo_filters_json_table.", 'in', 'top_photo_filters')", yii\web\View::POS_END);	
?>
<h3 class="internal-title noneBG">Top Photo Filters</h3>
	<div class="internal-content circleChart">
		<div id="top_photo_filters">
		</div>
	</div>
<?php
}else{
    echo '<h4>Top Photo Filters</h4><br/><p>No data to display</p>';
}
?>