<?php
if($most_engaging_post_types_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$most_engaging_post_types_json_table.", 'Most Engaging Post Types', 'most_engaging_post_types')", yii\web\View::POS_END);
?>
	<h3 class="internal-title noneBG">Most Engaging Post Types</h3>
	
	<div class="internal-content">	    
	    <div id="most_engaging_post_types">
		</div>
	</div>
	<?php
	}else{
	    echo '<h4>Most Engaging Post Types</h4><br/><p>No data to display</p>';
	}
	?>