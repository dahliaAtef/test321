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
			<p style="line-height:32px">Social media analytics are becoming more and more crucial for business. The importance to measure all social media metrics increases and major social media platforms continues to make changes on the way you profiling audiences and so it increases the importance to measure all social media activities which is critical to your success.
Gain deeper insights with Hype by tracking every like, share, comment and individuals across all major brand profiles.</p>
			<div class="get-start btn"><a href="<?= Url::to(['subscribe']) ?>">Get Started</a></div>
                    </div>
		</div>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->
