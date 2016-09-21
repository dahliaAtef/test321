<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Hello');
?>

<div class="page-content">
    <div class="container">
	<div class="inner-page">
            <div class="row vdivide">
		<div class="col-md-5">
                    <div class="logo-home">
                        <a href="<?= Url::to(['/']) ?>"><img src="<?= (Url::to('@frontThemeUrl').'/images/logo-home.png') ?>"></a>
                    </div>
		</div>	
                <div class="col-md-7">
                    <div class="about-hype">
			<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. sometimes on purpose (injected humour and the like).</p>
			<div class="get-start btn"><a href="<?= Url::to(['subscribe']) ?>">Get Started</a></div>
                    </div>
		</div>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->
