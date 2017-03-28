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
      <div class="row">
            <div class="col-md-4 col-md-offset-4" style="padding-top:10vh">
                
                <?php
                    $pages = [];
                    foreach($user_pages["data"] as $user_page){
                        $pages[$user_page['id']] = $user_page["name"];
                    }
                    if(!empty($pages)){
                    $form = ActiveForm::begin(['id' => 'userPagehsForm']);
                ?>
                <?= $form->field($oUserPagesForm, 'id', ['labelOptions' => [ 'class' => 'custmLabel' ]])->dropDownList($pages)->label('<p class="grayTitle">Please Select the page you need to manage</p>') ?>
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['id' => 'submit_fb_pages','class' => 'btn extraMargin', 'name' => 'submit']) ?>
                <?php
                ActiveForm::end();
                    }else{
                        echo "Sorry, it looks like you aren't managing any facebook pages.";
                    }?>
            </div>
        </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->