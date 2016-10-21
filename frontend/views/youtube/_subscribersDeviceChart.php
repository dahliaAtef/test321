<div class="col-md-6">
    <?php
    if($device_types_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$device_types_json_table.", 'yg', 'device_views')", yii\web\View::POS_END);
    	echo '<h3 class="internal-title noneBG">Channel view per Device Type</h3>';
        echo '<div class="internal-content adaptMargin34">';
            echo '<div id="device_views"></div>';
        echo '</div>';
    }
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
            <td><?= $device[0] ?></td>
            <td><?= $device[1] ?></td>
            <td><?= $device[2] ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</div>