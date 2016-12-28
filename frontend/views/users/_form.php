<?php

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BaseUser */
/* @var $form digi\metronic\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-body">
    <h3 class="form-section">Note:  <small>fields marked with asterisk (*) are required.</small></h3>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $model->isNewRecord ? $form->field($model, 'password')->passwordInput() : null; ?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatusList()); ?>

</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn default']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
