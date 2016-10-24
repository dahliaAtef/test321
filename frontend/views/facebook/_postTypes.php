<?php

$post_types_json_table = $fb->getPostTypesJsonTable($post_types);
if($post_types_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$post_types_json_table.", 'fb', 'post_types')", yii\web\View::POS_END);
    echo '<h3 class="internal-title noneBG">Post Types</h3>';
    echo '<div class="internal-content circleChart">';   
    echo '<div id="post_types"></div>';
    echo '</div>';  
}
?>
<table class="facebook">
    <tr>
        <th>Post Type</th>
        <th>Post Type %</th>
        <th>N0. of Post Type</th>
    </tr>
    <?php
    foreach($post_types as $type => $values){
    ?>
    <tr>
        <td><?= $type ?></td>
        <td><?= (($total_posts != 0) ? round(((($values['value'])/($total_posts))*100), 2) : 0) ?></td>
        <td><?= ($values['value']) ?></td>
    </tr>
    <?php } ?>
</table>