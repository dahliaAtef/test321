<?php
/* @var $this \yii\web\View */
/* @var $comments array */
/* @var $commentModel \yii2mod\comments\models\CommentModel */
/* @var $maxLevel null|integer coments max level */
/* @var $encryptedEntity string */
?>

<div class="comments row">

    <div class="comments-title row">
        <div class="arrow-up"></div>
        <div class="large-2 medium-2 small-12 columns">
            <h3><?= Yii::t('app', 'Comments') ?></h3>
        </div>
        <div class="large-3 medium-3 small-12 columns">
            <div class="comments-meta">
                <?= count($comments) ?> <?= Yii::t('app', 'Comment(s)') ?>
            </div>
        </div>
    </div>

    <?php if (!\Yii::$app->user->isGuest) { ?>
        <?php echo $this->render('_form', ['commentModel' => $commentModel, 'encryptedEntity' => $encryptedEntity]); ?>
    <?php } ?>

    <?php echo $this->render('_list', ['comments' => $comments, 'maxLevel' => $maxLevel]) ?>

</div>

