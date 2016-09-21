<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\custom\search\Insights */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insights-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'model_id') ?>

    <?= $form->field($model, 'followers') ?>

    <?= $form->field($model, 'follows') ?>

    <?= $form->field($model, 'number_of_posted_media') ?>

    <?php // echo $form->field($model, 'total_likes') ?>

    <?php // echo $form->field($model, 'total_comments') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
