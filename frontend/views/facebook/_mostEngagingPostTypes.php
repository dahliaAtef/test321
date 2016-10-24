<?php

$most_engaging_post_types_json_table = $fb->getMostEngagingPostTypesJsonTable($post_types);
//echo '<pre>'; var_dump($post_types_json_table); echo '</pre>'; die;
if($most_engaging_post_types_json_table){
    $this->registerJs("GoogleCharts.drawCircle(".$most_engaging_post_types_json_table.", 'fb', 'most_engaging_post_types')", yii\web\View::POS_END);
	echo '<h3 class="internal-title noneBG">Most Engaging Post Types</h3>';
    echo '<div class="internal-content circleChart">';   
    echo '<div id="most_engaging_post_types"></div>';
    echo '</div>';  
}
?>
<table class="facebook">
    <tr>
        <th>Post Type</th>
        <th>interaction %</th>
        <th>No. of Interactions</th>
        <th>Interaction Per 1000 Fans</th>
    </tr>
    <?php
    foreach($post_types as $type => $values){
    ?>
    <tr>
        <td><?= $type ?></td>
        <td><?= (($total_interactions != 0) ? round(((($values['interaction'])/($total_interactions))*100), 2) : 0) ?>%</td>
        <td><?= ($values['interaction']) ?></td>
        <td><?= round(($values['engagement']),2) ?></td>
    </tr>
    <?php } ?>
</table>