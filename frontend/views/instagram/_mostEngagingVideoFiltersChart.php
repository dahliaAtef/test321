<?php
use yii\helpers\Url;
?>
	<h3 class="internal-title noneBG">Most Engaging Video Filters</h3>
    <div class="internal-content circleChart">
<?php
if($most_engaging_video_filters_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$most_engaging_video_filters_json_table.", 'in', 'most_engaging_video_filters')", yii\web\View::POS_END);
?>

		<div id="most_engaging_video_filters">
		</div>

<?php
}else{ ?>
      <div id="most_engaging_video_filters"><div class="dummy_chart"><img src="<?= Url::to('@frontThemeUrl') ?>/images/pie_no.png" /></div></div>
<?php }
?>
</div>