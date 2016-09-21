<?php

echo 'User screen name : '.$data["screen_name"];
    echo '<br />- Number of Followers : '.$data["followers_count"];
    echo '<br />- Number of Followings : '.$data["friends_count"];
    echo '<br />- Listed : '.$data["listed_count"];
    echo '<br />- Number of Favourites : '.$data["favourites_count"];
    echo '<br />- Number of Statuses : '.$data["statuses_count"];
    echo '<br/>- Number of Retweets this month : '.$monthly_retweets;
    echo '<br/>- Number of Replies this month : '.$monthly_mentions;
    echo '<br/>- Average Tweet Engagement Rate : '.$average_tweet_engagement_rate.'%';