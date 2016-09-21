<?php

    echo '<br/>Likes : '.$likes_count;
    if(($likes_count) != 0){
        foreach($likes["data"] as $like){
            echo '<br/>'.$like["username"].', id : '.$like["id"];
        }
    }