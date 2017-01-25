<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Request password reset';
?>

<div class="page-content outSide">
    <div class="container content">

    <div class="inner-page">
            <div class="row">
		<div class="col-md-6 col-md-offset-3">
                    <div class="contact-title">Reset your password</div>
                    <?php $form = ActiveForm::begin(['id' => 'change-password-form', 'class' => 'request-pass-reset-form']); ?>
			<div class="row">
                            <div class="col-md-12">
				<p>Please enter your email</p>
                                <?= $form->field($oRequestPasswordResetForm, 'email')->textInput(['placeholder'=>'Email ... '])->label(false) ?>
                            </div>
                            
			</div>
          	<?= Html::submitButton('Send', ['id' => 'btn-forget-pass', 'class' => 'btn' , 'name' => 'submit-forget-password']) ?>
                    <?php ActiveForm::end(); ?>
		</div>
            </div>
        </div>
        
    </div>
</div>
<!-- page content -->