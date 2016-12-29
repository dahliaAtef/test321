<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\authclient\widgets\AuthChoice;
use digi\authclient\clients\Facebook;
use digi\authclient\clients\Twitter;
use digi\authclient\clients\Instagram;
use digi\authclient\clients\Youtube;
use digi\authclient\clients\LinkedIn;
use common\models\custom\Model;
use common\models\custom\User;
use yii\widgets\Pjax;

$this->title = 'Dashboard';
$dashboard_accounts = Yii::$app->session['dashboard_accounts'];
$sx = $oDashboard->getSocialMediaExistance($insights);
//echo '<pre>'; var_dump(json_decode($insights['facebook']['last_insights']->insights_json, true)['page_posts_organic_reach']); echo '</pre>'; die;
$fb = array_key_exists('facebook', $dashboard_accounts);
$yt = array_key_exists('youtube', $dashboard_accounts);
$tw = array_key_exists('twitter', $dashboard_accounts);
$insta = array_key_exists('instagram', $dashboard_accounts);
$gp = array_key_exists('google_plus', $dashboard_accounts);
$in = array_key_exists('linkedin', $dashboard_accounts);
reset($dashboard_accounts);
$name = User::findOne(Yii::$app->user->getId())->brand_name;
?>
<div class="page-content inside dashboard">
    <?php
	if(($fb && ($dashboard_accounts['facebook']['authclient']->created > time())) || ($tw && ($dashboard_accounts['twitter']['authclient']->created > time())) || ($insta && ($dashboard_accounts['instagram']['authclient']->created > time())) || ($yt && ($dashboard_accounts['youtube']['authclient']->created > time())) || ($gp && ($dashboard_accounts['google_plus']['authclient']->created > time())) || ($in && ($dashboard_accounts['linkedin']['authclient']->created > time()))){
      ?>
 <div class="warning-msg">
  <i class="glyphicon glyphicon-warning-sign"></i>&nbsp &nbsp Kindly note that HYPE takes up to <b>3 days</b> to analyse your full data
</div><!-- warning msg -->
  <?php } ?>
  <div id="loadWh">
    <div id="loadx">
      <img src="http://adigitree.org/shared/themes/frontend/images/logoLoader.png" alt="">
    </div>
  </div><!-- loader -->
    <div class="container">
    <div class="inner-page">
      <?php
      	if($dashboard_accounts){
      ?>
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Social Media Existance</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>



            <?php 
            if($dashboard_accounts){ 
                $kpi_overviews = $oDashboard->getChannelsKpiOverviews();
            ?>
            <?= $this->render('_socialMediaExistanceChart', ['sx_json_table' => $oDashboard->getSocialMediaExistanceJsonTable($sx),'sx' => $sx, 'name' => $name]); ?>
            
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
            if(array_key_exists('linkedin', $kpi_overviews)){

            echo '<div class="col-md-6">';
                echo $this->render('_inKpiOverview', ['overview' => $kpi_overviews['linkedin']]);
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
            <?= $this->render('_channelInteractionsChart', ['interaction_per_channel_json_table' => $oDashboard->getInteractionPerChannelJsonTable($kpi_overviews), 'kpi_overviews' => $kpi_overviews]); ?>
           
            
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
				 ?>
                
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
                        if($yt){
                            echo $this->render('_yt_views_by_country', ['countries_json_table' => Youtube::getAnalyticsPerLocationsViewsDashboardJsonTable(json_decode($insights['youtube']['last_insights']->insights_json, true)['location'])]);
                        } 
                    ?>
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
        <?php } ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="title-box">
                    <h2 class="internal-title sec-title">Audience Demographics</h2>
                    <div class="line-box"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            $undefined = ['gender' => '...', 'age' => '...', 'country' => '...', 'language' => '...', 'device' => '...', 'industry' => '...', 'seniority' => '...'];
            $unauthenticated = ['gender' => 'Un-authenticated', 'age' => 'Un-authenticated', 'country' => 'Un-authenticated', 'language' => 'Un-authenticated', 'device' => 'Un-authenticated', 'industry' => 'Un-authenticated', 'seniority' => 'Un-authenticated'];
            if($fb){
                $facebook = Facebook::getFansDemographicsDashboard(json_decode($insights['facebook']['last_insights']->insights_json, true));
            }else{
                $facebook = $unauthenticated;
            }
            if($tw){
                $twitter = $undefined;
            }else{
                $twitter = $unauthenticated;
            }
            if($insta){
                $instagram = $undefined;
            }else{
                $instagram = $unauthenticated;
            }
            if($yt){
                $youtube = Youtube::getFansDemographics(json_decode($insights['youtube']['last_insights']->insights_json, true));
            }else{
                $youtube = $unauthenticated;
            }
            if($gp){
                $google_plus = $undefined;
            }else{
                $google_plus = $unauthenticated;
            }
            if($in){
                $linkedin = LinkedIn::getFansDemographics(json_decode($insights['linkedin']['last_insights']->insights_json, true));
            }else{
                $linkedin = $unauthenticated;
            }
            ?>
          <table class="facebook">
            <tr>
                <th>Metric</th>
                <th>Facebook</th>
                <th>Twitter</th>
                <th>Instagram</th>
                <th>Youtube</th>
                <th>Google Plus</th>
                <th>LinkedIn</th>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?= ucwords($facebook['gender']) ?></td>
                <td><?= $twitter['gender'] ?></td>
                <td><?= $instagram['gender'] ?></td>
                <td><?= ucwords($youtube['gender']) ?></td>
                <td><?= $google_plus['gender'] ?></td>
                <td><?= $linkedin['gender'] ?></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><?= $facebook['age'] ?></td>
                <td><?= $twitter['age'] ?></td>
                <td><?= $instagram['age'] ?></td>
                <td><?= $youtube['age'] ?></td>
                <td><?= $google_plus['age'] ?></td>
                <td><?= $linkedin['age'] ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><?= $facebook['country'] ?></td>
                <td><?= $twitter['country'] ?></td>
                <td><?= $instagram['country'] ?></td>
                <td><?= $youtube['country'] ?></td>
                <td><?= $google_plus['country'] ?></td>
                <td><?= $linkedin['country'] ?></td>
            </tr>
            <tr>
                <td>Language</td>
                <td><?= $facebook['language'] ?></td>
                <td><?= $twitter['language'] ?></td>
                <td><?= $instagram['language'] ?></td>
                <td><?= $youtube['language'] ?></td>
                <td><?= $google_plus['language'] ?></td>
                <td><?= $linkedin['language'] ?></td>
            </tr>
            <tr>
                <td>Device</td>
                <td><?= ucwords($facebook['device']) ?></td>
                <td><?= $twitter['device'] ?></td>
                <td><?= $instagram['device'] ?></td>
                <td><?= ucwords(strtolower($youtube['device'])) ?></td>
                <td><?= $google_plus['device'] ?></td>
                <td><?= $linkedin['device'] ?></td>
            </tr>
            <tr>
                <td>Industry</td>
                <td><?= $facebook['industry'] ?></td>
                <td><?= $twitter['industry'] ?></td>
                <td><?= $instagram['industry'] ?></td>
                <td><?= $youtube['industry'] ?></td>
                <td><?= $google_plus['industry'] ?></td>
                <td><?= $linkedin['industry'] ?></td>
            </tr>
            <tr>
                <td>Seniority</td>
                <td><?= $facebook['seniority'] ?></td>
                <td><?= $twitter['seniority'] ?></td>
                <td><?= $instagram['seniority'] ?></td>
                <td><?= $youtube['seniority'] ?></td>
                <td><?= $google_plus['seniority'] ?></td>
                <td><?= $linkedin['seniority'] ?></td>
            </tr>
        </table>
        </div>
		<?php }else{ ?>
        <?= $this->render('_first_time'); ?>
      <?php } ?>
    </div>
    <!-- inner page -->

    </div>

</div>
<!-- page content -->

<div class="modal  bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php $form = ActiveForm::begin(['id' => 'competitors-form', 'class' => 'competitors-form']); ?>
      <div class="modal-header">
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="subsc-modal-title"><span>Name Your Competitors</span></div> 
        <!-- <h3 class="internal-title noneBG modal-title" id="myModalLabel">Name Your Compitators</h3> -->
      </div>
      <div class="modal-body">
        
            <div class="container">
                
                <div class="row">
                    <div class="col-md-4 comptitors">
                        <div class="compNum">competitor 1</div>
                        <div class="compSocial">
                            <ul>
                                <li>
                                    <label forr="antaka">facebook URL</label>
                                    <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp1fb')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>Twitter URL</label>
                                    <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp1tw')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>instagram URL</label>
                                    <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp1insta')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>youtube URL</label>
                                    <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp1yt')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>google+ URL</label>
                                    <?php  if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp1gp')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                </li>
                            </ul>
                            <!--<button type="button" class="btn btn-primary">Add</button>-->                            
                        </div>
                    </div>
                    <div class="col-md-4 comptitors">
                        <div class="compNum">competitor 2</div>
                        <div class="compSocial">
                            <ul>
                                <li>
                                    <label forr="antaka">facebook URL</label>
                                    <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp2fb')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>Twitter URL</label>
                                    <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp2tw')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>instagram URL</label>
                                    <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp2insta')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>youtube URL</label>
                                    <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp2yt')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>google+ URL</label>
                                    <?php if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp2gp')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                </li>
                            </ul>
                            <!--<button type="button" class="btn btn-primary">Add</button>-->
                        </div>
                    </div>
                    <div class="col-md-4 comptitors">
                        <div class="compNum">competitor 3</div>
                        <div class="compSocial">
                            <ul>
                                <li>
                                    <label forr="antaka">facebook URL</label>
                                    <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp3fb')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>Twitter URL</label>
                                    <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp3tw')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>instagram URL</label>
                                    <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp3insta')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>youtube URL</label>
                                    <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp3yt')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label>google+ URL</label>
                                    <?php if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                        <?= $form->field($oCompetitorsForm, 'comp3gp')->textInput()->label(false) ?>
                                    <?php }else{ ?>
                                        <a href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                </li>
                            </ul>
                          
                            <!--<button type="button" class="btn btn-primary">Add</button>-->
                        </div>
                    </div>
                </div>
                
            </div>
      </div>
      <div class="modal-footer">
		<?= Html::submitButton('Submit', ['id' => 'btn-competitors', 'class' => 'btn btn-primary' , 'name' => 'submit-competitors']) ?>
        <!--button type="button" class="btn btn-primary">Submit</button-->
      </div>
	  <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<!-- standard compatitors POP UP -->
<div class="modal  bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="close" data-dismiss="modal" aria-label="Close" id="close_modal_2">
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="subsc-modal-title"><span>Edit Your Competitors</span></div> 
        <!-- <h3 class="internal-title noneBG modal-title" id="myModalLabel">Name Your Compitators</h3> -->
      </div>
      <div class="modal-body">
        		 
            <div class="container">
                <div class="row">
                  <?= $this->render('/competitors/index', ['oCompetitors' => $oCompetitors, 'oCompetitorTest' => $oCompetitorTest, 'admin_accounts' => $admin_accounts]) ?>
                </div>
                
            </div>
         
      </div>
    </div>
  </div>
</div>
