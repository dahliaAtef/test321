<?php
    if($company_size_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$company_size_statistics_json_table.", 'ln', 'company_size')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Company Size</h3>
	<div class="internal-content">
            <div id="company_size"></div>
	</div>
<?php }
?>
	