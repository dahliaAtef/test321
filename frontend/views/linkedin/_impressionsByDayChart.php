<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Impressions by day</h3>
<div class="internal-content">
<?php
    if($impressions_by_day_json_table && ($impressions_count > 0)){
	$this->registerJs("GoogleCharts.drawLineArea(".$impressions_by_day_json_table.", 'ln', 'impressions_by_day')", yii\web\View::POS_END);
	?>
        <div id="impressions_by_day"></div>
<?php }else{ ?>
  <div id="impressions_by_day"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/line_area_no.png" /></div></div>
    <?php } ?>
</div>