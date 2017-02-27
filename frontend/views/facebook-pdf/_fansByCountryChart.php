<?php
use yii\helpers\Url;
?>
<h3 class="internal-title noneBG">Distribution of fans by Country</h3>
	<div class="internal-content circleChart">
<?php
if($country_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$country_json_table.", 'fb', 'fans_country')", yii\web\View::POS_END);
?>
            <div id="fans_country"><img src="<?= $fans_country_img ?>"></div>
<?php }else{
	echo '<div id="fans_country"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
} ?>
</div>