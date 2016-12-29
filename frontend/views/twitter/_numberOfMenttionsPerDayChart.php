<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Mentions Interaction</h3>';
echo '<div class="internal-content">';
    if($mentions_per_day_json_table && ($total_mentions > 0)){
        $this->registerJs("GoogleCharts.drawColumns(".$mentions_per_day_json_table.", 'tw', 'mentions_per_day')", yii\web\View::POS_END);
        echo '<div id="mentions_per_day"></div>';
    }else{
    	echo '<div id="mentions_per_day"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
    }
echo '</div>';