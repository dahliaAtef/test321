<?php
    if($interactions_by_day_json_table){
	$this->registerJs("GoogleCharts.drawLineArea(".$interactions_by_day_json_table.", 'ln', 'interactions_by_day')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Interactions by day</h3>
	<div class="internal-content">
            <div id="interactions_by_day"></div>
	</div>
<?php }
?>