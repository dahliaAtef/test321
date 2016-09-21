<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content ="width=device-width, initial-scale=1" />
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <style>
            @font-face {
                font-family: fontNexaLight;
                src: url(<?= Url::to('@frontThemeUrl/html/mail/themes/101/fonts/Nexa-Light.otf', true) ?>);
            }
            @font-face {
                font-family: fontNexaBold;
                src: url(<?= Url::to('@frontThemeUrl/html/mail/themes/101/fonts/Nexa-Bold.otf', true) ?>);
            }
            body {margin:0;background-color:#f2f1f1;font-family:"fontNexaLight"}
            img {border-width:0}
            #header {}
            #header .logo {margin-top:48px;text-align:center}
            #header .logo a {display:inline-block}
            #header .logo img {display:inline-block;vertical-align:top}
            .message {margin-top:48px;text-align:center}
            .message .title {}
            .message .title h1 {margin:0;line-height:32px;font-family:"fontNexaBold";font-size:26px}
            .message .title h2 {margin:0;line-height:26px;font-family:"fontNexaBold";font-size:20px}
            .message .content {margin-top:32px}
            .message .content p {margin:0;line-height:24px}
            .message .option {margin-top:48px}
            .message .option a {display:block;margin:0 auto;border-bottom:2px solid #be1013;width:40%;line-height:32px;background-color:#ed2024;text-decoration:none;font-size:16px;color:#fff}
            #footer {margin:32px auto 0;border-top:1px solid #ed2024;width:60%}
            #footer .socialLinks {margin-top:32px}
            #footer .socialLinks ul {display:block;margin:0;padding:0;list-style:none;text-align:center}
            #footer .socialLinks li {display:inline-block;margin:0 4px;border-radius:50%;width:24px;height:24px;line-height:24px;background-color:#ed2024;vertical-align:top}
            #footer .socialLinks a {display:block;font-size:18px;color:#f2f1f1}
            #footer .socialLinks .fa {vertical-align:middle}
            #footer .copyrights {margin:16px 0;text-align:center;font-size:10px;color:#000}
        </style>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="header">
            <div class="logo">
                <a href="#"><img src="<?= Url::to("@frontThemeUrl/html/mail/content/images/logo.png", true) ?>" alt="TSS" /></a>
            </div>
        </div>
        <?= $content ?>
        <div id="footer">
            <div class="socialLinks">
                <ul>
                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                </ul>
            </div>
            <div class="copyrights">
                <span><?= Yii::t('app', '&copy; 2015 TSS, All Rights Reserved') ?></span>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
