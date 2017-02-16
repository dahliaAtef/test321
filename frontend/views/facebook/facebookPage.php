<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use digi\authclient\clients\Facebook;

$client = $fb->getClient();
//var_dump($page['id']); die;
$statistics = $fb->statistics($page['id'], $page['likes'], $since, $until);
$top_fifteen_cities = $fb->getFansByCityFifteenCities($statistics['fans_by_city']);
$colors = ["#6600CC","#CC00CC","#CC0066","#CC0000","#CC6600","#CCCC00","#66CC00","#00CC00","#00CC66","#00CCCC","#0066CC","#FFCC66","#FFFF99","#003399","#000066"];
$this->title = 'Facebook';
$session = Yii::$app->session;

$this->registerJs("tripDatePicker.today = new Date('".date('M d Y', $authclient_created)."');", yii\web\View::POS_END);
?>
<div class="page-content inside facebook">
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
                    <h4>Choose your range</h4>
                </div>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= $form->field($oRangeForm, 'start_date')->textInput(['class' => 'form-control startDate', 'placeholder' => 'Start Date', 'onblur' => 'openEndDate()', 'readonly' => true])->label(false) ?>
                       
                        <!--<input type="text" class="form-control startDate" onblur="openEndDate()" placeholder="Start Date">-->
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                </div>
                <div class="range-item">
                    <div class="right-inner-addon">
                        <?= $form->field($oRangeForm, 'end_date')->textInput(['class' => 'form-control endDate', 'placeholder' => 'End Date', 'onfocus' => 'getValue()', 'disabled' => true, 'readonly' => true])->label(false) ?>
                        <!--<input type="text" class="form-control endDate" onfocus="getValue()" placeholder="End Date" disabled>-->
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                </div>
                <div class="range-item">
                        <?= Html::submitButton('Calculate', ['id' => 'bttn-range-form', 'name' => 'submit-range', 'autofocus' => 'true' ]) ?>
                </div>
                <?php $form = ActiveForm::end() ?>
                <?php
                    $this->registerJs(
                    "function openEndDate(){ "
                        //. "if(tripDatePicker.startBox.value !== ''){"
                            . "$('.endDate').prop('disabled', false); "
                        //."}"
                    . "}"
                    ."function getValue(){ "
                        ."untilDate = tripDatePicker.startDate.getTime()+(92*24*60*60*1000);"
                        . "tripDatePicker.untilDate = (untilDate > new Date().getTime()) ? new Date() : new Date(untilDate); "
                    . "}"
                    , yii\web\View::POS_END);
                ?>
                
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
                    <h2 class="internal-title sec-title"><?= $page['name'] ?>-Overview</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>
	<div class="row">
            <div class="col-md-6">
		<h3 class="internal-title facebook ">KPIs Overview</h3>
		<div class="internal-content">
                    <ul>
			<div class="row">
                            <li class="col-lg-5 col-md-6"><span class="small-title">Total page fans : </span><?= $page['likes'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">Change In Fans : </span><?= $statistics['change_in_fans'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">Page Posts : </span><?= $statistics['posts_by_day_statistics']['total_posts_count'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">Total Interactions : </span><?= $statistics['posts_by_day_statistics']['total_interactions_count'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">Likes : </span><?= $statistics['posts_by_day_statistics']['total_reactions_count'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">Comments : </span><?= $statistics['posts_by_day_statistics']['total_comments_count'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">Shares : </span><?= $statistics['posts_by_day_statistics']['total_shares_count'] ?></li>
                            <li class="col-lg-5 col-md-6"><span class="small-title">User Posts : </span><?= array_sum($statistics['user_posts_per_day']) ?></li>
			</div>
                    </ul>
		</div>
            </div>
            <div class="col-md-6">
		<?php 						
                    echo $this->render('_pageNegativeFeedback', ['negative_feedback' => $fb->getPageNegativeFeedback($page['id'])]);
		?>
            </div>
	</div>
	<div class="row">
            <div class="col-md-6">
		<?php
                    echo $this->render('_fansDetails', ['age_gender_array' => $statistics['age_gender_array'], 'fans_count' => $page['likes']]);
		?>
            </div>
        </div>

        <!-- sperated line -->
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Audience</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
		<?php
                    echo $this->render('_fansOverview', ['fans_in_range' => $statistics['fans_in_range'], 'change_in_fans' => $statistics['change_in_fans'], 'max_change_in_fans' => $statistics['max_change_in_fans'], 'avg_fan_change_per_day' => $statistics['avg_fan_change_per_day'], 'page_name' => $page['name']]);
		?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
		<?php
                    echo $this->render('_allFansChart', ['page_fans_month_json_table' => $fb->getAllFansJsonTable($statistics['fans_in_range'])]);
		?>
            </div>
	</div>
        <div class="row">
            <div class="col-md-12">
		<?php
                    echo $this->render('_fansGrowth', ['sum' => array_sum($statistics['fans_growth']), 'page_fans_growth_json_table' => $fb->getFanGrowthJsonTable($statistics['fans_growth'])]);
		?>
            </div>
	</div>
        <div class="row">
            <div class="col-md-12">
		<?php
                    echo $this->render('_fansByCountryChart', ['country_json_table' => $fb->getFansByCountryJsonTable($statistics['fans_by_country'])]);
		?>
            </div>
	</div>
      
	<div class="row">
            <div class="col-md-12">
		<?php
				if($statistics['fans_by_country_table']){
                    echo $this->render('_fansByCountryTable', ['fans_by_country_table' => $statistics['fans_by_country_table']]); 
                }
		?>
            </div>
	</div>
	<div class="row">
            <div class="col-md-6">
		<?php
                    echo $this->render('_fansByCityChart', ['fans_city_json_table' => $fb->getFansByCityJsonTable($top_fifteen_cities)]);
		?>
            </div>
            <div class="col-md-6">
		<?php
                    echo $this->render('_fansByLanguageChart', ['fans_language_json_table' => $fb->getFansByLanguageJsonTable($statistics['fans_lang'])]);
		?>		
            </div>
	</div>
		<!--<div class="row">
			<div class="col-md-6">
				
					echo $this->render('_fansByCityColorsTable', ['top_fifteen_cities' => $top_fifteen_cities, 'colors' => $colors]);
				
			</div>
		</div>-->
		<div class="row">
			<div class="col-md-12">
				<?php
                    echo $this->render('_fansByAgeGenderChart', ['fans_gender_age_json_table' => $fb->getFansByAgeGenderJsonTable($statistics['age_gender_array'])]);
                ?>    
			</div>
		</div>

		<!-- sperated line -->
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Engagement</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-6">
				<?php
                    echo $this->render('_contentOverview', ['total_posts' => $statistics['posts_by_day_statistics']['total_posts_count'], 'total_interactions' => $statistics['posts_by_day_statistics']['total_interactions_count'], 'page_name' => $page['name']]);
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php
                    echo $this->render('_pagePostsByDayChart', ['total_posts' => $statistics['posts_by_day_statistics']['total_posts_count'], 'page_posts_by_day_json_table' => $fb->getPagePostsJsonTable($statistics['posts_by_day_statistics']['posts_by_day'])]);
				?>
			</div>
		</div>
        <div class="row">
			<div class="col-lg-6 col-md-12">
				<?php
                    echo $this->render('_postTypes', ['post_types' => $statistics['posts_by_day_statistics']['post_types'], 'fb' => $fb, 'total_posts' => $statistics['posts_by_day_statistics']['total_posts_count']]);
				?>					
            </div>
			<div class="col-lg-6 col-md-12">
				<?php
                    echo $this->render('_mostEngagingPostTypes', ['post_types' => $statistics['posts_by_day_statistics']['post_types'], 'fb' => $fb, 'total_interactions' => $statistics['posts_by_day_statistics']['total_interactions_count']]);
				?>
            </div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php
                    echo $this->render('_pageEngagementByDayChart', ['total_posts' => $statistics['posts_by_day_statistics']['total_posts_count'], 'page_engagement_by_day_json_table' => $fb->getPageEngagementJsonTable($statistics['posts_by_day_statistics']['posts_by_day'])]);
				?>
			</div>
		</div>
			<?php
				echo $this->render('_pageInteractionByDayChart', [
							'page_interaction_by_day_json_table' => $fb->getPageInteractionJsonTable($statistics['posts_by_day_statistics']['posts_by_day']),

							'total_interactions' => $statistics['posts_by_day_statistics']['total_interactions_count'],

							'total_reactions' => $statistics['posts_by_day_statistics']['total_reactions_count'],

							'total_comments' => $statistics['posts_by_day_statistics']['total_comments_count'],

							'total_shares' => $statistics['posts_by_day_statistics']['total_shares_count'],

							'max_interaction' => $statistics['posts_by_day_statistics']['max_interaction'],

							'max_interaction_day' =>$statistics['posts_by_day_statistics']['max_interaction_day'],

							'min_interaction' => $statistics['posts_by_day_statistics']['min_interaction'],

							'min_interaction_day' =>$statistics['posts_by_day_statistics']['min_interaction_day'],

							'page_name' => $page['name']

								]);

				echo $this->render('_pageUserPosts', ['page_user_posts_by_day_json_table' => $statistics['user_posts_per_day_json_table'], 'user_posts' => $statistics['user_posts_per_day'], 'page_name' => $page['name']]);

				echo $this->render('_pageViewsChart', ['page_views_json_table' => $fb->getPageViewsJsonTable($page['id'], $since, $until)]);
			?>
			<!-- sperated line -->
	        <div class="row">
	            <div class="col-md-12">
	                <div class="title-box">
	                    <h2 class="internal-title sec-title">Optimization</h2>
	                    <div class="line-box"></div>
	                </div>
	            </div>
	        </div>

			<?php
				echo $this->render('_peakTimeChart', ['peak_time_json_table' => $fb->getPeakTimeJsonTable($page['id'])]);

				echo $this->render('_comparison', ['comparison' => $fb->getComparisonInsights($page['id'], $since, $until, $authclient_created), 'page_name' => $page['name']]);

				echo $this->render('_topPosts', ['top_posts' => $statistics['posts_in_range'], 'page_name' => $page['name']]);

			?>
		</div>
        <?php Pjax::end(); ?>
	</div>
	<!-- inner page -->
</div>
<!-- page content -->
