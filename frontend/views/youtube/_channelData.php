<?php



use digi\authclient\clients\Youtube;

use yii\helpers\Url;



?>
<div class="row">
    <div class="col-md-12">
        <div class="title-box">
            <h2 class="internal-title sec-title"><?= $channels["items"][0]["snippet"]["title"] ?> KPIs Overview</h2>
            <div class="line-box"></div>
        </div>
    </div>
</div>

<?php
 echo '<div class="row"><div class="col-md-6">';
    if($channels["items"]){

    $statistics = $channels["items"][0]["statistics"]; ?>

    <h3 class="internal-title youtube">Channel Statistics since being alive</h3>
    <div class="internal-content">
    <ul>
        <li><span class="small-title">View count : </span><?= $statistics["viewCount"] ?></li>

        <li><span class="small-title">Subscriber count : </span><?= $subscribers["pageInfo"]["totalResults"] ?></li>

        <li><span class="small-title">Video count : </span><?= $statistics["videoCount"] ?></li>
    </ul>
    </div></div><div class="col-md-6">
 <?php
    echo $this->render('_channelAnalytics', ['channel_analytics' => $channel_analytics, 'subscribers_count' => $subscribers["pageInfo"]["totalResults"]]);
    echo '</div></div>';

}else{

    echo 'No channel exists.';

}
?>






