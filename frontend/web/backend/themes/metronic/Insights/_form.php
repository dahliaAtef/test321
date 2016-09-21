<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\custom\Insights */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insights-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'followers')->textInput() ?>

    <?= $form->field($model, 'follows')->textInput() ?>

    <?= $form->field($model, 'number_of_posted_media')->textInput() ?>

    <?= $form->field($model, 'total_likes')->textInput() ?>

    <?= $form->field($model, 'total_comments')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
