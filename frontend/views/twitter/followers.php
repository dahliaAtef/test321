<?php

use digi\authclient\clients\Twitter;

$locations = array();
$locations['undefined']= 0;
echo '- Followers :<br/><br/>';
        foreach($followers['users'] as $follower){
            echo '<br /><br />'.$follower["name"].', screen name : '.$follower["screen_name"];
            echo '<br/>Location : '.$follower["location"];
            if(array_key_exists($follower["location"], $locations)){
                $locations[$follower["location"]]++;
            }elseif(!$follower["location"]){
                $locations['undefined']++;
            }else{
                $locations[$follower["location"]] = 1;
            }
            echo '<br/>language : '.$follower["lang"].'<br/>';
        }
        
        if($followers_count > count($followers['users'])){
            while($followers["next_count"] != 0){
                $followers = Twitter::getTheRestOfFollowers($followers["next_cursor"]);
                foreach($followers as $follower){
                    echo '<br /><br />'.$follower["name"].', screen name : '.$follower["screen_name"];
                    echo '<br/>Location : '.$follower["location"];
                    if(array_key_exists($follower["location"], $locations)){
                        $locations[$follower["location"]]++;
                    }elseif(!$follower["location"]){
                        $locations['undefined']++;
                    }else{
                        $locations[$follower["location"]] = 1;
                    }
                    echo '<br/>language : '.$follower["lang"].'<br/>';
                }
            }
        }
        //echo '<pre>'; var_dump(Twitter::getFollowersLocationJsonTable($locations)); echo '</pre>';
        
        echo $this->render('_followersByLocationChart', ['followers_location_json_table' => Twitter::getFollowersLocationJsonTable($locations)]);