<?php

use yii\helpers\Html;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\Content */
/* @var $form digi\metronic\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-body">
    <h3 class="form-section">Note:  <small>fields marked with asterisk (*) are required.</small></h3>

    <?= $form->field($model, 'type')->hiddenInput(['value' => $model::TYPE])->label(false); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= !$model->isNewRecord ? $form->field($model, 'slug')->textInput() : '' ?>
    
    <?= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    
    <?=
        $form->field($model, 'body')
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'standerd' //full,standerd,basic
        ])
    ?>
    <div class="parentFields">
        <h3 class="form-section">SEO:  <small>Meta Tags</small></h3>

        <?=
        digi\metaTags\MetaTags::widget([
            'model' => $model,
            'form' => $form,
            'multiLanguage' => false,
        ])
        ?>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn green']) ?>
<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn default']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
