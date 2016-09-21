<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Facebook';
$session = Yii::$app->session;
?>


<div class="page-content inside">
    <div class="container">
	<div class="inner-page">
            <div style="display: <?= ($session->has('facebook'))? "none" : "block" ?>;" class="authent facebook btn ">
		<a class="auth-link facebook" href="/site/auth?authclient=facebook" data-popup-width="860" data-popup-height="480"><span>Authenticate Your Account</span></a>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->
<div class="page-tabs">
    <div class="tabs">
	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face active"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>
    </div>
</div>
<!-- page tabs -->