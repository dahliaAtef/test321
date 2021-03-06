<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use digi\authclient\clients\Facebook;

$client = $fb->getClient();
$statistics = $fb->statistics($page['id'], $page['likes'], $since, $until);
$top_fifteen_cities = $fb->getFansByCityFifteenCities($statistics['fans_by_city']);
$colors = ["#6600CC","#CC00CC","#CC0066","#CC0000","#CC6600","#CCCC00","#66CC00","#00CC00","#00CC66","#00CCCC","#0066CC","#FFCC66","#FFFF99","#003399","#000066"];
$this->title = 'Facebook';
$session = Yii::$app->session;

// $this->registerJs("window.print(); window.close();", yii\web\View::POS_END);
?>
<div class="page-content inside facebook">

    <div class="container">
	
	<div class="client-title" style="text-align:center">
        <div class="row">
            <div class="col-md-12">
			 <h1 style="display:block; color: #4C4C4C; font-size: 20px; margin: 0; padding: 0;">Sumsung Egypt report since 15 feb to 12 Jun</h1>
			 <hr>
			</div>
		</div>
	</div>

	<div class="inner-page">
        <div class="row">
            <div class="col-md-12">
                <div class="title-box" style="display:block; color: #4C4C4C; font-size: 13px; margin: 0; padding: 0;">
                    <h2 class="internal-title sec-title" style="color: #4066ab; font-size: 24px; font-weight: bolder; float: left; display: block; margin-right: 14px; margin-top: 20px; margin-bottom: 10px;"><?= $page['name'] ?>-Overview</h2>
                    <div class="line-box" style="font-size: 13px;"></div>
                </div>
            </div>
        </div>
	<div class="row">
            <div class="col-md-6">
		<h3 class="internal-title facebook" style="background-color:#4066ab">KPIs Overview</h3>
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
                <div class="title-box" style="display:block; color: #4C4C4C; font-size: 13px; margin: 0; padding: 0;">
                    <h2 class="internal-title sec-title" style="color: #4066ab; font-size: 24px; font-weight: bolder; float: left; display: block; margin-right: 14px; margin-top: 20px; margin-bottom: 10px;">Audience</h2>
                    <div class="line-box" style="font-size: 13px;"></div>
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
                    echo $this->render('_allFansChart', ['fan_likes_img' => $images['fan_likes'],'page_fans_month_json_table' => $fb->getAllFansJsonTable($statistics['fans_in_range'])]);
		?>
            </div>
	</div>
        <div class="row">
            <div class="col-md-12">
		<?php
                    echo $this->render('_fansGrowth', ['fans_growth_img' => $images['fans_growth'], 'sum' => array_sum($statistics['fans_growth']), 'page_fans_growth_json_table' => $fb->getFanGrowthJsonTable($statistics['fans_growth'])]);
		?>
            </div>
	</div>
        <div class="row">
            <div class="col-md-12">
		<?php
                    echo $this->render('_fansByCountryChart', ['fans_country_img' => $images['fans_country'], 'country_json_table' => $fb->getFansByCountryJsonTable($statistics['fans_by_country'])]);
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
                    echo $this->render('_fansByCityChart', ['fans_city_img' => $images['fans_city'], 'fans_city_json_table' => $fb->getFansByCityJsonTable($top_fifteen_cities)]);
		?>
            </div>
            <div class="col-md-6">
		<?php
                    echo $this->render('_fansByLanguageChart', ['fans_language_img' => $images['fans_language'], 'fans_language_json_table' => $fb->getFansByLanguageJsonTable($statistics['fans_lang'])]);
		?>		
            </div>
	</div>

		<div class="row">
			<div class="col-md-12">
				<?php
                    echo $this->render('_fansByAgeGenderChart', ['fans_age_gender_img' => $images['fans_age_gender'], 'fans_gender_age_json_table' => $fb->getFansByAgeGenderJsonTable($statistics['age_gender_array'])]);
                ?>    
			</div>
		</div>

		<!-- sperated line -->
        <div class="row">
            <div class="col-md-12">
                <div class="title-box" style="display:block; color: #4C4C4C; font-size: 13px; margin: 0; padding: 0;">
                    <h2 class="internal-title sec-title" style="color: #4066ab; font-size: 24px; font-weight: bolder; float: left; display: block; margin-right: 14px; margin-top: 20px; margin-bottom: 10px;">Engagement</h2>
                    <div class="line-box" style="font-size: 13px;"></div>
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
                    echo $this->render('_pagePostsByDayChart', ['page_posts_by_day_img' => $images['page_posts_by_day'], 'total_posts' => $statistics['posts_by_day_statistics']['total_posts_count'], 'page_posts_by_day_json_table' => $fb->getPagePostsJsonTable($statistics['posts_by_day_statistics']['posts_by_day'])]);
				?>
			</div>
		</div>
        <div class="row">
			<div class="col-lg-6 col-md-12">
				<?php
                    echo $this->render('_postTypes', ['post_types_img' => $images['post_types'], 'post_types' => $statistics['posts_by_day_statistics']['post_types'], 'fb' => $fb, 'total_posts' => $statistics['posts_by_day_statistics']['total_posts_count']]);
				?>					
            </div>
			<div class="col-lg-6 col-md-12">
				<?php
                    echo $this->render('_mostEngagingPostTypes', ['most_engaging_post_types_img' => $images['most_engaging_post_types'], 'post_types' => $statistics['posts_by_day_statistics']['post_types'], 'fb' => $fb, 'total_interactions' => $statistics['posts_by_day_statistics']['total_interactions_count']]);
				?>
            </div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php
                    echo $this->render('_pageEngagementByDayChart', ['page_engagement_by_day_img' => $images['page_engagement_by_day'], 'total_posts' => $statistics['posts_by_day_statistics']['total_posts_count'], 'page_engagement_by_day_json_table' => $fb->getPageEngagementJsonTable($statistics['posts_by_day_statistics']['posts_by_day'])]);
				?>
			</div>
		</div>
			<?php
				echo $this->render('_pageInteractionByDayChart', [
                                                        'daily_interaction_img' => $images['daily_interaction'], 
                                    
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

				echo $this->render('_pageUserPosts', ['user_posts_img' => $images['user_posts'], 'page_user_posts_by_day_json_table' => $statistics['user_posts_per_day_json_table'], 'user_posts' => $statistics['user_posts_per_day'], 'page_name' => $page['name']]);

				echo $this->render('_pageViewsChart', ['page_views_img' => $images['page_views'], 'page_views_json_table' => $fb->getPageViewsJsonTable($page['id'], $since, $until)]);
			?>
			<!-- sperated line -->
	        <div class="row">
	            <div class="col-md-12">
	                <div class="title-box" style="display:block; color: #4C4C4C; font-size: 13px; margin: 0; padding: 0;">
	                    <h2 class="internal-title sec-title" style="color: #4066ab; font-size: 24px; font-weight: bolder; float: left; display: block; margin-right: 14px; margin-top: 20px; margin-bottom: 10px;">Optimization</h2>
	                    <div class="line-box" style="font-size: 13px;"></div>
	                </div>
	            </div>
	        </div>

			<?php
				echo $this->render('_peakTimeChart', ['peak_time_img' => $images['peak_time'], 'peak_time_json_table' => $fb->getPeakTimeJsonTable($page['id'])]);

				echo $this->render('_comparison', ['comparison' => $fb->getComparisonInsights($page['id'], $since, $until, $authclient_created), 'page_name' => $page['name']]);

				echo $this->render('_topPosts', ['top_posts' => $statistics['posts_in_range'], 'page_name' => $page['name']]);

			?>
		</div>
	</div>
	<!-- inner page -->
</div>
<!-- page content -->
