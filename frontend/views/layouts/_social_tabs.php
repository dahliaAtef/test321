<?php
use yii\helpers\Url;

?>
<div class="page-tabs disappered">

    <div class="tabs">

	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard <?= (($this->title == 'Dashboard') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face <?= (($this->title == 'Facebook') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit <?= (($this->title == 'Twitter') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta <?= (($this->title == 'Instagram') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube <?= (($this->title == 'Youtube') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter <?= (($this->title == 'Google+') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square <?= (($this->title == 'LinkedIn') ? 'active' : '') ?>"></i></a></div>

    </div>

</div>