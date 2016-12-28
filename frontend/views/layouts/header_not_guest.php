<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\base\form\Login;

$oUserLoginForm = new Login();

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
                    <li><a class="<?= ($action_id != 'support') ? 'active' : '' ?>" href="<?= Url::to(['/dashboard']) ?>">Dashboard</a></li>
                    <li><a class="<?= ($action_id == 'support') ? 'active' : '' ?>" href="<?= Url::to(['/support']) ?>">Support</a></li>
                    <li class="sub-menu setting">
                        <a href="#" class="acc-setting glyphicon glyphicon-cog"></a>
                        <ul class="sub-menu-ul">
                            <li><a href="<?= Url::to(['/change-password']) ?>"><i class="PR8 glyphicon glyphicon-edit"></i>Change Password</a></li>
                            <li><a href="<?= Url::to(['/logout']) ?>"><i class="PR8 glyphicon glyphicon-log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- header guest -->