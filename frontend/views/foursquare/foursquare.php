<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Foursquare';
?>

<div class="page-content inside foursquare">
    <div class="container">
	<div class="inner-page">
            <?php
                $venues = [];
                foreach($managed_venues["items"] as $managed_venue){
                    $venues[$managed_venue['id']] = $managed_venue["name"];
                }
                if(!empty($venues)){
                $form = ActiveForm::begin(['id' => 'userPagesForm']);
            ?>
            <?= $form->field($oUserPagesForm, 'id')->dropDownList($venues)->label('Please Select the venue you need to manage with Hype') ?>
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['id' => 'submit_contact', 'name' => 'submit']) ?>
            <?php
                ActiveForm::end();
                }else{
                    echo "Sorry, it looks like you aren't managing any venues";
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
	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square active"></i></a></div>
    </div>
</div>