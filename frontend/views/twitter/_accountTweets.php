<?php
use yii\helpers\Url;

echo '<br/><hr/><br />- Tweets :<br /><br/>';

echo '<a href="'.Url::to(['site/twitter-tweets']).'">Check all tweets</a><br/><br/>';

foreach($tweets as $tweet){
    echo 'Tweet : '.$tweet["text"];
    echo '<br />Retweets : '.$tweet["retweet_count"];
    echo '<br />Favorites :'.$tweet["favorite_count"];
    echo '<br />Created at '.date('M d, Y',strtotime($tweet["created_at"]));
    echo '<br/><hr/>';
}