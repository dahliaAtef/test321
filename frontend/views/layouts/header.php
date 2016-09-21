<?php
use yii\helpers\Url;

$action_id = Yii::$app->controller->action->id;

if(($action_id == 'subscribe') || ($action_id == 'contact-us')){
    $logo = Url::to('@frontThemeUrl').'/images/logo-outside.png';
}else{
    $logo = Url::to('@frontThemeUrl').'/images/logo.png';
}
?>
<header class="<?= $headerC ?>">
    <div class="container">
	<div class="inner-header">
            <div class="logo"><a href="<?= Url::to(['/']) ?>"><img src="<?= $logo ?>"></a></div>
            <nav class="nav-menu">
		<ul class="menu-list">
                    <li><a class="<?= ($action_id == 'home') ? 'active' : '' ?>" href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li class="not-inside"><a class="<?= ($action_id == 'subscribe') ? 'active' : '' ?>" href="<?= Url::to(['subscribe']) ?>">Subscribe</a></li>
                    <li class="not-outSide"><a class="<?= ($action_id == 'support') ? 'active' : '' ?>" href="<?= Url::to(['support']) ?>">Support</a></li>
                    <li class="not-inside"><a class="<?= ($action_id == 'contact-us') ? 'active' : '' ?>" href="<?= Url::to(['contact-us']) ?>">Contact Us</a></li>
                    <li class="sub-menu not-inside">
			<a href="#">Login</a>
			<ul>
                            <form>
				<p>User Name<p>
				<input type="text" name="name"/>
				<p>Password<p>
				<input type="text" name="password"/>
				<input type="submit" class="btn" value="login"/>
                            </form>
			</ul>
                    </li>
                    <li class="sub-menu setting">
			<a href="#" class="acc-setting glyphicon glyphicon-cog"></a>
			<ul>
                            <li><a href="#"><i class="PR8 glyphicon glyphicon-edit"></i>Change Password</a></li>
                            <li><a href="#"><i class="PR8 glyphicon glyphicon-log-out"></i>Logout</a></li>
			</ul>
                    </li>
		</ul>
            </nav>
        </div>
    </div>
</header>