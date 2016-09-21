<?php

echo '<br />- Latest Mentions :<br />';

foreach($mentions as $mention){
    //echo '<pre>'; var_dump($mention); echo '</pre>';
    echo '<br />'.$mention["user"]["name"].', screen name : '.$mention["user"]["screen_name"].', location : '.$mention["user"]["location"];
    echo '<br />created at '.$mention["created_at"].' using '.$mention["source"];
    //echo '<br/>id : '.$mention["id_str"];
    //echo '<br/>in reply to status _id : '.$mention["in_reply_to_status_id_str"];
    //echo '<br/>in reply to screen name : '.$mention["in_reply_to_screen_name"].'<br />';
    echo '<br/><hr/>';
}
