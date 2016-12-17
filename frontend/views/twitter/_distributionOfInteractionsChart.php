<?php
use yii\helpers\Url;


echo '<h3 class="internal-title noneBG">Distribution of Interaction</h3>';
echo '<div class="internal-content circleChart">';
      if($interactions_by_type_json_table && $total_interaction){
          $this->registerJs("GoogleCharts.drawCircle(".$interactions_by_type_json_table.", 'tw', 'interactions_by_type')", yii\web\View::POS_END);
		  echo '<div id="interactions_by_type"></div>';
	}else{
    	echo '<div id="interactions_by_type"><div class="dummy_chart"><img src="'.Url::to(['@frontThemeUrl']).'/images/pie_no.png"/></div></div>';
    }
echo '</div>';
    