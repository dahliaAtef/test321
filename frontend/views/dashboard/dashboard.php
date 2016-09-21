<?php

use yii\helpers\Url;
use yii\authclient\widgets\AuthChoice;
use digi\authclient\clients\Facebook;
use digi\authclient\clients\Youtube;

$this->title = 'Dashboard';
//echo '<pre>'; var_dump($insights); echo '</pre>'; die;
$sx = $oDashboard->getSocialMediaExistance($insights);
$fb = array_key_exists('facebook', Yii::$app->session['dashboard_accounts']);
$yt = array_key_exists('youtube', Yii::$app->session['dashboard_accounts']);
$tw = array_key_exists('twitter', Yii::$app->session['dashboard_accounts']);
$insta = array_key_exists('instagram', Yii::$app->session['dashboard_accounts']);
$gp = array_key_exists('google_plus', Yii::$app->session['dashboard_accounts']);
$in = array_key_exists('linkedin', Yii::$app->session['dashboard_accounts']);
?>
<div class="page-content inside dashboard">
    <div class="container">
	<div class="inner-page">

        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Social Media Existance</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>



            <?php 
            if(Yii::$app->session['dashboard_accounts']){ 
                $kpi_overviews = $oDashboard->getChannelsKpiOverviews();
            ?>
            <?= $this->render('_socialMediaExistanceChart', ['sx_json_table' => $oDashboard->getSocialMediaExistanceJsonTable($sx),'sx' => $sx]); ?>
            
            <?= $this->render('_growthPerChannelChart', ['growth_per_channel' => $oDashboard->getGrowthPerMonth($insights)]); ?>
       

        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">KPI Overview</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            if(array_key_exists('facebook', $kpi_overviews)){

            echo '<div class="col-md-6">';
                echo $this->render('_fbKpiOverview', ['overview' => $kpi_overviews['facebook']]);
            echo '</div>';
            }
            if(array_key_exists('twitter', $kpi_overviews)){

            echo '<div class="col-md-6">';
                echo $this->render('_twKpiOverview', ['overview' => $kpi_overviews['twitter']]);
            echo '</div>';
            }
            if(array_key_exists('instagram', $kpi_overviews)){

            echo '<div class="col-md-6">';
                echo $this->render('_instaKpiOverview', ['overview' => $kpi_overviews['instagram']]);
            echo '</div>';
            }
            if(array_key_exists('youtube', $kpi_overviews)){

            echo '<div class="col-md-6">';
                echo $this->render('_ytKpiOverview', ['overview' => $kpi_overviews['youtube']]);
            echo '</div>';
            }
            if(array_key_exists('google_plus', $kpi_overviews)){

            echo '<div class="col-md-6">';
                echo $this->render('_gpKpiOverview', ['overview' => $kpi_overviews['google_plus']]);
            echo '</div>';
            }
            ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Social Media Interactions</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

            <?= $this->render('_channelInteractionsChart', ['interaction_per_channel_json_table' => $oDashboard->getInteractionPerChannelJsonTable($kpi_overviews)]); ?>
           
			
            <?php
            if($fb || $insta || $yt){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title">Views by Age & Gender</h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>

                <?php
                if($fb){
                    echo $this->render('_fb_age_gender', ['fans_gender_age' => json_decode($insights['facebook']['last_insights']->insights_json, true)['gender_age'], 'followers' => $insights['facebook']['last_insights']->followers]);
                }
                if($yt){
                    $fans_gender_age_per = json_decode($insights['youtube']['last_insights']->insights_json, true)['gender_age'];
                    $counter = 0;
                    foreach($fans_gender_age_per as $fans_gender_age){
                        $fans_gender_age_per[$counter][2] = round((($fans_gender_age[2] * $insights['youtube']['last_insights']->followers)/100), 0);
                        $counter++;
                    }
                    echo $this->render('_yt_age_gender', ['fans_gender_age' => $fans_gender_age_per, 'followers' => $insights['youtube']['last_insights']->followers]);
                }
            } ?>
				
				<?php
				if($fb || $yt || $tw){?>
					<div class="row">
						<div class="col-md-12">
							<div class="title-box">
								<h2 class="internal-title sec-title">Views by Device Types</h2>
								<div class="line-box"></div>
							</div>
						</div>
					</div>
					<?php 
					if($fb){
						echo $this->render('_fb_device_type', ['devices' => json_decode($insights['facebook']['last_insights']->insights_json, true)['page_views']]);
					}
					if($tw){
						echo $this->render('_tw_device_type', ['devices' => json_decode($insights['twitter']['last_insights']->insights_json, true)]);
					}
					if($yt){
						echo $this->render('_yt_device_type', ['devices' => json_decode($insights['youtube']['last_insights']->insights_json, true)['device']]);
					}
					?>
				<?php }
				?>
				<?php
				if($fb){ ?>
					<div class="row">
						<div class="col-md-12">
							<div class="title-box">
								<h2 class="internal-title sec-title">Page Organic & Paid Reach</h2>
								<div class="line-box"></div>
							</div>
						</div>
					</div>
					<?php
					echo $this->render('_fb_paid_organic_reach', ['reach' => json_decode($insights['facebook']['last_insights']->insights_json, true)['organic_paid_reach_json_table']]);
				}
				?>
			<div class="row">
				<div class="col-md-12">
					<div class="title-box">
						<h2 class="internal-title sec-title">Views by Country</h2>
						<div class="line-box"></div>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-md-12">
					<?php
						if($fb){
							$top_fifteen_countries = Facebook::getCountryName(json_decode($insights['facebook']['last_insights']->insights_json, true)['reach_by_country']);
							echo $this->render('_fb_views_by_country', ['countries_json_table' => Facebook::getcountriesJsonTable($top_fifteen_countries)]);
						} 
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
						if($yt){
							echo $this->render('_yt_views_by_country', ['countries_json_table' => Youtube::getAnalyticsPerLocationsViewsDashboardJsonTable(json_decode($insights['youtube']['last_insights']->insights_json, true)['location'])]);
						} 
					?>
				</div>
			</div>
        <?php } ?>

	</div>
	<!-- inner page -->


<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

    </div>

</div>
<!-- page content -->
<div class="page-tabs">
    <div class="tabs">
	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard active"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="internal-title noneBG modal-title compNum" id="myModalLabel">Name Your Compitators</h3>
      </div>
      <div class="modal-body">
        
            <div class="container">
                <div class="row">
                    <div class="col-md-4 comptitors">
                        <div class="compNum">compatitor 1</div>
                        <div class="compSocial">
                            <ul>
                                <li>
                                    <label forr="antaka">facebook URL</label>
                                    <input type="text" placeHolder="Add URL" name="antaka">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 comptitors">
                        <div class="compNum">compatitor 2</div>
                        <div class="compSocial">
                            <ul>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 comptitors">
                        <div class="compNum">compatitor 3</div>
                        <div class="compSocial">
                            <ul>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                                <li>
                                    <label>facebook URL</label>
                                    <input type="text" placeHolder="Add URL">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- POP UP -->

