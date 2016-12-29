<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Contact Us');
?>
<div class="page-content outSide">
    <div class="container">
        <div class="inner-page">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-title">FEEL FREE TO CONTACT US</div>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => 'contact-form']); ?>
			<div class="row">
                            <div class="col-md-12">
				<div class="field">
                                    <p>Email</p>
                                    <?= $form->field($oContactForm, 'email')->textInput()->label(false) ?>
				</div>
                            </div>
                            <div class="col-md-12">
				<div class="field">
                                    <p>Mobile</p>
                                    <?= $form->field($oContactForm, 'phone')->textInput()->label(false) ?>
				</div>
                            </div>
                            <div class="col-md-12">
				<div class="field">
                                    <p>Message</p>
                                    <?= $form->field($oContactForm, 'message')->textArea(['rows' => '6'])->label(false)  ?>
				</div>
                            </div>
			</div>
                        <?= Html::submitButton('Send', ['id' => 'btn-contact', 'class' => 'btn' , 'name' => 'submit-contact', 'data-error'=>'Oops!, Something is wrong', 'data-success'=>'Success, message sent']) ?>
                    <?php ActiveForm::end(); ?>
		</div>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->
