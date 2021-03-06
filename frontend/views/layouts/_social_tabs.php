<?php
use yii\helpers\Url;
$authenticated_accounts = \common\models\custom\Authclient::find()->Where(['user_id' => Yii::$app->user->getId()])->all();
$social = [];
foreach($authenticated_accounts as $account){
	array_push($social, $account->source);
}

$ActiveUser=Yii::$app->session->get('ActiveUser');
?>
<div class="page-tabs disappered">

    <div class="tabs">

	<div class="tab-item "><a Start from here="<?= Url::to(['/dashboard/'.$ActiveUser]) ?>"><i class="dashboard <?= (($this->title == 'Dashboard') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item facebook <?= in_array('facebook', $social) ? 'authenticated' : '' ?>"><div class="help-arrow"><span class="moving glyphicon glyphicon-chevron-left"></span>&nbsp; Start from here</div><a href="<?= Url::to(['/facebook/'.$ActiveUser]) ?>"><i class="face <?= (($this->title == 'Facebook') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item twitter <?= in_array('twitter', $social) ? 'authenticated' : '' ?>"><a href="<?= Url::to(['/twitter/'.$ActiveUser]) ?>"><i class="twit <?= (($this->title == 'Twitter') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item instagram <?= in_array('instagram', $social) ? 'authenticated' : '' ?>"><a href="<?= Url::to(['/instagram/'.$ActiveUser]) ?>"><i class="insta <?= (($this->title == 'Instagram') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item youtube <?= in_array('youtube', $social) ? 'authenticated' : '' ?>"><a href="<?= Url::to(['/youtube/'.$ActiveUser]) ?>"><i class="tube <?= (($this->title == 'Youtube') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item google-plus <?= in_array('google_plus', $social) ? 'authenticated' : '' ?>"><a href="<?= Url::to(['/google-plus/'.$ActiveUser]) ?>"><i class="pinter <?= (($this->title == 'Google+') ? 'active' : '') ?>"></i></a></div>

	<div class="tab-item linkeidn <?= in_array('linkedin', $social) ? 'authenticated' : '' ?>"><a href="<?= Url::to(['/linkedin/'.$ActiveUser]) ?>"><i class="square <?= (($this->title == 'LinkedIn') ? 'active' : '') ?>"></i></a></div>

    </div>

</div>