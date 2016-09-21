<?php

use digi\authclient\clients\Instagram;


echo '<img src="'.$user["profile_picture"].'" alt="'.$user["username"].'" /><br/>';
echo $user["username"];
echo '<br/>Full name : '.$user["full_name"];
echo '<br/>Followers : '.$user["counts"]["followed_by"];
echo '<br/>Follows : '.$user["counts"]["follows"];
echo '<br/>Number of posted media : '.$user["counts"]["media"];
