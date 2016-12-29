<h3 class="internal-title youtube">Channel Analytics :</h3>
<div class="internal-content">
	<ul>
		<div class="row">
<?php

if(array_key_exists('rows', $channel_analytics)){
    $channel_analytics_rows = $channel_analytics["rows"][0];
     ?>
    <li class="col-lg-5 col-md-6"><span class="small-title">Views : </span><?= $channel_analytics_rows[0] ?></li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Comments : </span><?= $channel_analytics_rows[1] ?></li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Likes : </span><?= $channel_analytics_rows[2] ?></li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Dislikes : </span><?= $channel_analytics_rows[3] ?></li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Shares : </span><?= $channel_analytics_rows[4] ?></li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Subscriber Gained : </span><?= $channel_analytics_rows[8] ?></li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Subscriber Lost : </span><?= $channel_analytics_rows[9] ?></li>
    <li class="col-lg-5 col-md-12"><span class="small-title">Minutes Watched : </span><?= $channel_analytics_rows[5] ?> mins</li>
    <li class="col-lg-5 col-md-12"><span class="small-title">AVG View Duration : </span><?= $channel_analytics_rows[6] ?> mins</li>
    <li class="col-lg-5 col-md-12"><span class="small-title">AVG View Percentage : </span><?= round($channel_analytics_rows[7], 2) ?>%</li>
    <?php
	if($subscribers_count != 0){
        $engagement = round((($channel_analytics_rows[0]+$channel_analytics_rows[1]+$channel_analytics_rows[2]+$channel_analytics_rows[4]+$channel_analytics_rows[8])/$subscribers_count), 1); 
		?>
        <li class="col-md-6"><span class="small-title">Engagement : </span><?= $engagement ?>%</li>
    <?php } ?>
    
<?php }else{ ?>
	<li class="col-lg-5 col-md-6"><span class="small-title">Views : </span>0</li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Comments : </span>0</li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Likes : </span>0</li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Dislikes : </span>0</li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Shares : </span>0</li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Subscriber Gained : </span>0</li>
    <li class="col-lg-5 col-md-6"><span class="small-title">Subscriber Lost : </span>0</li>
    <li class="col-lg-5 col-md-12"><span class="small-title">Minutes Watched : </span>0 mins</li>
    <li class="col-lg-5 col-md-12"><span class="small-title">AVG View Duration : </span>0 mins</li>
    <li class="col-lg-5 col-md-12"><span class="small-title">AVG View Percentage : </span>0%</li>
    <li class="col-md-6"><span class="small-title">Engagement : </span>0%</li> 
<?php } ?>
      </div>
	</ul>
</div>