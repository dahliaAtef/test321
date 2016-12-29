<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Followers by day</h3>
<div class="internal-content">
  <?php
    if($followers_by_day_json_table && ($total_followers_count > 0)){
	$this->registerJs("GoogleCharts.drawLineArea(".$followers_by_day_json_table.", 'ln', 'followers_by_day')", yii\web\View::POS_END);
	?>
       <div id="followers_by_day"></div>
<?php }else{ ?>
  <div id="followers_by_day"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/line_area_no.png" /></div></div>
    <?php } ?>
</div>