<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$dashboard_accounts = Yii::$app->session['dashboard_accounts'];
$fb = array_key_exists('facebook', $dashboard_accounts);
$yt = array_key_exists('youtube', $dashboard_accounts);
$tw = array_key_exists('twitter', $dashboard_accounts);
$insta = array_key_exists('instagram', $dashboard_accounts);
$gp = array_key_exists('google_plus', $dashboard_accounts);
?>
<?php Pjax::begin(['id' => 'pjaxComp', 'enablePushState' => false]); ?>
	<?php $form = ActiveForm::begin(['id' => 'comp-del-form','options' => ['data-pjax' => true ]]); ?>
		<input type="hidden" name="del-comp" class ="dlt">
	<?php $form = ActiveForm::end() ?>
        <div data-comp> 
                  <?php if($oCompetitors){ 
                  	
                  ?>          
                  <?php
                  foreach($oCompetitors as $oCompetitor){
                    ?>
          			
                      	<?php $form = ActiveForm::begin(['id' => $oCompetitor->id,'options' => ['data-pjax' => true ]]); ?>
                    <div class="col-md-4 comptitors">
                        <div>
                          <div class="compLogo"><img src="<?= $oCompetitor->compChannels[0]->img_url ?>"/></div>
                          <div class="compNum editable"><span><?= $oCompetitor->compChannels[0]->comp_channel_name ?></span></div>
                          
                        <span class="delete-input-btn glyphicon glyphicon-trash" id="<?= $oCompetitor->id ?>"></span>
                        </div>
                        <div class="compSocial edit-div">
                          <?= Html::activeHiddenInput($oCompetitorTest, 'compid', ['value' => $oCompetitor->id]);  ?>
                            <ul>
                                <li>
                                  <label for="facebook">facebook URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                    <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                    <?= $form->field($oCompetitorTest, 'compfb')->textInput(['class' => 'edit-input'])->label(false) ?>
                                  <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                  <?php } ?>
                                </li>
                                <li>
                                    <label  for="twitter">Twitter URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                  <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                    <?= $form->field($oCompetitorTest, 'comptw')->textInput(['class' => 'edit-input'])->label(false) ?>
                                  <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label  for="instagram">instagram URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                  <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                    <?= $form->field($oCompetitorTest, 'compinsta')->textInput(['class' => 'edit-input'])->label(false) ?>
                                  <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label  for="youtube">youtube URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                  <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                    <?= $form->field($oCompetitorTest, 'compyt')->textInput(['class' => 'edit-input'])->label(false) ?>
                                  <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                </li>
                                <li>
                                    <label  for="google">google+ URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                  <?php if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                    <?= $form->field($oCompetitorTest, 'compgp')->textInput(['class' => 'edit-input'])->label(false) ?>
                                  <?php }else{ ?>
                                        <a class="edit-input" href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                      	<?= Html::submitButton('Update', ['id' => 'btn-competitors-'.$oCompetitor->id, 'class' => 'btn btn-primary' , 'name' => 'submit-competitors-k']) ?>
                      </div>
       					<?php $form = ActiveForm::end() ?>
                  	<?php } ?>
                    
                  <?php } ?>
                  
          <!-- start of new form or button -->
                        <div class="col-md-4 comptitors new"> 
                              <div class="compSocial edit-div">
                                  <div class="addCompatitors">
                                      <button type="button" class="btn btn-primary btn-lg">
                                      <span class="glyphicon glyphicon-plus"></span>Add New
                                      </button>
                                  </div>
                              </div>
                        <div class="edit-new-form">
                          <?php $form = ActiveForm::begin(['id' => 'comp-add-1-form','options' => ['data-pjax' => true ]]); ?>
                            <div class="compNum">competitor</div>
                            <div class="compSocial">
                                <ul>
                                    <li>
                                        <label forr="antaka">facebook URL</label>
                                      <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compfb')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>Twitter URL</label>
                                      <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'comptw')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>instagram URL</label>
                                      <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compinsta')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>youtube URL</label>
                                      <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compyt')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>google+ URL</label>
                                      <?php if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compgp')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                    </li>
                                </ul>
                              <?= Html::submitButton('Add', ['id' => 'btn-competitors-1-form', 'class' => 'btn btn-primary' , 'name' => 'submit-competitors-1']) ?>
                            </div>
                          <?php $form = ActiveForm::end() ?>
                        </div>
                        <!-- new form -->
                      
                    </div>
                    <div class="col-md-4 comptitors new"> 
                        <div class="compSocial edit-div">
                          <div class="addCompatitors">
                              <button type="button" class="btn btn-primary btn-lg">
                              <span class="glyphicon glyphicon-plus"></span>Add New
                              </button>
                          </div>
                        </div>
                        <div class="edit-new-form">
                          <?php $form = ActiveForm::begin(['id' => 'comp-add-2-form','options' => ['data-pjax' => true ]]); ?>
                            <div class="compNum">competitor</div>
                            <div class="compSocial">
                                <ul>
                                    <li>
                                        <label forr="antaka">facebook URL</label>
                                      <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compfb')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>Twitter URL</label>
                                      <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'comptw')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>instagram URL</label>
                                      <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compinsta')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>youtube URL</label>
                                      <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compyt')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>google+ URL</label>
                                      <?php if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compgp')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                    </li>
                                </ul>
                              <?= Html::submitButton('Add', ['id' => 'btn-competitors-2-form', 'class' => 'btn btn-primary' , 'name' => 'submit-competitors-2']) ?>
                            </div>
                          <?php $form = ActiveForm::end() ?>
                        </div>
                        <!-- new form -->
                      
                    </div>
                    <div class="col-md-4 comptitors new"> 
                                  <div class="compSocial edit-div">
                                    <div class="addCompatitors">
                                        <button type="button" class="btn btn-primary btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span>Add New
                                        </button>
                                    </div>
                                  </div>
                        <div class="edit-new-form">
                          <?php $form = ActiveForm::begin(['id' => 'comp-add-3-form','options' => ['data-pjax' => true ]]); ?>
                           <div class="compNum">competitor</div>
                            <div class="compSocial">
                                <ul>
                                    <li>
                                        <label forr="antaka">facebook URL</label>
                                      <?php if(($fb && ($dashboard_accounts['facebook']['authclient']->source_data)) || ($admin_accounts[0]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compfb')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['facebook']) ?>">Please Authenticate Facebook first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>Twitter URL</label>
                                      <?php if(($tw && ($dashboard_accounts['twitter']['authclient']->source_data)) || ($admin_accounts[1]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'comptw')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['twitter']) ?>">Please Authenticate Twitter first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>instagram URL</label>
                                      <?php if(($insta && ($dashboard_accounts['instagram']['authclient']->source_data)) || ($admin_accounts[5]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compinsta')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['instagram']) ?>">Please Authenticate Instagram first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>youtube URL</label>
                                      <?php if(($yt && ($dashboard_accounts['youtube']['authclient']->source_data)) || ($admin_accounts[2]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compyt')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['youtube']) ?>">Please Authenticate Youtube first.</a>
                                    <?php } ?>
                                    </li>
                                    <li>
                                        <label>google+ URL</label>
                                      <?php if(($gp && ($dashboard_accounts['google_plus']['authclient']->source_data)) || ($admin_accounts[4]->source_data)){ ?>
                                            <?= $form->field($oCompetitorTest, 'compgp')->textInput()->label(false) ?>
                                      <?php }else{ ?>
                                        <a href="<?= Url::to(['google-plus']) ?>">Please Authenticate Google+ first.</a>
                                    <?php } ?>
                                    </li>
                                </ul>
                              <?= Html::submitButton('Add', ['id' => 'btn-competitors-3-form', 'class' => 'btn btn-primary' , 'name' => 'submit-competitors-3']) ?>
                            </div>
                          <?php $form = ActiveForm::end() ?>
                        </div>
                        <!-- new form -->
                      
                    </div>
          </div>

                      <?php Pjax::end(); ?>
                      