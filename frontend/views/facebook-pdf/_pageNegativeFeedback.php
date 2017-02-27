<?php



if($negative_feedback){

    echo '<h3 class="internal-title facebook ">Negative Feedback</h3>';

    echo '<div class="internal-content"><ul>';

        echo '<li><span class="small-title">Hide All Stories From This Page : </span>'.$negative_feedback["hide_all_clicks"].'</li>';

        echo '<li><span class="small-title">Hide This Post : </span>'.$negative_feedback["hide_clicks"].'</li>';

        echo '<li><span class="small-title">Unlike Page : </span>'.$negative_feedback["unlike_page_clicks"].'</li>';

        echo '<li><span class="small-title">Report Spam : </span>'.$negative_feedback["report_spam_clicks"].'</li>';  

    echo '</div></ul>';      

}