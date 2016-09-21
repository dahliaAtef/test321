<?php

    if($interactions_by_type){
        ?>
        <table  class="twitter adaptMargin">
            <tr>
                <th>Interaction Type</th>
                <th>% of Interactions</th>
                <th># of Interactions</th>
            </tr>
        <?php
        foreach($interactions_by_type as $interaction_type_key => $interaction_type_value){
            ?>
            <tr>
                <td><?= $interaction_type_key ?></td>
                <td><?= round((($interaction_type_value * $total_interactions)/100), 2) ?>%</td>
                <td><?= $interaction_type_value ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    <?php }