<?php
use yii\helpers\Url;
?>

<div class="col-md-6">    
    <?php
echo '<h3 class="internal-title noneBG">Channel views per Traffic Source</h3>';
echo '<div class="internal-content circleChart adaptMargin34">';  
    if($traffic_sources_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$traffic_sources_json_table.", 'yg', 'traffic_sources_views')", yii\web\View::POS_END);
    	echo '<div id="traffic_sources_views"></div>';
    }else{
    	echo '<div id="traffic_sources_views"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
    }
echo '</div>'; 
    ?>
</div>
<div class="col-md-6">
<?php
if(array_key_exists('rows', $traffic_sources)){
?>
<table class="youtube adaptMargin34">
    <tr>
        <th>Traffic Source</th>
        <th>Estimated Minutes Watched</th>
        <th>Views</th>
    </tr>
    <?php
    foreach($traffic_sources['rows'] as $traffic_source){
    ?>
    <tr>
        <td><?= ucwords(strtolower($traffic_source[0])) ?></td>
        <td><?= $traffic_source[1] ?></td>
        <td><?= $traffic_source[2] ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div>