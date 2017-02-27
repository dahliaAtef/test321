<?php

if($activities){
    echo '<br/><br/>Activities :<ul>';
    echo '<br/><br/><li>Daily Activities :<ul>';
        echo '<br/><li>Fans : '.$activities["daily_activities"]["fan"].'</li>';
        echo '<br/><li>Page posts : '.$activities["daily_activities"]["page post"].'</li>';
        echo '<br/><li>User posts : '.$activities["daily_activities"]["user post"].'</li>';
        echo '<br/><li>Likes : '.$activities["daily_activities"]["like"].'</li>';
        echo '<br/><li>Comments : '.$activities["daily_activities"]["comment"].'</li>';
        echo '<br/><li>Mentions : '.$activities["daily_activities"]["mention"].'</li>';
        echo '<br/><li>Share stories : '.$activities["daily_activities"]["link"].'</li>';
        echo '<br/><li>Event interaction : '.$activities["daily_activities"]["event"].'</li></ul></li>';
    echo '<br/><br/><li>Weekly Activities :<ul>';
        echo '<br/><li>Fans : '.$activities["weekly_activities"]["fan"].'</li>';
        echo '<br/><li>Page posts : '.$activities["weekly_activities"]["page post"].'</li>';
        echo '<br/><li>User posts : '.$activities["weekly_activities"]["user post"].'</li>';
        echo '<br/><li>Likes : '.$activities["weekly_activities"]["like"].'</li>';
        echo '<br/><li>Comments : '.$activities["weekly_activities"]["comment"].'</li>';
        echo '<br/><li>Mentions : '.$activities["weekly_activities"]["mention"].'</li>';
        echo '<br/><li>Share stories : '.$activities["weekly_activities"]["link"].'</li>';
        echo '<br/><li>Event interaction : '.$activities["weekly_activities"]["event"].'</li></ul></li>';
    echo '<br/><br/><li>Monthly Activities :<ul>';
        echo '<br/><li>Fans : '.$activities["monthly_activities"]["fan"].'</li>';
        echo '<br/><li>Page posts : '.$activities["monthly_activities"]["page post"].'</li>';
        echo '<br/><li>User posts : '.$activities["monthly_activities"]["user post"].'</li>';
        echo '<br/><li>Likes : '.$activities["monthly_activities"]["like"].'</li>';
        echo '<br/><li>Comments : '.$activities["monthly_activities"]["comment"].'</li>';
        echo '<br/><li>Mentions : '.$activities["monthly_activities"]["mention"].'</li>';
        echo '<br/><li>Share stories : '.$activities["monthly_activities"]["link"].'</li>';
        echo '<br/><li>Event interaction : '.$activities["monthly_activities"]["event"].'</li></ul></li></ul>';        
}