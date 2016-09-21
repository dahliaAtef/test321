<?php

use digi\authclient\clients\Instagram;

$insta = new Instagram ();
if($media["data"] != 0){
    //$interaction_per_post_type = [];

    echo '<br/><br/>Recent media<br/><br/>';
    
    foreach($media["data"] as $sMedia){
        
        $likes = $insta->getMediaLikes($sMedia["id"]);
        $comments = $insta->getMediaComments($sMedia["id"]);
        $total_interaction_per_post = ($sMedia["comments"]["count"])+($sMedia["likes"]["count"]);
        //$interaction_per_post_type[$sMedia["id"]][$sMedia["type"]] = $total_interaction_per_post;
        $engagement_per_1k_followers = ((($total_interaction_per_post)/($followed_by_count))*1000);
        
        if($sMedia["type"] == 'video'){
            echo '<embed src="'.$sMedia["videos"]["thumbnail"]["url"].'" width="'.$sMedia["videos"]["thumbnail"]["width"].'" height="'.$sMedia["videos"]["thumbnail"]["height"].'" ><br/>';
        }else{
            echo '<img src="'.$sMedia["images"]["thumbnail"]["url"].'" width="'.$sMedia["images"]["thumbnail"]["width"].'" height="'.$sMedia["images"]["thumbnail"]["height"].'" /><br/>';
        }
        
        echo '<br/>Location : '.$sMedia["location"]["name"];
        echo '<br/>Created at '.date('M d, Y', $sMedia["created_time"]);
        
        echo $this->render('_mediaComments', ['comments' => $comments, 'comments_count' => $sMedia["comments"]["count"]]);
        
        echo $this->render('_mediaLikes', ['likes' => $likes, 'likes_count' => $sMedia["likes"]["count"]]);
        
        echo '<br/>Total interactions per post = '.$total_interaction_per_post;
        echo '<br/>Engagement per 1000 followers = '.round($engagement_per_1k_followers).'%';
        echo '<br/><br/>';
    }

    //echo $this->render('_interactionPerMediaTypeChart', ['interaction_per_json_type_json_table' => Instagram::getInteractionPerPostTypeJsonTable($interaction_per_post_type)]);
}