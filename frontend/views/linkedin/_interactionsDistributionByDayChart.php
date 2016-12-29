<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Interactions Disrtribution by day</h3>
<div class="internal-content">
  <?php
    if($interactions_distribution_by_day_json_table && ($interactions_count > 0)){
	$this->registerJs("GoogleCharts.drawLine(".$interactions_distribution_by_day_json_table.", 'ln', 'interactions_distribution_by_day')", yii\web\View::POS_END);
	?>
  	<div id="interactions_distribution_by_day"></div>
	
<?php }else{ ?>
  <div id="interactions_distribution_by_day"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/line_no.png" /></div></div>
    <?php } ?>
</div>