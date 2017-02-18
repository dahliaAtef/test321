<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

use digi\authclient\clients\Youtube;

$this->title = 'Youtube';

$this->registerJs("tripDatePicker.today = new Date('".date('M d Y', $authclient_created)."');", yii\web\View::POS_END)

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
  
    
  <div class="page-options">   
    <div class="row">
        <div class="col-md-6">          
            <div class="row">
                <div class="range-item">
                    <h4>Choose your range</h4>
                </div>
                    
                <?php $form = ActiveForm::begin(['id' => 'range-form','options' => ['data-pjax' => true ]]); ?>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= $form->field($oRangeForm, 'start_date')->textInput(['class' => 'form-control startDate', 'placeholder' => 'Start Date', 'readonly' => true])->label(false) ?>
                        <!--<input type="text" class="form-control startDate" onblur="openEndDate()" placeholder="Start Date">-->
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                </div>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= $form->field($oRangeForm, 'end_date')->textInput(['class' => 'form-control endDate', 'placeholder' => 'End Date', 'readonly' => true])->label(false) ?>
                        <!--<input type="text" class="form-control endDate" onfocus="getValue()" placeholder="End Date" disabled>-->
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                </div>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= Html::submitButton('Calculate', ['id' => 'bttn-range-form', 'name' => 'submit-range']) ?>
                    </div>
                </div>
                <?php $form = ActiveForm::end() ?>
            </div>
        </div>
      </div>
  </div>
   <!-- page-option -->

    <div class="container">

	<div class="inner-page">
        <?php Pjax::begin(['id' => 'pjaxRange', 'enablePushState' => false]); ?>

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

        <?php Pjax::end(); ?>
	<!-- inner page -->
    </div>

</div>

<!-- page content -->