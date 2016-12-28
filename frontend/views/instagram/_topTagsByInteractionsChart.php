<?php
use yii\helpers\Url;
?>
<?php
echo '<h3 class="internal-title noneBG">Top Tags by interactions</h3>';
	echo '<div class="internal-content">';
if($tags_interactions_json_table){
    $this->registerJs("GoogleCharts.drawBars(".$tags_interactions_json_table.", 'in', 'top_tags_by_interaction')", yii\web\View::POS_END);	
	echo '<div id="top_tags_by_interaction"></div>'; 
}else{
	echo '<div id="top_tags_by_interaction"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_no.png" /></div></div>'; 
}
	echo '</div>';
