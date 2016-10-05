<?php
    if($interactions_distribution_by_day_json_table){
	$this->registerJs("GoogleCharts.drawLine(".$interactions_distribution_by_day_json_table.", 'Interactions Disrtribution by day', 'interactions_distribution_by_day')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Interactions Disrtribution by day</h3>
	<div class="internal-content">
            <div id="interactions_distribution_by_day"></div>
	</div>
<?php }
?>