<div class="row">
    <div class="col-md-12">
        <?php
        use digi\authclient\clients\Twitter;

        $devices_json_table = Twitter::getDeviceTypeJsonTable($devices);
        if($devices_json_table){
            echo '<h3 class="internal-title twitter short">Twitter</h3>';
            $this->registerJs("GoogleCharts.drawBars(".$devices_json_table.", 'views by device type', 'tw_view_by_device_type')", yii\web\View::POS_END);
            echo '<div class="internal-content">';
            echo '<div id="tw_view_by_device_type"></div>';
            echo '</div>';
        }

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
        echo '<div class="internal-content">';
        echo '<span class="bold-title">Majority : '.$device_type.' by '.$max.' Percentage </span><span class="rounded twitter">'.round(((($max)/ $sum)*100)).'%</span>';
        echo '</div>';
        ?>
</div>
</div>
