<?php
use yii\helpers\Url;
use digi\authclient\clients\Twitter;

$this->title = 'Twitter';

?>
<div class="page-content inside twitter">
    <div class="container">
	<div class="inner-page">
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title"><?= $user['name'] ?> Audience</h2>
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
            
            echo '<li><span class="small-title">Total Followers Count : </span>'.$twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->followers.'</li>';

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
            
            echo '<li><span class="small-title">Total Following Count : </span>'.$twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->follows.'</li>';

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
            
            echo '<li><span class="small-title">Total Listing Count : </span>'.$twitter->account_insights_in_range[count($twitter->account_insights_in_range)-1]->listed.'</li>';

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
                    <h2 class="internal-title sec-title"><?= $user['name'] ?> Content</h2>
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
            echo $this->render('_numberOfTweetsChart', ['tweets_per_day_json_table' => $twitter->getNumberOfTweetsJsonTable($statistics['profile'])]);
            ?>
            </div>
        </div>
        <!-- sperated line -->
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title"><?= $user['name'] ?> Engagement</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <h3 class="internal-title twitter ">Interactions Overview</h3>
            <div class="internal-content">
                <ul>
                    <li>Total Interactions : <?= $statistics['total_interaction'] ?></li>
                    <li>Avg Interactions per day : <?= round((($statistics['avg_interaction_per_day'])/30),2) ?></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->render('_numberOfTweetsInteractionsPerDayChart', ['tweets_interactions_per_day_json_table' => $twitter->getNumberOfTweetsInteractionsPerDayJsonTable($statistics['profile'])]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                echo $this->render('_distributionOfInteractionsChart', ['interactions_by_type' => $statistics['interactions'], 'total_interactions' => $statistics['total_interaction'], 'interactions_by_type_json_table' => $twitter->getInteractionsByTypeJsonTable($statistics['interactions'])]);
                ?>
            </div><div class="col-md-6">
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
                    <li>Total Mentions : <?= $statistics['mentions_per_day']['total_mentions'] ?></li>
                    <li>Avg Mentions per day : <?= $statistics['mentions_per_day']['avg_mentions_per_day'] ?></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->render('_numberOfMenttionsPerDayChart', ['mentions_per_day_json_table' => $twitter->getMentionsPerDayJsonTable($statistics['mentions_per_day']['profile'])]);
                ?>
            </div>
        </div>
        <!-- sperated line -->
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title"><?= $user['name'] ?> Optimization</h2>
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
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title"><?= $user['name'] ?> Top 10 Posts</h2>
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
    </div>
</div>
<!-- page content -->
<div class="page-tabs">
    <div class="tabs">
	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit active"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>
    </div>
</div>