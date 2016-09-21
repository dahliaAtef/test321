<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="message">
    <div class="title">
        <h1><?= Yii::t('app', 'Hello') ?> <?= Html::encode($oUser->getName()) ?></h1>
        <!--<h2>Please Confirm Subscription</h2>-->
    </div>
    <div class="content">
        <p><?= Yii::t('app', 'Follow the link below to verify your account') ?></p>
    </div>
    <div class="option">
        <a href="<?= Url::to(['/user/verify', 'token' => $oUser->token], true) ?>" /><span><?= Yii::t('app', 'Verify Account') ?></span></a>
    </div>
</div>