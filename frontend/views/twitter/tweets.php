<?php
//echo '<pre>'; var_dump($tweets); echo '</pre>'; die;
echo 'Tweets :<br /><br/>';

foreach($tweets as $tweet){
    echo 'Tweet : '.$tweet["text"];
    echo '<br />Retweets : '.$tweet["retweet_count"];
    echo '<br />Favorites :'.$tweet["favorite_count"];
    echo '<br />Created at '.date('M d, Y',strtotime($tweet["created_at"]));
    echo '<br/><hr/>';
}

echo '<a href="#">Load more</a><br/><br/>';