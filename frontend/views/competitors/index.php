<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
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
                          <div class="compLogo"><img src="<?= Url::to('@frontThemeUrl') ?>/images/apple.png"/></div>
                          <div class="compNum editable"><span><?= $oCompetitor->compChannels[0]->comp_channel_name ?></span></div>
                          
                        <span class="delete-input-btn glyphicon glyphicon-remove" id="<?= $oCompetitor->id ?>"></span>
                        </div>
                        <div class="compSocial edit-div">
                          <?= Html::activeHiddenInput($oCompetitorTest, 'compid', ['value' => $oCompetitor->id]);  ?>
                            <ul>
                                <li>
                                  <label for="facebook">facebook URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                    <?= $form->field($oCompetitorTest, 'compfb')->textInput(['class' => 'edit-input'])->label(false) ?>
                                </li>
                                <li>
                                    <label  for="twitter">Twitter URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                    <?= $form->field($oCompetitorTest, 'comptw')->textInput(['class' => 'edit-input'])->label(false) ?>
                                </li>
                                <li>
                                    <label  for="instagram">instagram URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                    <?= $form->field($oCompetitorTest, 'compinsta')->textInput(['class' => 'edit-input'])->label(false) ?>
                                </li>
                                <li>
                                    <label  for="youtube">youtube URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                    <?= $form->field($oCompetitorTest, 'compyt')->textInput(['class' => 'edit-input'])->label(false) ?>
                                </li>
                                <li>
                                    <label  for="google">google+ URL</label><span class="edit-input-btn glyphicon glyphicon-pencil"></span>
                                    <?= $form->field($oCompetitorTest, 'compgp')->textInput(['class' => 'edit-input'])->label(false) ?>
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
                                            <?= $form->field($oCompetitorTest, 'compfb')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>Twitter URL</label>
                                            <?= $form->field($oCompetitorTest, 'comptw')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>instagram URL</label>
                                            <?= $form->field($oCompetitorTest, 'compinsta')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>youtube URL</label>
                                            <?= $form->field($oCompetitorTest, 'compyt')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>google+ URL</label>
                                            <?= $form->field($oCompetitorTest, 'compgp')->textInput()->label(false) ?>
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
                                            <?= $form->field($oCompetitorTest, 'compfb')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>Twitter URL</label>
                                            <?= $form->field($oCompetitorTest, 'comptw')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>instagram URL</label>
                                            <?= $form->field($oCompetitorTest, 'compinsta')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>youtube URL</label>
                                            <?= $form->field($oCompetitorTest, 'compyt')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>google+ URL</label>
                                            <?= $form->field($oCompetitorTest, 'compgp')->textInput()->label(false) ?>
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
                                            <?= $form->field($oCompetitorTest, 'compfb')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>Twitter URL</label>
                                            <?= $form->field($oCompetitorTest, 'comptw')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>instagram URL</label>
                                            <?= $form->field($oCompetitorTest, 'compinsta')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>youtube URL</label>
                                            <?= $form->field($oCompetitorTest, 'compyt')->textInput()->label(false) ?>
                                    </li>
                                    <li>
                                        <label>google+ URL</label>
                                            <?= $form->field($oCompetitorTest, 'compgp')->textInput()->label(false) ?>
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
                      