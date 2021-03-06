<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use digi\authclient\clients\Twitter;

$this->title = "Twitter";

$this->registerJs("tripDatePicker.today = new Date('".date('M d Y', $authclient_created)."'); 
    tripDatePicker.range_limit = 365;
    $('.startDate').prop('autofocus', false);", yii\web\View::POS_END);
?>
?>
<div class="page-content inside twitter">
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
                    <h2 class="internal-title sec-title"><?= $user['name'] ?>-Audience</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
        <?php

        if($twitter->account_insights_in_range){

            $followers_change = (($twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->followers) - ($twitter->account_insights_in_range[0]->followers));

            ?>
            <h3 class="internal-title twitter ">Followers Overview</h3>
            <div class="internal-content">
            <?php
            echo '<ul>';
            
            echo '<li><span class="small-title">Followers Number : </span>'.$twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->followers.'</li>';

            echo '<li><span class="small-title">Followers Change : </span>'.$followers_change.'</li>';

            echo '<li><span class="small-title">Avg. Followers Change per Day : </span>'.round((($followers_change)/(count($followers_growth))), 2).'</li>';

            echo '</ul>';
            ?>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <?php
            echo $this->render('_followersGrowthChart', ['followers_growth_json_table' => $twitter->getFollowersGrowthJsonTable($followers_growth)]);
            
            $following_change = (($twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->follows) - ($twitter->account_insights_in_range[0]->follows));

            ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <h3 class="internal-title twitter ">Following Overview</h3>
            <div class="internal-content">
            <?php
            echo '<ul>';
            
            echo '<li><span class="small-title">Following Number : </span>'.$twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->follows.'</li>';

            echo '<li><span class="small-title">Following Change : </span>'.$following_change.'</li>';

            echo '<li><span class="small-title">Avg. Following Change per Day : </span>'.round((($following_change)/(count($following_growth))), 2).'</li>';

            echo '</ul>';
            ?>

            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?php
            echo $this->render('_followingGrowthChart', ['following_growth_json_table' => $twitter->getFollowingGrowthJsonTable($following_growth)]);
            
            $listed_change = (($twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->listed) - ($twitter->account_insights_in_range[0]->listed));

            ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <h3 class="internal-title twitter ">Listing Overview</h3>
            <div class="internal-content">
            <?php
            echo '<ul>';
            
            echo '<li><span class="small-title">Listing Number : </span>'.$twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->listed.'</li>';

            echo '<li><span class="small-title">Listing Change : </span>'.$listed_change.'</li>';

            echo '<li><span class="small-title">Avg. Followers Change per Day : </span>'.round((($listed_change)/(count($listed_growth))), 2).'</li>';

            echo '</ul>';
            ?>            

            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
        <?php
            echo $this->render('_listingGrowthChart', ['listed_growth_json_table' => $twitter->getListedGrowthJsonTable($listed_growth)]);
        }else{
            echo 'No Audience in the specified Date range';
        }
        ?>
            </div>
        </div>
        <?php
        if($statistics){ ?>
        <!-- sperated line -->
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Content</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <h3 class="internal-title twitter ">Content Overview</h3>
            <div class="internal-content">
                <ul>
                    <li><span class="small-title">Total profile Tweets : </span><?= $statistics['total_posts'] ?></li>
                    <li><span class="small-title">Avg profile Tweet per day : </span><?= round((($statistics['total_posts'])/30),2) ?></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?php
            echo $this->render('_numberOfTweetsChart', ['total_posts' => $statistics['total_posts'], 'tweets_per_day_json_table' => $twitter->getNumberOfTweetsJsonTable($statistics['profile'])]);
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
            <h3 class="internal-title twitter ">Interactions Overview</h3>
            <div class="internal-content">
                <ul>
                    <li><span class="small-title">Total Interactions : </span><?= $statistics['total_interaction'] ?></li>
                    <li><span class="small-title">Avg Interactions per day : </span><?= round((($statistics['avg_interaction_per_day'])/30),2) ?></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->render('_numberOfTweetsInteractionsPerDayChart', ['total_interactions' => $statistics['total_interaction'], 'tweets_interactions_per_day_json_table' => $twitter->getNumberOfTweetsInteractionsPerDayJsonTable($statistics['profile'])]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <?php
                echo $this->render('_distributionOfInteractionsChart', ['interactions_by_type' => $statistics['interactions'], 'total_interactions' => $statistics['total_interaction'], 'interactions_by_type_json_table' => $twitter->getInteractionsByTypeJsonTable($statistics['interactions'])]);
                ?>
            </div><div class="col-lg-6 col-md-12">
                <?php
                echo $this->render('_distributionOfInteractionsTable', ['interactions_by_type' => $statistics['interactions'], 'total_interactions' => $statistics['total_interaction'], 'interactions_by_type_json_table' => $twitter->getInteractionsByTypeJsonTable($statistics['interactions'])]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <h3 class="internal-title twitter ">Mentions Overview</h3>
            <div class="internal-content">
                <ul>
                    <li><span class="small-title">Total Mentions : </span><?= (($statistics['mentions_per_day']['total_mentions']) ? $statistics['mentions_per_day']['total_mentions'] : 0) ?></li>
                    <li><span class="small-title">Avg Mentions per day : </span><?= (($statistics['mentions_per_day']['avg_mentions_per_day']) ? $statistics['mentions_per_day']['avg_mentions_per_day'] : 0) ?></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php 
                echo $this->render('_numberOfMenttionsPerDayChart', ['total_mentions' => $statistics['mentions_per_day']['total_mentions'],'mentions_per_day_json_table' => $twitter->getMentionsPerDayJsonTable($statistics['mentions_per_day']['profile'])]);
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
            <div class="col-md-12">
            <?php
            echo $this->render('_topTagsByInteractionsChart', ['tags_by_interactions_json_table' => $twitter->getTagsInteractionsJsonTable($statistics['tags_interactions'])]);
            ?>
            </div>
        </div>
		
        <div class="row">
            <div class="col-md-12">    
			<?php
            echo $this->render('_topTenTrends', ['top_ten_trends' => $top_ten_trends]);
            ?>
            </div>
        </div>
        <!-- sperated line -->
      
      
		<?php
            echo $this->render('_comparison', ['comparison' => $twitter->getComparison($model->id, $since, $until, $authclient_created)]);
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
            <div class="col-md-12">
            <?php
            echo $this->render('_topPostsByEngagementRate', ['top_posts_by_engagement' => $statistics['top_posts_by_engagement']]);
            ?>
            </div>
        </div>
        <?php
        }
        ?>
	</div>
	<!-- inner page -->
    <?php Pjax::end(); ?>
	</div>
</div>
<!-- page content -->