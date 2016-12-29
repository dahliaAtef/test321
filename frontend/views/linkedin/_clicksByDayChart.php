<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Clicks by day</h3>
<div class="internal-content">
  <?php
    if($clicks_by_day_json_table && ($clicks_count > 0)){
	$this->registerJs("GoogleCharts.drawLine(".$clicks_by_day_json_table.", 'ln', 'clicks_by_day')", yii\web\View::POS_END);
	?>
            <div id="clicks_by_day"></div>
<?php }else{ ?>
  <div id="clicks_by_day"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/line_no.png" /></div></div>
    <?php } ?>
</div>