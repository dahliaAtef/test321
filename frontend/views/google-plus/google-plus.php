<?php
use digi\authclient\clients\GooglePlus;
use yii\helpers\Url;

$this->title = 'Google+';
?>

<div class="page-content inside google-plus">
  <div id="loadWh">
    <div id="loadx">
      <img src="http://adigitree.org/shared/themes/frontend/images/logoLoader.png" alt="">
    </div>
  </div><!-- loader -->
    <div class="container">
	<div class="inner-page">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title"><?= $account['displayName'] ?>-Audience</h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>

            
            <?php
            
            $followers_change = (($googleP->account_insights_in_range[count($googleP->account_insights_in_range)-1]->followers) - ($googleP->account_insights_in_range[0]->followers));
            ?>

            <div class="row"><div class="col-md-6">
            <h3 class="internal-title google-plus ">Fans Overview</h3>
            <div class="internal-content">
                <?php
                echo '<ul>';
                echo '<li><span class="small-title">Total Followers Count : </span>'.$googleP->account_insights_in_range[count($googleP->account_insights_in_range)-1]->followers.'</li>';

                echo '<li><span class="small-title">Followers Change : </span>'.$followers_change.'</li>';

                echo '<li><span class="small-title">Avg. Followers Change per Day : </span>'.round((($followers_change)/(count($followers_growth))), 2).'</li>';

                echo '</ul>';
            echo '</div></div></div>';
                

                echo '<div class="row"><div class="col-md-12">';
                echo $this->render('_followersGrowthChart', ['followers_growth_json_table' => $googleP->getFollowersGrowthJsonTable($followers_growth)]);
                echo '</div></div>';

                
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
                <div class="col-md-6">            
                <h3 class="internal-title google-plus" >Interactions Overview</h3>
                <?php
                echo '<div class="internal-content">';
                echo '<div class="row">';
                echo '<ul>';
                echo '<li class="col-md-6"><span class="small-title">Total Posts : </span>'.$statistics['total_posts'].'</li>';
                echo '<li class="col-md-6"><span class="small-title">Total Likes : </span>'.$statistics['total_post_likes'].'</li>';
                echo '<li class="col-md-6"><span class="small-title">Total Comments : </span>'.$statistics['total_post_comments'].'</li>';
                echo '<li class="col-md-6"><span class="small-title">Total Shares : </span>'.$statistics['total_post_shares'].'</li>';
                echo '<li class="col-lg-6 col-md-12"><span class="small-title">Avg. Likes Per Post : </span>'.$statistics['avg_likes_per_post'].'</li>';
                echo '<li class="col-lg-6 col-md-12"><span class="small-title">Avg. Comments Per Post : </span>'.$statistics['avg_comments_per_post'].'</li>';
                echo '<li class="col-lg-6 col-md-12"><span class="small-title">Avg. Shares Per Post : </span>'.$statistics['avg_shares_per_post'].'</li>';
                echo '</ul>';
                echo '</div></div></div></div>';

                echo '<div class="row"><div class="col-md-12">';
				
                    echo $this->render('_numberOfPostsChart', ['total_posts' => $statistics['total_posts'], 'number_of_posts_json_table' => $googleP->getNumberOfPostsJsonTable($statistics['profile'])]);
                echo '</div></div>';
                echo '<div class="row"><div class="col-md-12">';
					$total_interactions = $statistics['total_post_likes'] + $statistics['total_post_comments'] + $statistics['total_post_shares'];
                    echo $this->render('_numberOfInteractionsChart', ['total_interactions' => $total_interactions, 'number_of_interactions_json_table' => $googleP->getNumberOfInteractionsJsonTable($statistics['profile'])]);
                echo '</div></div>';
                ?>


            <div class="row">
                <div class="col-md-6">            
                <h3 class="internal-title google-plus" >Engagement Overview</h3>

            <?php
            echo '<div class="internal-content">';
            echo '<ul>';
            echo '<li><span class="small-title">Avg. Post Engagement Rate : </span>'.$statistics['avg_post_engagement_rate'].'%</li>';

            echo '<li><span class="small-title">Max. Post Engagement Rate : </span>'.$statistics['max_post_engagement_rate'].'%</li>';

            echo '<li><span class="small-title">Avg. Profile Engagement Rate : </span>'.$statistics['avg_profile_engagement_rate'].'%</li>';

            echo '<li><span class="small-title">Max. Profile Engagement Rate : </span>'.$statistics['max_profile_engagement_rate'].'%</li>';
            echo '</ul>';
            echo '</div></div></div>';

            echo '<div class="row"><div class="col-md-12">';
                echo $this->render('_postEngagementChart', ['total_posts' => $statistics['total_posts'], 'post_engagement_per_day_json_table' => $googleP->getPostEngagementJsonTable($statistics['profile'])]);
            echo '</div></div>';
            echo '<div class="row"><div class="col-md-12">';
                echo $this->render('_profileEngagementChart', ['total_posts' => $statistics['total_posts'], 'profile_engagement_per_day_json_table' => $googleP->getProfileEngagementJsonTable($statistics['profile'])]);
            echo '</div></div>';

           
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title">Audience</h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>

            <!--<div class="row">
                <div class="col-md-12">
                    </?php
                    //echo $this->render('_bestTimeToPostChart', ['total_interactions' => $total_interactions, 'best_time_to_post_json_table' => $googleP->getBestTimeToPostJsonTable($oAccountModel->id)]);
                    ?>
                </div>
            </div>-->

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
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->