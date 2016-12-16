		<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Distribution of fans by City</h3>';
			echo '<div class="internal-content circleChart">';
		if($fans_city_json_table){
		    $this->registerJs("GoogleCharts.drawCircle(".$fans_city_json_table.", 'fb', 'fans_city')", yii\web\View::POS_END); 
				echo '<div id="fans_city"></div>';
		}else{
          echo '<div id="fans_city"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
        }
echo '</div>';
		?>
	