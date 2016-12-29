<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Industry</h3>
<div class="internal-content">
<?php
    if($industry_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$industry_statistics_json_table.", 'ln', 'industry')", yii\web\View::POS_END);
	?>
            <div id="industry"></div>
<?php }else{ ?>
  <div id="industry"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/bar_no.png" /></div></div>
  <?php }
?>
</div>