<?php

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $oChangePasswordForm common\models\BaseUser */
/* @var $form digi\metronic\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
            'enableAjaxValidation' => true,
            'options' => ['autocomplete' => 'off'],
        ]);
?>

<div class="form-body">
    <h3 class="form-section">Note:  <small>fields marked with asterisk (*) are required.</small></h3>

<?= $form->field($oChangePasswordForm, 'old_password')->passwordInput(); ?>
<?= $form->field($oChangePasswordForm, 'new_password')->passwordInput(); ?>

</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
<?= Html::submitButton('Change', ['class' => 'btn green']) ?>
<?= Html::resetButton('Reset', ['class' => 'btn default']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
