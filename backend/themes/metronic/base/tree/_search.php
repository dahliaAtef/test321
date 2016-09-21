<?php

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\Tree */
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

    <?= $form->field($model, 'root') ?>

    <?= $form->field($model, 'lft') ?>

    <?= $form->field($model, 'rgt') ?>

    <?= $form->field($model, 'lvl') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'icon_type') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'selected') ?>

    <?php // echo $form->field($model, 'disabled') ?>

    <?php // echo $form->field($model, 'readonly') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'collapsed') ?>

    <?php // echo $form->field($model, 'movable_u') ?>

    <?php // echo $form->field($model, 'movable_d') ?>

    <?php // echo $form->field($model, 'movable_l') ?>

    <?php // echo $form->field($model, 'movable_r') ?>

    <?php // echo $form->field($model, 'removable') ?>

    <?php // echo $form->field($model, 'removable_all') ?>

    <?php // echo $form->field($model, 'created') ?>

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