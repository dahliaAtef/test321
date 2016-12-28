<?php
use yii\helpers\Url;

$flashMessages = Yii::$app->session->getAllFlashes();
if ( $flashMessages ) {
?>

<div class="flashMessage active">
<?php
    foreach ($flashMessages as $message) {
?>
	<span><?= $message; ?></span>
  <div class="closBtn"><img src="<?= Url::to(['@frontThemeUrl']) ?>/images/cancel.png"></div>
<?php        
    }
?>
</div>
<?php
}
?>