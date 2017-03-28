<h3 class="internal-title facebook" style="background-color:#4066ab">Fans Overview</h3>

<?php

$count = count($fans_in_range[0]['values']);

    while(($count != 0) && (!array_key_exists('value', $fans_in_range[0]['values'][$count - 1]))){

        $count--;

    }

    

    if($count != 0){ ?>
<div class="internal-content">
        <ul >

            <li><?= '<span class="small-title">New Fans : </span>'.$fans_in_range[0]['values'][$count - 1]['value']; ?></li>

            <li><?= '<span class="small-title">Change in Fans : </span>'.$change_in_fans; ?></li>

            <li><?= '<span class="small-title">Max Change in Fans : </span>'.$max_change_in_fans['value']; ?></li>

            <li><?= '<span class="small-title">Avg Fan Change per day : </span>'.$avg_fan_change_per_day; ?></li>

        </ul>
</div>

<?php    }

?>

