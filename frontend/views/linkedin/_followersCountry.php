<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Country</h3>
<div class="internal-content">
<?php
    if($country_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$country_statistics_json_table.", 'ln', 'country')", yii\web\View::POS_END);
	?>
            <div id="country"></div>
	
<?php }else{ ?>
  <div id="country"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/bar_no.png" /></div></div>
  <?php }
?>
</div>