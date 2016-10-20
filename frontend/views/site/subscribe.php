<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Subscribe');
?>

<div class="page-content outSide card">
    <div class="container content">
	<div class="inner-page" id="formView">
            <div class="row">
		<div class="col-md-6 col-md-offset-3">
                    <div class="subsc-title">Subscirbe</div>
					<?php Pjax::begin([]); ?>
                    <?php $form = ActiveForm::begin(['id' => 'subsc-form', 'enableClientValidation' => true]); ?>
						
                            <div class="row">
				<div class="col-md-6">
                                    <p>Name</p>
									<?= $form->field($oUserForm, 'username')->textInput()->label(false) ?>
				</div>
                                <div class="col-md-6">
                                    <p>Mobile</p>
									<?= $form->field($oUserForm, 'mobile')->textInput()->label(false) ?>
                                </div>
                            </div>
                            <div class="row">
				<div class="col-md-6">
                                    <p>Brand Name</p>
									<?= $form->field($oUserForm, 'brand_name')->textInput()->label(false)?>
				</div>
				<div class="col-md-6">
                                    <p>E-mail</p>
									<?= $form->field($oUserForm, 'email')->textInput()->label(false) ?>
				</div>
                            </div>
                            <div class="row">
				<div class="col-md-6">
                                    <p>Password</p>
									<?= $form->field($oUserForm, 'password')->passwordInput()->label(false) ?>
				</div>
				<div class="col-md-6">
                                    <p>Re-Password</p>
									<?= $form->field($oUserForm, 're_password')->passwordInput()->label(false) ?>
				</div>
				<?= $form->field($oUserForm, 'verifySuccess')->hiddenInput(['value'=> $success])->label(false) ?>
                            </div>
							<?php
								if(Yii::$app->session['error']){ ?>
									<div class="error-summary"><?= Yii::$app->session['error'][0] ?></div>
							<?php }
							?>
                            <?= Html::submitButton('Send', ['id' => 'btn-subsc', 'class' => 'btn' , 'name' => 'submit-subsc' ,   'data-error'=>'Oops!, Something is wrong', 'data-success'=>'Success, message sent']) ?>
                        <?php ActiveForm::end(); ?>
						<?php Pjax::end(); ?>
		</div>
            </div>
	</div>
	<!-- inner page form -->
	<div class="inner-page" id="successView" >

      	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="logo-home-success">
					<img src="<?= Url::to('@frontThemeUrl/images/logo-home.png', true) ?>">
				</div>
				<div class="about-hype-success">
					<p class="welcome-success">WELCOME TO HYPE</p>
					<p class="thanks-success">Thank you for signing up with us</p>
					<p class="stutas-success">Your account will be activated with 72 hours</p>
				</div>
			</div>
		</div>
	</div>							
    </div>
</div>
<!-- page content -->