<?php
use yii\helpers\Url;
?>

<div class="row">
	<div class="col-md-12">
		<?php
echo '<h3 class="internal-title noneBG ">Channels Interactions</h3>';
echo '<div class="internal-content">';
		$interactions = 0;
		foreach($kpi_overviews as $array){
          $interactions += $array['interactions'];
        }
		if($interaction_per_channel_json_table && ($interactions > 0)){
		    $this->registerJs("GoogleCharts.drawColumns(".$interaction_per_channel_json_table.", 'Interactions per Channels', 'channel_insteractions')", yii\web\View::POS_END);
		   		 echo '<div id="channel_insteractions"></div>';
		}else{
        	echo '<div id="channel_insteractions"><div class="dummy_chart" ><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
        }
echo "</div>";
		?>
	</div>
</div>