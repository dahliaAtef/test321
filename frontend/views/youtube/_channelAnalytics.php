<?php

if(array_key_exists('rows', $channel_analytics)){
    //echo '<pre>'; var_dump($channel_analytics); echo '</pre>'; die;
    echo '<h3 class="internal-title youtube">Channel Analytics :</h3>';
    echo '<div class="internal-content">';
    echo '<ul>';
    echo '<div class="row">';
    $channel_analytics_rows = $channel_analytics["rows"][0];
     ?>
    <li class="col-md-5"><span class="small-title">Views : </span><?= $channel_analytics_rows[0] ?></li>
    <li class="col-md-5"><span class="small-title">Comments : </span><?= $channel_analytics_rows[1] ?></li>
    <li class="col-md-5"><span class="small-title">Likes : </span><?= $channel_analytics_rows[2] ?></li>
    <li class="col-md-5"><span class="small-title">Dislikes : </span><?= $channel_analytics_rows[3] ?></li>
    <li class="col-md-5"><span class="small-title">Shares : </span><?= $channel_analytics_rows[4] ?></li>
    <li class="col-md-5"><span class="small-title">Minutes Watched : </span><?= $channel_analytics_rows[5] ?> mins</li>
    <li class="col-md-5"><span class="small-title">Average View Duration : </span><?= $channel_analytics_rows[6] ?> mins</li>
    <li class="col-md-5"><span class="small-title">Average View Percentage : </span><?= round($channel_analytics_rows[7], 2) ?>%</li>
    <li class="col-md-5"><span class="small-title">Subscriber Gained : </span><?= $channel_analytics_rows[8] ?></li>
    <li class="col-md-5"><span class="small-title">Subscriber Lost : </span><?= $channel_analytics_rows[9] ?></li>
    <?php
	if($subscribers_count != 0){
        $engagement = round((($channel_analytics_rows[0]+$channel_analytics_rows[1]+$channel_analytics_rows[2]+$channel_analytics_rows[4]+$channel_analytics_rows[8])/$subscribers_count), 1); 
		?>
        <li class="col-md-6"><span class="small-title">Engagement : </span><?= $engagement ?>%</li>
    <?php } ?>
    </ul>
	</div>
<?php } ?>
