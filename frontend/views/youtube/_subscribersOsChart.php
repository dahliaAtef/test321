<div class="col-md-6">    
    <?php

    if($os_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$os_json_table.", 'yg', 'OS_views')", yii\web\View::POS_END);
    	echo '<h3 class="internal-title noneBG">Channel view per Operating System</h3>';
        echo '<div class="internal-content circleChart adaptMargin34">';    
            echo '<div id="OS_views"></div>';
        echo '</div>'; 
    }

    ?>
</div>
<div class="col-md-6">
<?php
if(array_key_exists('rows', $os)){
?>
<table class="youtube adaptMargin34">
    <tr>
        <th>Operating System</th>
        <th>Estimated Minutes Watched</th>
        <th>Views</th>
    </tr>
    <?php
    foreach($os['rows'] as $single_os){
    ?>
    <tr>
        <td><?= $single_os[0] ?></td>
        <td><?= $single_os[1] ?></td>
        <td><?= $single_os[2] ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div>