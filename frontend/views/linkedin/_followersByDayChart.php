<?php
    if($followers_by_day_json_table){
	$this->registerJs("GoogleCharts.drawLineArea(".$followers_by_day_json_table.", 'ln', 'followers_by_day')", yii\web\View::POS_END);
	?>
        <h3 class="internal-title noneBG">Followers by day</h3>
	<div class="internal-content">
            <div id="followers_by_day"></div>
	</div>
<?php }
?>