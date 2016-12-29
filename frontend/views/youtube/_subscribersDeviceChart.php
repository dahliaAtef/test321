<?php
use yii\helpers\Url;
?>

<div class="col-md-6">
    <?php
	echo '<h3 class="internal-title noneBG">Channel views per Device Type</h3>';
	echo '<div class="internal-content circleChart adaptMargin34">';
    if($device_types_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$device_types_json_table.", 'yg', 'device_views')", yii\web\View::POS_END);
      	echo '<div id="device_views"></div>';
    }else{
    	echo '<div id="device_views"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
    }
	echo '</div>';
    ?>
</div>
<div class="col-md-6">
    <?php
    if(array_key_exists('rows', $device_types)){
    ?>
    <table class="youtube adaptMargin34">
        <tr>
            <th>Device Type</th>
            <th>Estimated Minutes Watched</th>
            <th>Views</th>
        </tr>
        <?php
        foreach($device_types['rows'] as $device){
        ?>
        <tr>
            <td><?= ucwords(strtolower($device[0])) ?></td>
            <td><?= $device[1] ?></td>
            <td><?= $device[2] ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</div>