<?php

use digi\authclient\clients\Twitter;

echo '<br /><br />- Followers :';
        foreach($followers as $follower){
            echo '<br />'.$follower["name"].', screen name : '.$follower["screen_name"].', location : '.$follower["location"];
        }
        if($data["followers_count"] > count($followers)){
            while($followers["next_count"] != 0){
                $followers = Twitter::getTheRestOfFollowers($followers["next_cursor"]);
                foreach($followers as $follower){
                    echo '<br /><br />'.$follower["name"].', screen name : '.$follower["screen_name"].', location : '.$follower["location"];
                }
            }
        }
        