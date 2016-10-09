<?php
    if($seniority_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$seniority_statistics_json_table.", 'Seniority', 'seniority')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Seniority</h3>
	<div class="internal-content">
            <div id="seniority"></div>
	</div>
<?php }
?>
	