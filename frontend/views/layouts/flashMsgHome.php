<?php
use yii\helpers\Url;

$flashMessages = Yii::$app->session->getAllFlashes();
if ( $flashMessages ) {
?>

<div class="flashMessage active">
<?php
    foreach ($flashMessages as $message) {
?> <span class="glyphicon glyphicon-info-sign"></span>
	<span><?= $message; ?></span>
  
<?php        
    }
?>
</div>
<?php
}
?>