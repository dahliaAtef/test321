<?php
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title facebook">Interactions Overview</h3>
        <div class="internal-content">
            <ul>
                <li><span class="small-title">Total Interactions : </span><?= $total_interactions ?></li>
                <li><span class="small-title">Max Interactions : </span><?= $max_interaction ?> on <?= $max_interaction_day ?></li>
                <li><span class="small-title">Min Interactions : </span><?= $min_interaction ?> on <?= $min_interaction_day ?></li>
                <li><span class="small-title">Avg Interactions per day : </span><?= round((($total_interactions)/31), 2) ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
  			echo '<h3 class="internal-title noneBG">Daily Interactions</h3>';
            echo '<div class="internal-content">';
        if($page_interaction_by_day_json_table && $total_interactions){
            $this->registerJs("GoogleCharts.drawColumns(".$page_interaction_by_day_json_table.", 'fb', 'daily_interaction')", yii\web\View::POS_END);
                echo '<div id="daily_interaction"><img src="'.$daily_interaction_img.'"></div>';
        }else{
        	echo '<div id="daily_interaction"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';
        }
	echo '</div>';
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="facebook">
            <tr>
                <th>Interaction Type</th>
                <th>Percentage of Interactions</th>
                <th>Number of Interactions</th>
            </tr>
            
            <tr>
                <td>Reactions</td>
                <td><?= (($total_interactions != 0) ? round(((($total_reactions)/($total_interactions))*100), 2) : 0) ?></td>
                <td><?= ($total_reactions) ?></td>
            </tr>
            <tr>
                <td>Comments</td>
                <td><?= (($total_interactions != 0) ? round(((($total_comments)/($total_interactions))*100), 2) : 0) ?></td>
                <td><?= ($total_comments) ?></td>
            </tr>
            <tr>
                <td>Shares</td>
                <td><?= (($total_interactions != 0) ? round(((($total_shares)/($total_interactions))*100), 2) : 0) ?></td>
                <td><?= ($total_shares) ?></td>
            </tr>
        </table>
    </div>
</div>
