<?php
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">
        <h3 class="internal-title facebook" style="background-color:#4066ab">User Activity</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">    
        <h3 class="internal-title noneBG" style="text-align:left">Activity Overview</h3>
        <?php
        $max = 0;
        foreach($user_posts as $posts_per_day){
            if($posts_per_day > $max)
                $max = $posts_per_day;
        }
        ?>
        <div class="internal-content">
            <ul>
                <li><span class="small-title">Total User Posts : </span><?= array_sum($user_posts) ?></li>
                <li><span class="small-title">Max User Posts : </span><?= $max ?></li>
                <li><span class="small-title">Avg Posts per day : </span><?= round(((array_sum($user_posts))/(31)), 2) ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
          echo '<h3 class="internal-title noneBG" style="text-align:center; color: #6d6e71;">User Posts</h3>';
            echo '<div class="internal-content">';
        if($page_user_posts_by_day_json_table && (array_sum($user_posts) > 0)){
            $this->registerJs("GoogleCharts.drawColumns(".$page_user_posts_by_day_json_table.", 'fb', 'user_posts')", yii\web\View::POS_END);
                echo '<div id="user_posts"><img src="'.$user_posts_img.'"></div>';	
        }else{
        	echo '<div id="user_posts"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/bar_2_no.png" /></div></div>';	
        }
		echo '</div>';
        ?>
    </div>
</div>
