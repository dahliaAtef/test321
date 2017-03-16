<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'LinkedIn';
$updates = count($statistics['updates']);
$days_count = count($statistics['days']);

$this->registerJs("tripDatePicker.today = new Date('".date('M d Y', $authclient_created)."'); 
    tripDatePicker.range_limit = 365;
    $('.startDate').prop('autofocus', false);", yii\web\View::POS_END)
?>
<div class="page-content inside linkeidn">
   <div id="loadWh">
    <div id="loadx">
      <img src="http://adigitree.org/shared/themes/frontend/images/logoLoader.png" alt="">
    </div>
  </div><!-- loader -->

    
  <div class="page-options">   
    <div class="row">
        <div class="col-md-12">          
            <div class="row">
               
                <?php $form = ActiveForm::begin(['id' => 'range-form','options' => ['data-pjax' => true ]]); ?>
                 
                <div class="range-item">
                    <h4>Choose Date</h4>
                </div>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= $form->field($oRangeForm, 'start_date')->textInput(['class' => 'form-control startDate', 'placeholder' => 'Start Date', 'readonly' => true])->label(false) ?>
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                </div>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= $form->field($oRangeForm, 'end_date')->textInput(['class' => 'form-control endDate', 'placeholder' => 'End Date', 'disabled' => true, 'readonly' => true])->label(false) ?>
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                </div>
                <div class="range-item">
                        <?= Html::submitButton('Apply', ['id' => 'bttn-range-form', 'name' => 'submit-range', 'autofocus' => 'true' ]) ?>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title"><?= $oModel->name ?>-Overview</h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">KPIs Overview</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li class="col-lg-5 col-md-6"><span class="small-title">Updates : </span><?= $updates ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Avg. Daily updates : </span><?= $statistics['avg_daily_updates'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Interactions : </span><?= $statistics['interactions'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Avg. Daily Interactions : </span><?= $statistics['avg_daily_interactions'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Impressions : </span><?= $statistics['impressions'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Avg. Daily Reach : </span><?= $statistics['avg_daily_reach'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Clicks : </span><?= $statistics['clicks'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Followers : </span><?= $statistics['new_followers'] ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">Interactions On Updates</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li class="col-lg-5 col-md-6"><span class="small-title">Interactions Total : </span><?= $statistics['interactions'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">New Updates Total : </span><?= count($statistics['updates']) ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Interactions on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['interactions'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Interactions per New Update : </span><?= ((count($statistics['updates']) != 0) ? round((($statistics['sums_of_all_updates_statistics']['interactions'])/$updates), 1) : 0) ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_updatesByDayChart', ['updates_count' => count($statistics['updates']),'updates_by_day_json_table' => $linkedin->getUpdatesByDayJsonTable($statistics['updates_statistics_by_day'])]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_interactionsByDayChart', ['interactions_count' => $statistics['interactions'],'interactions_by_day_json_table' => $linkedin->getInteractionsByDayJsonTable($statistics['days'], $statistics['updates_statistics_by_day'], $statistics['company_views_statistics_by_day'])]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">Interactions Distribution</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li class="col-lg-5 col-md-6"><span class="small-title">Total Likes : </span><?= $statistics['likes'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Likes on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['likes'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Likes per New Updates : </span><?= round((($statistics['sums_of_all_updates_statistics']['likes'])/$days_count), 1) ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Total Comments : </span><?= $statistics['comments'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Comments on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['comments'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Comments per New Updates : </span><?= round((($statistics['sums_of_all_updates_statistics']['comments'])/$days_count), 1) ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Total Shares : </span><?= $statistics['shares'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Shares on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['shares'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">Shares per New Updates : </span><?= round((($statistics['sums_of_all_updates_statistics']['shares'])/$days_count), 1) ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_interactionsDistributionByDayChart', ['interactions_count' => $statistics['interactions'],'interactions_distribution_by_day_json_table' => $linkedin->getInteractionsDistributionByDayJsonTable($statistics['company_views_statistics_by_day'])]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">Clicks OverTime</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li class="col-md-12"><span class="small-title">Total Clicks : </span><?= $statistics['clicks'] ?></li>
                                <li class="col-md-12"><span class="small-title">Clicks on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['clicks'] ?></li>
                                <li class="col-md-12"><span class="small-title">Clicks per New Updates : </span><?= round((($statistics['sums_of_all_updates_statistics']['clicks'])/$days_count), 1) ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_clicksByDayChart', ['clicks_count' => $statistics['clicks'], 'clicks_by_day_json_table' => $linkedin->getClicksByDayJsonTable($statistics['company_views_statistics_by_day'])]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">Impressions OverTime</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li class="col-md-12"><span class="small-title">Total Impressions : </span><?= $statistics['impressions'] ?></li>
                                <li class="col-md-12"><span class="small-title">Impressions on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['impressions'] ?></li>
                                <li class="col-md-12"><span class="small-title">Impressions per New Updates : </span><?= round((($statistics['sums_of_all_updates_statistics']['impressions'])/$days_count), 1) ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_impressionsByDayChart', ['impressions_count' => $statistics['impressions'], 'impressions_by_day_json_table' => $linkedin->getImpressionsByDayJsonTable($statistics['company_views_statistics_by_day'])]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">Followers OverTime</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li class="col-lg-5 col-md-6"><span class="small-title">Total Followers : </span><?= $statistics['total_followers'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Gained Followers : </span><?= $statistics['new_followers'] ?></li>
                              	<li class="col-lg-5 col-md-6"><span class="small-title">Paid Followers : </span><?= $statistics['paid_followers'] ?></li>
                                <li class="col-lg-5 col-md-6"><span class="small-title">Organic Followers : </span><?= $statistics['organic_followers'] ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">New Organic Followers : </span><?= ($statistics['organic_followers'] - $statistics['followers']['values'][0]['organicFollowerCount']) ?></li>
                                <li class="col-lg-5 col-md-12"><span class="small-title">New Paid Followers : </span><?= ($statistics['paid_followers'] - $statistics['followers']['values'][0]['paidFollowerCount']) ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_followersByDayChart', ['total_followers_count' => $statistics['total_followers'], 'followers_by_day_json_table' => $linkedin->getFollowersByDayJsonTable($statistics['followers_array'])]); ?>
                </div>
            </div>
            <?= $this->render('_followersDemographics', ['followers_statistics' => $statistics['company_statistics']['followStatistics'], 'linkedin' => $linkedin]); ?>
            
            <div class="row">
		<div class="col-md-12">
                    <?= $this->render('_bestTimeToPostChart', ['updates' => $statistics['updates'], 'best_time_to_post_json_table' => $linkedin->getBestTimeToPostJsonTable($statistics['updates'])]); ?>
		</div>
            </div>
        <!-- sperated line -->  
		<?php
            echo $this->render('_comparison', ['comparison' => $linkedin->getComparison($oModel->entity_id, $since, $until, $authclient_created)]);
        ?>
      
        <!-- sperated line -->      
            <?= $this->render('_topPosts', ['top_updates' => $statistics['updates'], 'updates_statistics' => $statistics['updates_statistics']]); ?>
            
            
            
	</div>
        
    <?php Pjax::end(); ?>    
    </div>
    <!-- inner page -->
    
</div>
<!-- page content -->
