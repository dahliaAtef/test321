<?php

if($follows_count != 0){
    echo '<br/><br/>Following :';
    foreach($follows["data"] as $following){
        echo '<br/>'.$following["username"];
    }
}