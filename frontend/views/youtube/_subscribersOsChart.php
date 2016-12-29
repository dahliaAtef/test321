<?php
use yii\helpers\Url;
?>

<div class="col-md-6">    
    <?php
echo '<h3 class="internal-title noneBG">Channel views per Operating System</h3>';
echo '<div class="internal-content circleChart adaptMargin34">'; 
    if($os_json_table){
        $this->registerJs("GoogleCharts.drawCircle(".$os_json_table.", 'yg', 'OS_views')", yii\web\View::POS_END);  
        echo '<div id="OS_views"></div>';
    }else{
    	echo '<div id="OS_views"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
    }
echo '</div>'; 
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
        <td><?= ucwords(strtolower($single_os[0])) ?></td>
        <td><?= $single_os[1] ?></td>
        <td><?= $single_os[2] ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div>