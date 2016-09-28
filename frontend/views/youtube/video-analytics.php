<?php
use yii\helpers\Url;
$this->title = 'Youtube';

?>
<div class="page-content inside youtube">
    <div class="container">
	<div class="inner-page">
            <?php        
            echo 'Title : '.$title.'';
            echo '<br/><br/><img src="'.$img.'" alt="'.$title.'"/>';

            if(array_key_exists('rows', $video_analytics)){
                $video_analytics_rows = $video_analytics["rows"][0];
                echo '<br/>Views : '.$video_analytics_rows[0];
                echo '<br/>Comments : '.$video_analytics_rows[1];
                echo '<br/>Likes : '.$video_analytics_rows[2];
                echo '<br/>Dislikes : '.$video_analytics_rows[3];
                echo '<br/>Shares : '.$video_analytics_rows[4];
                echo '<br/>Favorites Added : '.$video_analytics_rows[5];
                echo '<br/>Favorites Removed : '.$video_analytics_rows[6];
                echo '<br/>Estimate Minutes Watched : '.$video_analytics_rows[7].' min';
                echo '<br/>Average View Duration : '.$video_analytics_rows[8].' mins';
                echo '<br/>Average View Percentage : '.round($video_analytics_rows[9], 2).'%';
            }
            ?>
        </div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->