<?php

use digi\authclient\clients\Youtube;

$client = Youtube::getClient();

echo '<img src="'.$channels["items"][0]["snippet"]["thumbnails"]["default"]["url"].'" alt="'.$channels["items"][0]["snippet"]["title"].'"/>';
echo '<br/>Hello '.$channels["items"][0]["snippet"]["title"];
$statistics = $channels["items"][0]["statistics"];
echo '<br/><br/>Channel Statistics since being alive :';
echo '<br/>View count : '.$statistics["viewCount"];
echo '<br/>Comment count : '.$statistics["commentCount"];
echo '<br/>Subscriber count : '.$statistics["subscriberCount"];
echo '<br/>Video count : '.$statistics["videoCount"];

echo '<br/><br/>Channel Analytics this year :';
if(array_key_exists('rows', $channel_analytics)){
    $channel_analytics_rows = $channel_analytics["rows"][0];
    echo '<br/>Views : '.$channel_analytics_rows[0];
    echo '<br/>Comments : '.$channel_analytics_rows[1];
    echo '<br/>Likes : '.$channel_analytics_rows[2];
    echo '<br/>Dislikes : '.$channel_analytics_rows[3];
    echo '<br/>Shares : '.$channel_analytics_rows[4];
    echo '<br/>Favorites Added : '.$channel_analytics_rows[5];
    echo '<br/>Favorites Removed : '.$channel_analytics_rows[6];
    echo '<br/>Estimate Minutes Watched : '.$channel_analytics_rows[7].' min';
    echo '<br/>Average View Percentage : '.$channel_analytics_rows[8].'%';
    echo '<br/>Subscriber Gained : '.$channel_analytics_rows[9];
    echo '<br/>Subscriber Lost : '.$channel_analytics_rows[10];
}

if((array_key_exists('relatedPlaylists', $channels["items"][0]["contentDetails"]) && array_key_exists('uploads', $channels["items"][0]["contentDetails"]["relatedPlaylists"]))){
    $uploads_playlist = $channels["items"][0]["contentDetails"]["relatedPlaylists"]["uploads"];
    $videos = $client->api("/youtube/v3/playlistItems?part=contentDetails,snippet&maxResults=50&playlistId=".$uploads_playlist, 'GET');
    if(array_key_exists('items', $videos) && (count($videos['items']) != 0)){
        echo "<br/><br/>This year's videos analytics :";
        foreach($videos['items'] as $video){
        
            echo '<br/><br/><img src="'.$video["snippet"]["thumbnails"]["default"]["url"].'" alt="'.$video["snippet"]["title"].'"/>';
            echo '<br/><br/>Title : '.$video["snippet"]["title"];
            $video_analytics = $client->api("/youtube/analytics/v1/reports?ids=channel==MINE&start-date=2013-01-01&end-date=".date('Y-m-d', time())."&filters=video==".$video['contentDetails']['videoId']."&dimension=filters&sort=-views&metrics=views,comments,likes,dislikes,shares,favoritesAdded,favoritesRemoved,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained,subscribersLost");
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
                echo '<br/>Average View Percentage : '.$video_analytics_rows[8].'%';
                echo '<br/>Subscriber Gained : '.$video_analytics_rows[9];
                echo '<br/>Subscriber Lost : '.$video_analytics_rows[10];
            }
        }
    }
}

if(array_key_exists('rows', $devices_os)){
    echo '<br/><br/>Device Types and Operating systems :';
    foreach($devices_os["rows"] as $device_os){
        echo '<br/><br/>Device : '.$device_os[0];
        echo '<br/>Operating System : '.$device_os[1];
        echo '<br/>Views : '.$device_os[3];
        echo '<br/>Estimate Minutes Watched : '.$device_os[2].' min';
    }
}

if(array_key_exists('rows', $gender_ages)){
    echo '<br/><br/>Gender and AgeGroups :';
    foreach($gender_ages["rows"] as $gender_age){
        echo '<br/><br/>Age : '.$gender_age[0];
        echo '<br/>Gender : '.$gender_age[1];
        echo '<br/>Viewr Percentage : '.$gender_age[2].'%';
        $gender_age_views = round((($channel_analytics_rows[0])*$gender_age[2])/100);
        echo '<br/>Views : '.$gender_age_views;
    }
}

if(array_key_exists('rows', $locations)){
    echo '<br/><br/>Countries :';
    foreach($locations["rows"] as $location){
        echo '<br/><br/>Country : '.$location[0];
        echo '<br/>Views : '.$location[1];
        echo '<br/>Estimated Minutes Watched : '.$location[2].' min';
        echo '<br/>Average View Duration : '.$location[3];
        echo '<br/>Average View Percentage : '.$location[4].'%';
        echo '<br/>Subscriber Gained : '.$location[5];
    }
}

if(array_key_exists('rows', $traffic_sources)){
    echo '<br/><br/> Traffic Sources:';
    foreach($traffic_sources["rows"] as $traffic_source){                     
        echo '<br/><br/>Traffic Source Type : '.$traffic_source[0];
        echo '<br/>Views : '.$traffic_source[1];
        echo '<br/>Estimated Minutes Watched : '.$traffic_source[2].' min';
    }
}

if(array_key_exists('rows', $sharing_services)){
    echo '<br/><br/>Sharing Services :';
    foreach($sharing_services["rows"] as $sharing_service){
        echo '<br/><br/>Sharing Service : '.$sharing_service[0];
    echo '<br/>Shares : '.$sharing_service[1];
    }
}