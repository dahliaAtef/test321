<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Updates by day</h3>
<div class="internal-content">
      <?php
    if($updates_by_day_json_table && ($updates_count > 0)){
	$this->registerJs("GoogleCharts.drawLine(".$updates_by_day_json_table.", 'ln', 'updates_by_day')", yii\web\View::POS_END);
	?>
         <div id="updates_by_day"></div>
<?php }else{ ?>
  <div id="updates_by_day"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/line_no.png" /></div></div>
<?php }
?>
</div>