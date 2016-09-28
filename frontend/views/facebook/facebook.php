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