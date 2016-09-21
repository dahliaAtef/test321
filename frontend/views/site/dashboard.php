<?php



use yii\helpers\Url;

use yii\authclient\widgets\AuthChoice;

use digi\authclient\clients\Facebook;



$this->title = 'Dashboard';



?>

<div class="page-content inside dashboard">

    <div class="container">

	<div class="inner-page">

        <div class="row">
            <div class="col-md-6">
                <h2 class="internal-title sec-title">Account Existence</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            <h3 class="internal-title noneBG ">Following Overview</h3>
	            <div class="internal-content">
	            	pic chart
	            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            <h3 class="internal-title dashboard ">Following Overview</h3>
	            <div class="internal-content">
	            	pic chart
	            </div>
            </div>
        </div>
        
        <!-- sperated line -->
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="sprated-line">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2 class="internal-title sec-title">Account Growth</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            <h3 class="internal-title noneBG ">Following Overview</h3>
	            <div class="internal-content">
	            	pic chart
	            </div>
            </div>
        </div>

        <!-- sperated line -->
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="sprated-line">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2 class="internal-title sec-title">Account Overview KPI</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            <h3 class="internal-title noneBG ">Following Overview</h3>
	            <div class="internal-content">
	            	pic chart
	            </div>
            </div>
        </div>

        
        <!-- sperated line -->
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="sprated-line">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2 class="internal-title sec-title">Account Reach Cross Channels</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            <h3 class="internal-title noneBG ">Following Overview</h3>
	            <div class="internal-content">
	            	pic chart
	            </div>
            </div>
        </div>

        
        <!-- sperated line -->
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="sprated-line">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2 class="internal-title sec-title">Account Engagment</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            <h3 class="internal-title noneBG ">Following Overview</h3>
	            <div class="internal-content">
	            	pic chart
	            </div>
            </div>
        </div>

	</div>

	<!-- inner page -->

    </div>

</div>

<!-- page content -->

<div class="page-tabs">

    <div class="tabs">

	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard active"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>

	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>

    </div>

</div>