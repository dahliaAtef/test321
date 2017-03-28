<?php
use yii\helpers\Url;
use yii\helpers\Html;

foreach($posts["data"] as $post){
    if($post["type"] == 'photo'){
        echo '<br /><img src="'.$post["picture"].'" alt="post image" width=250px height= 250px/><br />';
    }elseif(array_key_exists('attachments', $post)){
        echo '<br /><img src="'.$post["attachments"]["data"][0]["media"]["image"]["src"].'" alt="post image" width=250px height= 250px/><br />';
    }
            
    if(array_key_exists('message', $post)){
        echo '<br/><a href="'.Url::to(['site/fb-page-post', 'post_id' => $post["id"]]).'">'.Html::encode($post["message"]).'</a><br/>';
    }elseif(array_key_exists('story', $post)){
        echo '<br /><a href="'.Url::to(['site/fb-page-post', 'post_id' => $post["id"]]).'">'.Html::encode($post["story"]).'</a><br/>';
    }
            
    echo 'Published at '.date('Y-m-d', strtotime($post["created_time"])).'<br/><hr/>';
} 
?>