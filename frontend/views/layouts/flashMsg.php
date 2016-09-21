<?php
$flashMessages = Yii::$app->session->getAllFlashes();
if ( $flashMessages ) {
?>

<div class="flashMessage active">
    <div class="container">
<?php
    foreach ($flashMessages as $message) {
?>
	<div><?= $message; ?></div>
<?php        
    }
?>
    </div>
</div>
<?php
}
?>