<div class="col-md-6">     
    <?php
    //echo '<pre>'; var_dump($sharing_services); echo '</pre>'; die;
    if($sharing_services_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$sharing_services_json_table.", 'Channel view per Sharing Service', 'sharing_services')", yii\web\View::POS_END);	
        echo '<h3 class="internal-title noneBG">Channel view per Sharing Service</h3>';
        echo '<div class="internal-content adaptMargin34">';      
            echo '<div id="sharing_services"></div>';
        echo '</div>'; 
    }
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
        <td><?= $sharing_service[0] ?></td>
        <td><?= $sharing_service[1] ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div>