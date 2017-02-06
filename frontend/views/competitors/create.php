<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Create Competitors';
$dashboard_accounts = Yii::$app->session['dashboard_accounts'];
$fb = array_key_exists('facebook', $dashboard_accounts);
$yt = array_key_exists('youtube', $dashboard_accounts);
$tw = array_key_exists('twitter', $dashboard_accounts);
$insta = array_key_exists('instagram', $dashboard_accounts);
$gp = array_key_exists('google_plus', $dashboard_accounts);
?>

<div class="page-content outSide  dashboard">
    
        <?php $form = ActiveForm::begin(['id' => 'competitors-form', 'class' => 'competitors-form']); ?>
        
            <div class="container">
                <div class="inner-page">
                <div class="row">  
                    <div class="col-md-12 comptitors back-Btn-cont">                      
                    <a class="back-Btn" href="<?= Url::to(['/dashboard']) ?>"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <div class="subsc-modal-title"><span>Name Your Competitors</span></div> 
                    </div> 
                </div>
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