<?php

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tree */
/* @var $form digi\metronic\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-body">
    <h3 class="form-section">Note:  <small>fields marked with asterisk (*) are required.</small></h3>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php if ($this->context->id == 'tree') { ?>
    
        <?= $form->field($model, 'root')->textInput() ?>

        <?= $form->field($model, 'lft')->textInput() ?>

        <?= $form->field($model, 'rgt')->textInput() ?>

        <?= $form->field($model, 'lvl')->textInput() ?>

        <?= $form->field($model, 'icon')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'icon_type')->textInput() ?>

        <?= $form->field($model, 'active')->textInput() ?>

        <?= $form->field($model, 'selected')->textInput() ?>

        <?= $form->field($model, 'disabled')->textInput() ?>

        <?= $form->field($model, 'readonly')->textInput() ?>

        <?= $form->field($model, 'visible')->textInput() ?>

        <?= $form->field($model, 'collapsed')->textInput() ?>

        <?= $form->field($model, 'movable_u')->textInput() ?>

        <?= $form->field($model, 'movable_d')->textInput() ?>

        <?= $form->field($model, 'movable_l')->textInput() ?>

        <?= $form->field($model, 'movable_r')->textInput() ?>

        <?= $form->field($model, 'removable')->textInput() ?>

        <?= $form->field($model, 'removable_all')->textInput() ?>
    <?php } ?>
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
