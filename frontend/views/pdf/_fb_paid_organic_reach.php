<?php
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-12">
		<?php
		echo '<h3 class="internal-title facebook short">Facebook</h3>';
		echo '<div class="internal-content">';
		if($reach){
		    $this->registerJs("GoogleCharts.drawLineArea(".$reach.", 'fb', 'fb_organic_paid_reach')", yii\web\View::POS_END);
		    	echo '<div id="fb_organic_paid_reach"></div>';
		}else{
        	echo '<div id="fb_organic_paid_reach"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/line_area_no.png" /></div></div>';
        }
		echo '</div>';
		?>
	</div>
</div>