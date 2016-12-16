<?php
use yii\helpers\Url;

echo '<h3 class="internal-title noneBG">Number of Posts</h3>';
echo '<div class="internal-content">';
	if($number_of_posts_json_table){
    	$this->registerJs("GoogleCharts.drawColumns(".$number_of_posts_json_table.", 'in', 'posts_per_day')", yii\web\View::POS_END);
    	echo '<div id="posts_per_day"></div>';
    }else{
    	echo '<div id="posts_per_day"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
    }
echo '</div>';