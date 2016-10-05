<?php
    if($clicks_by_day_json_table){
	$this->registerJs("GoogleCharts.drawLine(".$clicks_by_day_json_table.", 'Clicks by day', 'clicks_by_day')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Clicks by day</h3>
	<div class="internal-content">
            <div id="clicks_by_day"></div>
	</div>
<?php }
?>