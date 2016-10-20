<?php

use yii\helpers\Url;
use digi\authclient\clients\Youtube;

$this->title = 'Youtube';
?>
<div class="page-content inside youtube">
    <div class="container">
	<div class="inner-page">
            <div class="authent youtube btn ">
                <a class="auth-link youtube" href="/site/auth?authclient=youtube" data-popup-width="860" data-popup-height="480"><span>Authenticate Your Account</span></a>
            </div>
        <?=   Yii::$app->getSession()->getFlash('error'); ?>

    </div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->