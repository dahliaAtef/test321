<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Jobs</h3>
<div class="internal-content">
<?php
    if($job_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$job_statistics_json_table.", 'ln', 'jobs')", yii\web\View::POS_END);
	?>
            <div id="jobs"></div>
<?php }else{ ?>
  <div id="jobs"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/bar_no.png" /></div></div>
  <?php }
?>
</div>