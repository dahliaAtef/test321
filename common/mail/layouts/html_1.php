<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Hype</title>
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= Url::to('@frontThemeUrl/css/bootstrap.min.css', true) ?>">
	<link rel="stylesheet" type="text/css" href="<?= Url::to('@frontThemeUrl/css/email.css', true) ?>">
        <?php $this->head() ?>
</head>
    <body>
        <?php $this->beginBody() ?>
        <div id="page-wrap">

		<!-- header not-guest-->
		<div class="page-content">
			<div class="container">
				<div class="inner-page">
					<div class="logo-home">
						<img src="<?= Url::to('@frontThemeUrl/images/logo-home.png', true) ?>">
					</div>
					<div class="about-hype">
                                            <p class="welcome">WELCOME TO HYPE</p>
                                            <?= $content ?>
					</div>
				</div>
				<!-- inner page -->
			</div>
		</div>
		<!-- page content -->

		<footer>
			<div class="container">
				<div class="inner-footer">
					<div class="copyRights"><span><a target="_blank" href="//digitreeinc.com">&copy; Hype 2016 powered By Digitree.</a></span></div>
					<div class="social-links clearfix">
						<span>Follow us </span>
						<div class="social-link youTube"></div>
						<div class="social-link twit"></div>
						<div class="social-link inst"></div>
						<div class="social-link fb"></div>
					</div>
				</div>
			</div>
		</footer>
	</div>
        <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
