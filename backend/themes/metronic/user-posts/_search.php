<?php

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\custom\search\UserPosts */
/* @var $form digi\metronic\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
'action' => ['index'],
'method' => 'get',
'options' => ['data-pjax' => true],
]); ?>

<div class="form-body">
    <h3 class="form-section">Advanced Search. <small></small></h3>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'page_model_id') ?>

    <?= $form->field($model, 'post_id') ?>

    <?= $form->field($model, 'creation_time') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>


</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>