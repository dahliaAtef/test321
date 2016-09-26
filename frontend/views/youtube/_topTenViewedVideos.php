
<?php
use yii\helpers\Url;
use digi\authclient\clients\Youtube;

if(array_key_exists('rows', $top_ten_viewed_videos)){
    echo "<div class='row'>";
    echo "<h3 class='internal-title noneBG'>Top 10 viewed videos</h3>";
    echo "</div>";
    echo "<div class='row'>";
    foreach($top_ten_viewed_videos['rows'] as $video){
        $video_data = Youtube::getVideoData($video[0]);	
		$img_src = (array_key_exists('maxres', $video_data["items"][0]["snippet"]["thumbnails"])) ? ($video_data["items"][0]["snippet"]["thumbnails"]['maxres']) : ((array_key_exists('standard', $video_data["items"][0]["snippet"]["thumbnails"])) ? ($video_data["items"][0]["snippet"]["thumbnails"]['standard']) : ($video_data["items"][0]["snippet"]["thumbnails"]['high']))
		?>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="post-item">
                    <a target="_blank" href ="<?= Url::to(['youtube/v/'.$video[0]]) ?>">
                        <div class="post-img">
                            <img src="<?= $img_src["url"] ?>" alt="<?= $video_data["items"][0]["snippet"]["title"] ?>"/>
                        </div>
                        <div class="internal-content">
                    		<ul>			
                                <li class="special-height"><span class="small-title">Title : </span><?= $video_data["items"][0]["snippet"]["title"] ?></li>
                				<li><span class="small-title">Minutes watched : </span><?= $video[1] ?></li> 
                				<li><span class="small-title">Views : </span><?= $video[2] ?></li>
                				<li><span class="small-title">Likes : </span><?= $video[3] ?></li>
                				<li><span class="small-title">Subscribers gained : </span><?= $video[4] ?></li>		
                            </ul>
                        </div>
                    </a>
                </div>
            </div>

        <?php }  ?>
        </div>
        <?php } ?>


