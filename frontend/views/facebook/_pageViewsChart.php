<div class="row">
	<div class="col-md-12">
		<?php
		if($page_views_json_table){
		    $this->registerJs("GoogleCharts.drawLineArea(".$page_views_json_table.", 'fb', 'page_views')", yii\web\View::POS_END);
		    echo '<h3 class="internal-title noneBG">Views</h3>';
		    echo '<div class="internal-content">';
				echo '<div id="page_views"></div>';
			echo '</div>';
		}
		?>
	</div>
</div>