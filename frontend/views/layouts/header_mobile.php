<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\base\form\Login;

$oUserLoginForm = new Login();

$action_id = Yii::$app->controller->action->id;

?>

<header class="<?= $headerC ?> mobile">
    <div class="container">
        <div class="inner-header">
            <div class="logo"><a href="<?= Url::to(['/']) ?>"><img src="<?= Url::to('@frontThemeUrl') ?>/images/logoMob.png"></a></div>
            <nav class="nav-menu">
                <ul class="menu-list">
                    <li><a class="<?= ($action_id == 'home') ? 'active' : '' ?>" href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li><a class="<?= ($action_id == 'subscribe') ? 'active' : '' ?>" href="<?= Url::to(['/subscribe']) ?>">Subscribe</a></li>
                    <li><a class="<?= ($action_id == 'contact-us') ? 'active' : '' ?>" href="<?= Url::to(['/contact-us']) ?>">Contact Us</a></li>
                    <li class="sub-menu">
                        <a href="#">Login</a>
                    </li>
                </ul>
            </nav>
            <div class="icon">
                <a href="javascript:void(0);" onclick="myFunction()" class="glyphicon glyphicon-menu-hamburger"></a>
            </div>
        </div>
    </div>
</header>
<!-- header guest-->