<?php
use digi\authclient\clients\Twitter;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-12">
        <?php

        echo '<h3 class="internal-title twitter short">Twitter</h3>';
        $devices_json_table = Twitter::getDeviceTypeJsonTable($devices);
        if($devices_json_table && (array_sum($devices) > 0) ){
          	if(! empty($devices)) {
                $sum = array_sum($devices);
                $max = max($devices);
                switch ($max) {
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
            }else{
                $device_type== 'Others';
                $sum=1;
                $max=0;
            }
            echo '<div class="info-title">';
            echo '<span class="bold-title">Majority : '.$device_type.' by '.$max.' Percentage </span><span class="rounded twitter">'.round(((($max)/ $sum)*100)).'%</span>';
            echo '</div>';
            $this->registerJs("GoogleCharts.drawBars(".$devices_json_table.", 'tw', 'tw_view_by_device_type')", yii\web\View::POS_END);
            echo '<div class="internal-content">';
            echo '<div id="tw_view_by_device_type"></div>';
            echo '</div>';
        }else{
        	echo '<div class="info-title">';
            echo '<span class="bold-title">Majority : .... by .... Percentage </span><span class="rounded twitter">....%</span>';
            echo '</div>';
            echo '<div class="internal-content">';
            echo '<div id="tw_view_by_device_type"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_no.png" /></div></div>';
        }
        ?>
</div>
</div>
