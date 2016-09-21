<?php

    echo '<br/>Comments : '.$comments_count;
    if(($comments_count) != 0){
        foreach($comments["data"] as $comment){
            echo '<br/>'.$comment["from"]["username"].', id : '.$comment["from"]["id"].', created at : '.date('Y-m-d', $comment["created_time"]);
        }
    }