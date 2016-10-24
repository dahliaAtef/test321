<?php
if($country_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$country_json_table.", 'fb', 'fans_country')", yii\web\View::POS_END);
?>
<h3 class="internal-title noneBG">Distribution of fans by Country</h3>
	<div class="internal-content circleChart">
		<div id="fans_country" style="margin:auto"></div>
	</div>
<?php }
?>