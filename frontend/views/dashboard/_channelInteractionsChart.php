<div class="row">
	<div class="col-md-12">
		<?php
		if($interaction_per_channel_json_table){
		    $this->registerJs("GoogleCharts.drawColumns(".$interaction_per_channel_json_table.", 'Interactions per Channels', 'channel_insteractions')", yii\web\View::POS_END);
		    echo '<h3 class="internal-title noneBG ">Channels Interactions</h3>';
		    echo '<div class="internal-content">';
		   		 echo '<div id="channel_insteractions"></div>';
		    echo "</div>";
		}   
		?>
	</div>
</div>