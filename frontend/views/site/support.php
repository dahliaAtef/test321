<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Support');
?>

<div class="page-content inside">
    <div class="container">
		<div class="inner-page">
            <div class="row">
				<div class="col-md-6 col-md-offset-3">
                    <div class="contact-title">FEEL FREE TO CONTACT US</div>
					<?php $form = ActiveForm::begin(['id' => 'support-form']); ?>
					<form class="contact-form">
						<div class="row">
							<div class="col-md-12">
								<p>Name</p>
								<?= $form->field($oSupportForm, 'name')->textInput()->label(false) ?>
							</div>
							<div class="col-md-12">
								<p>Mobile</p>
								<?= $form->field($oSupportForm, 'mobile')->textInput()->label(false) ?>
							</div>
							<div class="form-group col-md-12">
								<label class="control-label">Requested Support :</label>
								<div class="radio">
								<?= $form->field($oSupportForm, 'support')->radioList([0 => 'Feedback', 1 => 'Technical', 2 => 'Complaint'])->label(false); ?>
								</div>
							</div>
							<div class="col-md-12">
								<p>Message</p>
								<?= $form->field($oSupportForm, 'message')->textArea(['rows' => '6'])->label(false)  ?>
							</div>
						</div>
						<?= Html::submitButton('Send', ['id' => 'btn-support', 'class' => 'btn' , 'name' => 'submit-support', 'data-error'=>'Oops!, Something is wrong', 'data-success'=>'Success, message sent']) ?>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
		<!-- inner page -->
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