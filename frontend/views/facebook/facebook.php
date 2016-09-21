<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Facebook';
$session = Yii::$app->session;
?>


<div class="page-content inside">
    <div class="container">
	<div class="inner-page">
            <div>
                
                <?php
                    $pages = [];
                    foreach($user_pages["data"] as $user_page){
                        $pages[$user_page['id']] = $user_page["name"];
                    }
                    if(!empty($pages)){
                    $form = ActiveForm::begin(['id' => 'userPagesForm']);
                ?>
                <?= $form->field($oUserPagesForm, 'id')->dropDownList($pages)->label('Please Select the page you need to manage with Hype') ?>
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['id' => 'submit_contact', 'name' => 'submit']) ?>
                <?php
                ActiveForm::end();
                    }else{
                        echo "Sorry, it looks like you aren't managing any facebook pages.";
                    }?>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->
<div class="page-tabs">
    <div class="tabs">
	<div class="tab-item"><a href="<?= Url::to(['dashboard']) ?>"><i class="dashboard"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['facebook']) ?>"><i class="face active"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['twitter']) ?>"><i class="twit"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['instagram']) ?>"><i class="insta"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['youtube']) ?>"><i class="tube"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['google-plus']) ?>"><i class="pinter"></i></a></div>
	<div class="tab-item"><a href="<?= Url::to(['foursquare']) ?>"><i class="square"></i></a></div>
    </div>
</div>
<!-- page tabs -->