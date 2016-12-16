<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Top Video Filters</h3>
<div class="internal-content circleChart">
<?php
if($top_video_filters_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$top_video_filters_json_table.", 'in', 'top_video_filters')", yii\web\View::POS_END);
?>	

    <div id="top_video_filters">
	</div>

<?php
}else{ ?>
      <div id="top_video_filters"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/pie_no.png" /></div></div>
<?php }
?>
</div>