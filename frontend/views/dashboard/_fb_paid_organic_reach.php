
<div class="row">
    <div class="col-md-12">
		<?php
		if($reach){
            echo '<h3 class="internal-title facebook short">Facebook</h3>';
		    $this->registerJs("GoogleCharts.drawLineArea(".$reach.", 'fb', 'fb_organic_paid_reach')", yii\web\View::POS_END);
                echo '<div class="internal-content">';
		    	echo '<div id="fb_organic_paid_reach"></div>';
                echo '</div>';
		}
		?>
	</div>
</div>