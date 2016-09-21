<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \yii2mod\comments\models\CommentModel */
/* @var $encryptedEntity string */
?>

<?php
ActiveForm::begin([
    'options' => [
        'id' => 'comment-form',
        'class' => 'comment-item row'
    ],
    'action' => Url::to(['/comment/default/create', 'entity' => $encryptedEntity]),
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validateOnChange' => false,
    'validateOnBlur' => false
]);

Html::activeHiddenInput($commentModel, 'parentId');
?>

    <!--<span class="date-time">2 hours ago</span>-->
<div class="large-1 medium-1 small-12 columns avatar-cont">
    <img src="<?= Yii::$app->user->identity->getFeaturedImgUrl('default_avatar') ?>" alt="">
</div>
<div class="large-11 medium-11 small-12 columns">
    <h3><?= Yii::$app->user->identity->getName() ?></h3>
    <div class="comment-reply">
        <?= Html::activeTextarea($commentModel, 'content', ['placeholder' => Yii::t('app', 'Enter your comment here...'), 'rows' => 3]); ?>
        <?= Html::error($commentModel, 'content', ['tag' => 'small', 'class' => 'error']); ?>
        <button type="submit" class="shop-now submit-btn"><?= Yii::t('app', 'Post') ?></button>
    </div>
</div>
<?php ActiveForm::end(); ?>