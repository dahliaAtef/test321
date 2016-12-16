<?php
    echo '<div class="row"><div class="col-md-6">';
    echo $this->render('_subscribersPerLocationsViewsChart', ['locations_views_json_table' => $youtube->getAnalyticsPerLocationsViewsJsonTable($locations)]);
    echo '</div><div class="col-md-6">';
    echo $this->render('_subscribersPerLocationsMinutesWatchedChart', ['locations_minutes_watched_json_table' => $youtube->getAnalyticsPerLocationsMinutesWatchedJsonTable($locations)]);
    echo '</div></div>';
	echo '<div class="row"><div class="col-md-12">';
    echo $this->render('_subscribersPerLocationsViewDurationPercentageChart', ['locations_view_duration_percentage_json_table' => $youtube->getAnalyticsPerLocationsViewDurationPercentageJsonTable($locations)]);
    echo '</div></div>';
	
?>


<div class="row">
    <div class="col-md-12">
<?php

if($locations && array_key_exists('rows', $locations)){

?>

<table class="youtube">

    <tr>

        <th>Country</th>

        <th>Views</th>

        <th>EST. Minutes Watched</th>

        <th>AVG View Duration</th>

        <th>AVG View Percentage</th>

        <th>Subscriber Gained</th>

    </tr>

    <?php
	$top_fifteen_locations = array_slice($locations['rows'], 0, 15);
    foreach($top_fifteen_locations as $location){

    ?>

    <tr>

        <td><?= $location[0] ?></td>

        <td><?= $location[1] ?></td>

        <td><?= $location[2] ?> min</td>

        <td><?= $location[3] ?></td>

        <td><?= round($location[4], 2) ?>%</td>

        <td><?= $location[5] ?></td>

    </tr>

    <?php } ?>

</table>

<?php } ?>
</div></div>