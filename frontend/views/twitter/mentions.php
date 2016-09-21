<?php

echo 'Mentions :<br />';

foreach($mentions as $mention){
    echo '<br />'.$mention["user"]["name"].', screen name : '.$mention["user"]["screen_name"].', location : '.$mention["user"]["location"];
    echo '<br />created at '.date('M d, Y',strtotime($mention["created_at"])).' using '.$mention["source"];
    echo '<br/><hr/>';
}

echo '<br/><a href="#">Load more</a><br/>';