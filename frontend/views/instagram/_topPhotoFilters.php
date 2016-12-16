<?php
use yii\helpers\Url;
?>

<h3 class="internal-title noneBG">Top Photo Filters</h3>
	<div class="internal-content circleChart">
<?php
if($top_photo_filters_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$top_photo_filters_json_table.", 'in', 'top_photo_filters')", yii\web\View::POS_END);	
?>
		<div id="top_photo_filters"></div>
	
<?php
}else{ ?>
      <div id="top_photo_filters"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/pie_no.png" /></div></div>
<?php }
?>
</div>