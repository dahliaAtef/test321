<?php



use yii\helpers\Url;

use digi\authclient\clients\Youtube;



$this->title = 'Youtube';



$device_types = $youtube->getAnalyticsPerDevice($start_date, $end_date);

$os = $youtube->getAnalyticsPerOs($start_date, $end_date);

$traffic_sources = $youtube->getAnalyticsPerTrafficSource($start_date, $end_date);

$sharing_services = $youtube->getAnalyticsPerSharingService($start_date, $end_date);

$locations = $youtube->getAnalyticsPerLocation($start_date, $end_date);

?>

<div class="page-content inside youtube">
  <div id="loadWh">
    <div id="loadx">
      <img src="http://adigitree.org/shared/themes/frontend/images/logoLoader.png" alt="">
    </div>
  </div><!-- loader -->
    <div class="container">

	<div class="inner-page">

            <?php

            echo $this->render('_channelData', ['channels' => $channels, 'channel_analytics' => $channel_analytics, 'subscribers' => $subscribers, 'youtube' => $youtube]);

            //
           
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title">KPIs Overview</h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>

            <?php

            
            echo '<div class="row">';
            echo $this->render('_subscribersDeviceChart', ['device_types_json_table' => $youtube->getAnalyticsPerDeviceJsonTable($device_types), 'device_types' => $device_types]);
            echo '</div>';
            //

            echo '<div class="row">';
            echo $this->render('_subscribersOsChart', ['os_json_table' => $youtube->getAnalyticsPerOperatingSystemJsonTable($os), 'os' => $os]);
            echo '</div>';
            //

            echo '<div class="row">';
            echo $this->render('_subscribersTrafficSourcesChart', ['traffic_sources' => $traffic_sources, 'traffic_sources_json_table' => $youtube->getAnalyticsPerTrafficSourcesJsonTable($traffic_sources)]);
            echo '</div>';
            //

            echo '<div class="row">';
            echo $this->render('_subscribersSharingServicesChart', ['sharing_services' => $sharing_services, 'sharing_services_json_table' => $youtube->getAnalyticsPerSharingServiceJsonTable($sharing_services)]);
            echo '</div>';
            //

            echo $this->render('_subscribersLocationsCharts', ['locations' => $locations, 'youtube' => $youtube]);

            

            echo '<div class="row">';
            echo $this->render('_subscribersGenderAgesChart', ['gender_ages_json_table' => $youtube->getAnalyticsPerGenderAgesJsonTable()]);
            echo '</div>';
            //

            
            ?>
			<!-- sperated line -->  
            <?php
                echo $this->render('_comparison', ['comparison' => $youtube->getComparison($model->id, $start_date, $end_date, $authclient_created)]);
            ?>

            <!-- sperated line -->  
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title">Top Ten Viewed Videos</h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>

            <?php
            $top_ten_viewed_videos = $youtube->getTopTenMostedVideosForChannel();
            echo $this->render('_topTenViewedVideos', ['top_ten_viewed_videos' => $top_ten_viewed_videos, 'youtube' => $youtube, 'top_ten_analytics_json' => $youtube->getTopTenVideosAnalyticsJson($top_ten_viewed_videos)]);

            ?>

	</div>

	<!-- inner page -->

    </div>

</div>

<!-- page content -->