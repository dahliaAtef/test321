<?php
    $this->registerJs("GoogleCharts.drawCircle(".$post_types_json_table.", 'in', 'post_types')", yii\web\View::POS_END);
?>	
<h3 class="internal-title noneBG">Post Types</h3>
<div class="internal-content">
	<div id="post_types">
	</div>
</div>