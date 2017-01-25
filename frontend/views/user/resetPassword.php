<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Reset password';
?>

<div class="page-content outSide card">
    <div class="container content">

        <div class="inner-page">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="subsc-title">Reset password</div>
                        <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'class' => 'reset-pass-form']); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Please enter your new password:</p>
                                    <?= $form->field($oResetPasswordForm, 'password')->passwordInput(['placeholder'=>'Password ... '])->label(false) ?>
                                </div>

                            </div>
                        <?= Html::submitButton('Save', ['id' => 'btn-reset-pass', 'class' => 'btn' , 'name' => 'submit-reset-password']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
        </div>

    </div>
</div>
<!-- page content -->