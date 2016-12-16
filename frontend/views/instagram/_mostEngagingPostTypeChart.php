<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Most Engaging Post Types</h3>
	
	<div class="internal-content circleChart">	
<?php
if($most_engaging_post_types_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$most_engaging_post_types_json_table.", 'in', 'most_engaging_post_types')", yii\web\View::POS_END);
?>
	<div id="most_engaging_post_types"></div>
	<?php
	}else{
	    echo '<div id="most_engaging_post_types"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
	}
	?>
</div>