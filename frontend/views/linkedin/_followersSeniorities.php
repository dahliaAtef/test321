<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Seniority</h3>
<div class="internal-content">
<?php
    if($seniority_statistics_json_table){
	$this->registerJs("GoogleCharts.drawBars(".$seniority_statistics_json_table.", 'ln', 'seniority')", yii\web\View::POS_END);
	?>
            <div id="seniority"></div>
<?php }else{ ?>
  <div id="seniority"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/bar_no.png" /></div></div>
  <?php }
?>
</div>