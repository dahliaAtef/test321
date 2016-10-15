<?php
    if($job_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$job_statistics_json_table.", 'Jobs', 'jobs')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Jobs</h3>
	<div class="internal-content">
            <div id="jobs"></div>
	</div>
<?php }
?>
	