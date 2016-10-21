<?php
    if($country_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$country_statistics_json_table.", 'ln', 'country')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Country</h3>
	<div class="internal-content">
            <div id="country"></div>
	</div>
<?php }
?>
	