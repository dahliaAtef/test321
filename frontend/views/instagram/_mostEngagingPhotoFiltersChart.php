<?php
if($most_engaging_photo_filters_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$most_engaging_photo_filters_json_table.", 'in', 'most_engaging_photo_filters')", yii\web\View::POS_END);
?>   	
	<h3 class="internal-title noneBG">Most Engaging Photo Filters</h3>
    <div class="internal-content">
		<div id="most_engaging_photo_filters">
		</div>
	</div>
<?php
}else{
    echo '<h4>Most Engaging Photo Filters</h4><br/><p>No data to display</p>';
}
?>