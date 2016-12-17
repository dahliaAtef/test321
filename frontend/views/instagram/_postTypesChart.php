<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Post Types</h3>
<div class="internal-content circleChart">
<?php
if($post_types_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$post_types_json_table.", 'in', 'post_types')", yii\web\View::POS_END);
?>
	<div id="post_types"></div>
<?php }else{ 
	echo '<div id="post_types"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
} ?>
</div>