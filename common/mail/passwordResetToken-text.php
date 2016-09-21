<?php

/* @var $this yii\web\View */
/* @var $oUser common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $oUser->token]);
?>
Hello <?= $oUser->getName() ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
