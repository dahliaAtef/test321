<?php

echo '<br/><hr/><br />- Tweets :<br /><br/>';

foreach($tweets as $tweet){
    echo 'Tweet : '.$tweet["text"];
    echo '<br />Retweets : '.$tweet["retweet_count"];
    echo '<br/>Replies : ';
    if(array_key_exists($tweet['id_str'], $replies)){
        echo $replies[$tweet['id_str']];
    }else{echo '0';}
    echo '<br />Favorites :'.$tweet["favorite_count"];
    echo '<br />Created at '.date(strtotime($tweet["created_at"]));
    echo '<br/><hr/>';
}