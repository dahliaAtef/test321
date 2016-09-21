<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form digi\metronic\widgets\ActiveForm */
?>

<?= "<?php " ?>$form = ActiveForm::begin([
'action' => ['index'],
'method' => 'get',
'options' => ['data-pjax' => true],
]); ?>

<div class="form-body">
    <h3 class="form-section">Advanced Search. <small></small></h3>

    <?php
    $count = 0;
    foreach ($generator->getColumnNames() as $attribute) {
        if (++$count < 6) {
            echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
        } else {
            echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
        }
    }
    ?>

</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
            <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<?= "<?php " ?>ActiveForm::end(); ?>