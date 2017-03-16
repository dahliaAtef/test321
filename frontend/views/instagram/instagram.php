<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Instagram';

$this->registerJs("tripDatePicker.today = new Date('".date('M d Y', $authclient_created)."'); 
    tripDatePicker.range_limit = 365;
    $('.startDate').prop('autofocus', false);", yii\web\View::POS_END);
?>

<div class="page-content inside instagram">
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
                    <h2 class="internal-title sec-title"><?= ucwords($user['username']) ?>-Audience</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <?php



        //if($insta->account_insights_in_range){



            $followers_change = ($insta->account_insights_in_range) ? (($insta->account_insights_in_range[count($insta->account_insights_in_range)-1]->followers) - ($insta->account_insights_in_range[0]->followers)) : 0;



            ?>
        <div class="row">
            <div class="col-md-12">
				<h3 class="internal-title instagram">Fans Overview</h3>
				<div class="internal-content">
            

					<ul>
						<li><span class="small-title">Followers Number : </span><?= $insta->account_insights_in_range[count($insta->account_insights_in_range)-1]->followers ?></li>
						<li><span class="small-title">Followers Change : </span><?= $followers_change ?></li>
						<li><span class="small-title">Avg. Followers Change per Day : </span><?= round((($followers_change)/(count($followers_growth))), 2) ?></li>
					</ul>
				</div>
			</div>
		</div>


        <div class="row">
			<div class="col-md-12">
				<?php
				echo $this->render('_followersGrowthChart', ['followers_growth' => $followers_growth,'followers_growth_json_table' => $insta->getFollowersGrowthJsonTable($followers_growth)]);
				?>
            </div>
        </div>

		<?php
        //if($statistics){
        ?>  
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Engagement</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="col-md-12">
				<h3 class="internal-title instagram">Interactions Overview</h3>
				<div class="internal-content">
					<ul>
						<li><span class="small-title">Total Posts : </span><?= $statistics['total_posts'] ?></li>
						<li><span class="small-title">Total Likes : </span><?= ($statistics['total_photo_likes'] + $statistics['total_video_likes']) ?></li>
						<li><span class="small-title">Total Comments : </span><?= ($statistics['total_photo_comments'] + $statistics['total_video_comments']) ?></li>
						<li><span class="small-title">Avg. Likes Per Post : </span><?= round($statistics['avg_likes_per_post'], 1) ?></li>
						<li><span class="small-title">Avg. Comments Per Post : </span><?= round($statistics['avg_comments_per_post'], 1) ?></li>
					</ul>
				</div>
			</div>
		</div>


        <div class="row">
			<div class="col-md-12">
			<?php
                echo $this->render('_numberOfPostsChart', ['number_of_posts_json_table' => $insta->getNumberOfPostsJsonTable($statistics['image'], $statistics['video'])]);
            ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<?php
                echo $this->render('_numberOfInteractionsChart', ['number_of_interactions_json_table' => $insta->getNumberOfInteractionsJsonTable($statistics['image'], $statistics['video'])]);
			?>
            </div>
		</div>
            
        <div class="row">
            <div class="col-md-6">
                <h3 class="internal-title instagram">Engagement Overview</h3>
				<div class="internal-content">
					<ul>
						<li><span class="small-title">Avg. Post Engagement Rate : </span><?= round($statistics['avg_post_engagement_rate'], 2) ?>%</li>
						<li><span class="small-title">Max. Post Engagement Rate : </span><?= round($statistics['max_post_engagement_rate'], 2) ?>%</li>
						<li><span class="small-title">Avg. Profile Engagement Rate : </span><?= round($statistics['avg_profile_engagement_rate'], 2) ?>%</li>
						<li><span class="small-title">Max. Profile Engagement Rate : </span><?= round($statistics['max_profile_engagement_rate'], 2) ?>%</li>
					</ul>
				</div>
				</div>
		</div>

        <div class="row">
			<div class="col-md-12">
			<?php
                echo $this->render('_postEngagementChart', ['post_engagement_per_day_json_table' => $insta->getPostEngagementJsonTable($statistics['profile'])]);
            ?>
			</div>
		</div>
        <div class="row">
			<div class="col-md-12">
			<?php
                echo $this->render('_profileEngagementChart', ['profile_engagement_per_day_json_table' => $insta->getProfileEngagementJsonTable($statistics['profile'])]);
            ?>
			</div>
		</div>

        <!-- sperated line -->  
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Optimization</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <div class="row">
			<div class="col-md-6">
			<?php
				echo $this->render('_postTypesChart', ['post_types_json_table' => $insta->getPostTypesJsonTable($statistics['total_posts_by_type'])]);
            ?>
				<ul class="graph-summery">
					<?php
					foreach($statistics['total_posts_by_type'] as $key => $value){ ?>
                  <li><b><?= $key ?>:</b> <?= $value ?> posts  (<?= round(((($value)/$statistics['total_posts'])*100), 1) ?>%) </li>
					<?php } ?>
				</ul>
            </div>
			<div class="col-md-6">
			<?php
				echo $this->render('_mostEngagingPostTypeChart', ['most_engaging_post_types_json_table' => $insta->getMostEngagingPostTypesJsonTable($statistics['total_interaction_by_post_type'])]);
            ?>
				<ul class="graph-summery">
				<?php
					foreach($statistics['total_interaction_by_post_type'] as $key => $value){ ?>
						<li><b><?= $key ?>:</b> <?= $value ?> interactions (<?= round(((($value)/$statistics['total_interaction'])*100), 1) ?>%) </li>
				<?php } ?>
				</ul>
            </div>
			<div class="col-md-6">
				<?php
					echo $this->render('_topPhotoFilters', ['top_photo_filters_json_table' => $insta->getTopPhotoFiltersJsonTable($statistics['photo_filter'])]);
				?>
				
				<ul class="graph-summery">
				<?php
					foreach($statistics['photo_filter'] as $key => $value){ ?>
						<li><b><?= $key ?>:</b> <?= $value['amount'] ?> posts (<?= round(((($value['amount'])/$statistics['total_posts'])*100), 1) ?>%)</li>
				<?php } ?>
				</ul>
            </div>
			<div class="col-md-6">
				<?php
				echo $this->render('_mostEngagingPhotoFiltersChart', ['most_engaging_photo_filters_json_table' => $insta->getMostEngagingPhotoFiltersJsonTable($statistics['photo_filter'])]);
				?>
				<ul class="graph-summery">
					<?php
					foreach($statistics['photo_filter'] as $key => $value){ ?>
						<li><b><?= $key ?>:</b> <?= $value['interactions'] ?> interactions (<?= round(((($value['interactions'])/$statistics['total_interaction'])*100), 1) ?>%)</li>
					<?php } ?>
				</ul>
			</div>
			<div class="col-md-6">
				<?php
				echo $this->render('_topVideoFilters', ['top_video_filters_json_table' => $insta->getTopVideoFiltersJsonTable($statistics['video_filter'])]);
				?>
				<ul class="graph-summery">
					<?php
					foreach($statistics['video_filter'] as $key => $value){ ?>
						<li><b><?= $key ?>:</b> <?= $value['amount'] ?> posts (<?= round(((($value['amount'])/$statistics['total_posts'])*100), 1) ?>%)</li>
					<?php } ?>
				</ul>
            </div>
			<div class="col-md-6">
				<?php
					echo $this->render('_mostEngagingVideoFiltersChart', ['most_engaging_video_filters_json_table' => $insta->getMostEngagingVideoFiltersJsonTable($statistics['video_filter'])]);
				?>
				<ul class="graph-summery">
					<?php
					foreach($statistics['video_filter'] as $key => $value){ ?>
						<li><b><?= $key ?>:</b> <?= $value['interactions'] ?> interactions (<?= round(((($value['interactions'])/$statistics['total_interaction'])*100), 1) ?>%)</li>
					<?php } ?>
				</ul>
            </div>
		</div>
        
		<div class="row">
			<div class="col-md-12">
			<?php
				echo $this->render('_topTagsByInteractionsChart', ['tags_interactions_json_table' => $insta->getTagsInteractionsJsonTable()]);
				echo $this->render('_bestTimeToPostChart', ['total_interaction' => $statistics['total_interaction'], 'best_time_to_post_json_table' => $insta->getBestTimeToPostJsonTable($model->id, $since, $until)]);
			?>
			</div>
		</div>
		<!-- sperated line -->  
		<?php
            echo $this->render('_comparison', ['comparison' => $insta->getComparison($model->id, $since, $until, $authclient_created)]);
        ?>
      
        <!-- sperated line -->  
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Top 10 Posts</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <div class="row">
		<?php
            echo $this->render('_topPostsByEngagementRate', ['top_posts_by_engagement' => $statistics['top_posts_by_engagement']]);
		?>
		</div>

		<?php
        /*}else{
            echo 'No posts where added in the specified Date range';
        }*/
        ?>

	</div>

	<!-- inner page -->

    <?php Pjax::end(); ?>
	</div>

</div>

<!-- page content -->