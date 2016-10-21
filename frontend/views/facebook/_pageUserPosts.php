<div class="row">
    <div class="col-md-12">
        <h3 class="internal-title facebook"><?= $page_name ?> User Activity</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">    
        <h3 class="internal-title noneBG">Activity Overview</h3>
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
        if($page_user_posts_by_day_json_table){
            $this->registerJs("GoogleCharts.drawColumns(".$page_user_posts_by_day_json_table.", 'fb', 'user_posts')", yii\web\View::POS_END);
            echo '<h3 class="internal-title noneBG">User Posts</h3>';
            echo '<div class="internal-content">';
                echo '<div id="user_posts"></div>';
        	echo '</div>';
        }
        ?>
    </div>
</div>
