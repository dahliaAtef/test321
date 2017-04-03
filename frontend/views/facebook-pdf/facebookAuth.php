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
            <div style="display: <?= ($session->has('facebook'))? "block" : "block" ?>;" class="authent facebook btn ">
		<a class="auth-link facebook" href="/site/auth?authclient=facebook" data-popup-width="860" data-popup-height="480"><span>Authenticate Your Account</span></a>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->