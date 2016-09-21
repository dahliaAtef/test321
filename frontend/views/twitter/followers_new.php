<?php

use digi\authclient\clients\Twitter;

$locations = array();
$locations['undefined']= 0;
echo '- Followers :<br/><br/>';
        foreach($followers['users'] as $follower){
            //echo '<pre>'; var_dump($follower); echo '</pre>'; 
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
        
        echo '<br/><br/><a href="#">Load more</a>';
        