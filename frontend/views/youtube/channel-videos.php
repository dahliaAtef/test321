<?php
use yii\helpers\Url;
$this->title = 'Youtube';
?>
<div class="page-content inside youtube">
    <div class="container">
	<div class="inner-page">
            <?php
            if(array_key_exists('items', $videos) && (count($videos['items']) != 0)){
                echo "Videos :";
                foreach($videos['items'] as $video){
                    echo '<br/><br/><a href="'.Url::to(['youtube/v/'.$video['contentDetails']['videoId']]).'">Title : '.$video["snippet"]["title"].'</a>';
                    echo '<br/><br/><a href="'.Url::to(['youtube/v/'.$video['contentDetails']['videoId']]).'"><img src="'.$video["snippet"]["thumbnails"]["default"]["url"].'" alt="'.$video["snippet"]["title"].'"/></a>';
                }
            }

            echo '<br/><br/><a href="#">Load more</a>';
            ?>
        </div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->
<div class="page-tabs">
    <div class="tabs">
	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube active"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>
    </div>
</div>