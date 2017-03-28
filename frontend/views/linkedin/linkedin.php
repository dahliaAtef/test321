<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'LinkedIn';
$session = Yii::$app->session;
//echo '<pre>'; var_dump($user_pages); echo '</pre>'; die;
?>


<div class="page-content inside">
   <div id="loadWh">
    <div id="loadx">
      <img src="http://adigitree.org/shared/themes/frontend/images/logoLoader.png" alt="">
    </div>
  </div><!-- loader -->
    <div class="container">
	<div class="inner-page">
            <div>
                
                <?php
                    $pages = [];
                    foreach($user_pages["values"] as $user_page){
                        $pages[$user_page['id']] = $user_page["name"];
                    }
                    if(!empty($pages)){
                    $form = ActiveForm::begin(['id' => 'userPagesForm']);
                ?>
                <?= $form->field($oUserPagesForm, 'id')->dropDownList($pages)->label('Please Select the page you need to manage with Hype') ?>
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['id' => 'submit_pages', 'name' => 'submit']) ?>
                <?php
                ActiveForm::end();
                    }else{
                        echo "Sorry, it looks like you aren't managing any LinkedIn pages.";
                    }?>
            </div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->