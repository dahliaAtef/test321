<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\custom\Model;

$this->title = 'Change Password';
?>
<div class="page-content inside dashboard">
    <div class="container">
	<div class="inner-page">
            <div class="row">
		<div class="col-md-6 col-md-offset-3">
                    <div class="subsc-title">Change Your Password</div>
                    <?php $form = ActiveForm::begin(['id' => 'change-password-form', 'class' => 'subsc-form']); ?>
			<div class="row">
                            <div class="col-md-12">
				<p>Old Password</p>
                                <?= $form->field($oChangePassword, 'old_password')->passwordInput()->label(false) ?>
                            </div>
                            <div class="col-md-12">
				<p>New Password</p>
                                <?= $form->field($oChangePassword, 'new_password')->passwordInput()->label(false) ?>
                            </div>
                            <div class="col-md-12">
				<p>Re-Password</p>
                                <?= $form->field($oChangePassword, 'password_repeat')->passwordInput()->label(false) ?>
                            </div>
			</div>
          	<?= Html::submitButton('Save', ['id' => 'btn-change-pass', 'class' => 'btn' , 'name' => 'submit-change-password']) ?>
                    <?php ActiveForm::end(); ?>
		</div>
            </div>
        </div>
    </div>
</div>
<!-- POP UP -->

