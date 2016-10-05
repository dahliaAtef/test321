<?php
    if($impressions_by_day_json_table){
	$this->registerJs("GoogleCharts.drawLineArea(".$impressions_by_day_json_table.", 'Impressions by day', 'impressions_by_day')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Impressions by day</h3>
	<div class="internal-content">
            <div id="impressions_by_day"></div>
	</div>
<?php }
?>