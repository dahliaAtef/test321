<?php
use yii\helpers\Url;
?>
<div class="col-md-6">     
    <?php
    echo '<h3 class="internal-title noneBG">Channel views per Sharing Service</h3>';
    echo '<div class="internal-content circleChart adaptMargin34">';
    if($sharing_services_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$sharing_services_json_table.", 'yg', 'sharing_services')", yii\web\View::POS_END);	
        echo '<div id="sharing_services"></div>';
    }else{
    	echo '<div id="sharing_services"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
    }
	echo '</div>'; 
    ?>
</div>
<div class="col-md-6">
<?php
if(array_key_exists('rows', $sharing_services)){
?>
<table class="youtube adaptMargin34">
    <tr>
        <th>Sharing Service</th>
        <th>Shares</th>
    </tr>
    <?php
    foreach($sharing_services['rows'] as $sharing_service){
    ?>
    <tr>
        <td><?= ucwords(strtolower($sharing_service[0])) ?></td>
        <td><?= $sharing_service[1] ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div>