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