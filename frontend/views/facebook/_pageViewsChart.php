<?php
use yii\helpers\Url;
?>
<div class="row">
	<div class="col-md-12">
		<?php
		echo '<h3 class="internal-title noneBG">Views</h3>';
		echo '<div class="internal-content">';
		if($page_views_json_table){
		    $this->registerJs("GoogleCharts.drawLineArea(".$page_views_json_table.", 'fb', 'page_views')", yii\web\View::POS_END);
			echo '<div id="page_views"></div>';
		}else{
        	echo '<div id="page_views"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/line_no.png" /></div></div>';
        }
		echo '</div>';
		?>
	</div>
</div>