<?php

use yii\helpers\Html;
use yii\helpers\Url;
use digi\metronic\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

//$this->title = 'Login';
?>


<!-- BEGIN LOGIN FORM -->

<?php $form = ActiveForm::begin(['id' => 'login-form', 'layout' => 'default']); ?>

<!-- background image  -->
<!--<div class="digitreeBG">
    <img src="<?/*= Url::to(['/images/login-desktop.png']);*/?>" />
</div>-->
<!-- background image  -->


<div class="form-body">
    <!--<form class="login-form" method="post">-->

    <h3 class="form-title">GAWAD - Backyard</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>
            Enter any username and password. </span>
    </div>

    <?php echo $form->field($model, 'username', ['inputTemplate' => "<div class=\"input-icon\"><i class=\"fa fa-user\"></i>\n{input}\n</div>"])->textInput(['placeholder' => 'Username'])->label(false); ?>
    <?php echo $form->field($model, 'password', ['inputTemplate' => "<div class=\"input-icon\"><i class=\"fa fa-lock\"></i>\n{input}\n</div>"])->passwordInput(['placeholder' => 'Password'])->label(false); ?>

    <div class="form-actions">
        <?php echo $form->field($model, 'rememberMe', ['options' => ['class' =>'form-group checkbox']])->checkbox() ?>
<!--        <label class="checkbox">
            <input type="checkbox" name="remember" value="1"/> Remember me 
        </label>-->
        <button type="submit" class="btn green pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
    <!--<div class="forget-password">
        <h4>Forgot your password ?</h4>
        <p>
            no worries, click <a href="javascript:;" id="forget-password"> here </a> to reset your password.
        </p>
    </div> -->
    <div class="create-account"></div>
</div>
<?php ActiveForm::end(); ?>
<!--</form>-->
<!-- END LOGIN FORM -->





<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="index.html" method="post">
    <h3>Forget Password ?</h3>
    <p>
        Enter your e-mail address below to reset your password.
    </p>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
        </div>
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn">
            <i class="m-icon-swapleft"></i> Back </button>
        <button type="submit" class="btn blue pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->