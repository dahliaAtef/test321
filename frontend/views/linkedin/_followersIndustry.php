<?php
    if($industry_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$industry_statistics_json_table.", 'Industry', 'industry')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Industry</h3>
	<div class="internal-content">
            <div id="industry"></div>
	</div>
<?php }
?>
	