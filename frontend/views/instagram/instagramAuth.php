<?php

use yii\helpers\Url;
$this->title = 'Instagram';

?>
<div class="page-content inside instagram">
    <div class="container">
	<div class="inner-page">
            <div class="authent instagram btn ">
                <a class="auth-link instagram" href="/site/auth?authclient=instagram" data-popup-width="860" data-popup-height="480"><span>Authenticate Your Account</span></a>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
		<!-- page content -->
		<div class="page-tabs">
			<div class="tabs">
				<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard"></i></a></div>
				<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face"></i></a></div>
				<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>
				<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta active"></i></a></div>
				<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>
			</div>
		</div>