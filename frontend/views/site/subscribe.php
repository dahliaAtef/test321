<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Subscribe');
?>

<div class="page-content outSide">
    <div class="container">
	<div class="inner-page">
            <div class="row">
		<div class="col-md-6 col-md-offset-3">
                    <div class="subsc-title">Subscirbe</div>
                    <?php $form = ActiveForm::begin(['id' => 'subsc-form']); ?>
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
                                    <?= $form->field($oUserForm, 'brand_name')->textInput()->label(false) ?>
				</div>
				<div class="col-md-6">
                                    <p>E-mail</p>
                                    <?= $form->field($oUserForm, 'email')->textInput()->label(false) ?>
				</div>
                            </div>
                            <div class="row">
				<div class="col-md-6">
                                    <p>Password</p>
                                    <?= $form->field($oUserForm, 'password')->passwordInput()->label(false); ?>
				</div>
				<div class="col-md-6">
                                    <p>Re-Password</p>
                                    <?= $form->field($oUserForm, 're_password')->passwordInput()->label(false); ?>
				</div>
                            </div>
                            <?= Html::submitButton('Send', ['id' => 'btn-subsc', 'class' => 'btn' , 'name' => 'submit-subsc' ,   'data-error'=>'Oops!, Something is wrong', 'data-success'=>'Success, message sent']) ?>
                        <?php ActiveForm::end(); ?>
		</div>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->