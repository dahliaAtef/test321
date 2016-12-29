<?php
use digi\authclient\clients\Youtube;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">
        <?php
        echo '<h3 class="internal-title youtube short">Youtube</h3>';
        $devices_json_table = Youtube::getDeviceTypeJsonTable($devices);
        if($devices_json_table && (array_sum($devices) > 0)){
            $sum = array_sum($devices);
            $max = max($devices);
            switch($max){
                case ($devices['desktop'] == $max):
                    $device_type = 'Desktop';
                    break;
                case ($devices['mobile/tablet'] == $max):
                    $device_type = 'Mobile/Tablet';
                    break;
                case ($devices['other'] == $max):
                    $device_type = 'Others';
                    break;
            }
            echo '<div class="info-title">';
            echo '<span class="bold-title">Majority : '.$device_type.' by '.$max.' Percentage  </span><span class="rounded youtube">'.round(((($max)/ $sum)*100)).'%</span>';
            echo '</div>';
            $this->registerJs("GoogleCharts.drawBars(".$devices_json_table.", 'yg', 'yt_view_by_device_type')", yii\web\View::POS_END);
            echo '<div class="internal-content">';
            echo '<div id="yt_view_by_device_type"></div>';
            echo '</div>';
        }else{
        	echo '<div class="info-title">';
            echo '<span class="bold-title">Majority : .... by .... Percentage  </span><span class="rounded youtube">....%</span>';
            echo '</div>';
            echo '<div class="internal-content">';
            echo '<div id="yt_view_by_device_type"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_no.png" /></div></div>';
            echo '</div>';
        }
        ?>
</div>
</div>

