<?php

    $this->registerJs("GoogleCharts.drawColumns(".$interaction_per_json_type_json_table.", 'interaction per media type', 'media_interaction')", yii\web\View::POS_END);	echo '<h3>Interaction per Media Type</h3>';
    echo '<div id="media_interaction"></div>';
