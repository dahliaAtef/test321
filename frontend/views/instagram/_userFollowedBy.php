<?php

if($followed_by_count != 0){
    echo '<br/><br/>Followers :';
    foreach($followed_by["data"] as $follower){
        echo '<br/>'.$follower["username"];
    }
}
