<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Company Size</h3>
<div class="internal-content">
<?php
    if($company_size_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$company_size_statistics_json_table.", 'ln', 'company_size')", yii\web\View::POS_END);
	?>
      <div id="company_size"></div>
<?php }else{ ?>
  <div id="company_size"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/bar_no.png" /></div></div>
  <?php }
?>
</div>