<?php
use yii\helpers\Url;
use digi\authclient\clients\Youtube;

if(array_key_exists('items', $videos) && (count($videos['items']) != 0)){
    echo "Videos :";
    foreach($videos['items'] as $video){
        echo '<br/><br/><a href="'.Url::to(['site/youtube-video', 'video_id' => $video['contentDetails']['videoId'], 'title' => $video["snippet"]["title"], 'img' => $video["snippet"]["thumbnails"]["default"]["url"]]).'">Title : '.$video["snippet"]["title"].'</a>';
        echo '<br/><br/><a href="'.Url::to(['site/youtube-video', 'video_id' => $video['contentDetails']['videoId'], 'title' => $video["snippet"]["title"], 'img' => $video["snippet"]["thumbnails"]["default"]["url"]]).'"><img src="'.$video["snippet"]["thumbnails"]["default"]["url"].'" alt="'.$video["snippet"]["title"].'"/></a>';
    }
}
