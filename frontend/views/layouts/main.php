<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>
<?php
$action_id = Yii::$app->controller->action->id;
if(($action_id) == 'home'){    
	$headerC = '';    
	$footerC = '';
}else if(($action_id == 'subscribe') || ($action_id == 'contact-us')){    
	$headerC = 'outSide';    
	$footerC = 'outSide';
}else if(($action_id) == (('dashboard') || ('facebook') || ('twitter') || ('youtube') || ('google-plus') || ('foursquare') || ('instagram') || ('support'))){    
	$headerC = (($action_id != 'dashboard') ? ('inside '.$action_id) : 'inside');    
	$footerC = 'inside';
}
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">  
	<head>    
		<title><?= $this->title ?> | Hype</title>        
		<?= Html::csrfMetaTags() ?>       
		<meta charset="<?= Yii::$app->charset ?>" />    
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">    
		<link rel="icon" href="<?= Url::to('@frontThemeUrl') ?>/images/favicon.ico" />
		
		<?php $this->head() ?>
		<?php include_once 'analyticstracking.php'; ?>
	</head>  
	<body class="<?= ($action_id != 'home') ? 'white-bg' : '' ?>">    
	
			<?php if($action_id == 'home'){ ?>
				<div id="load">

					<div id="loadx">

						<img src="<?= Url::to('@frontThemeUrl') ?>/images/logoLoader.png" alt="">

					</div>

				</div>

				<div style ="display:none;">

					   <img class="lable" src="<?= Url::to('@frontThemeUrl') ?>/images/food/inner/inside-bg.jpg">

				</div>
			<?php } ?>    
		<div id="page-wrap">
			<!-- BEGIN FLASH MSG -->            
				<?php include_once 'flashMsg.php'; ?>        
			<!-- END FLASH MSG -->        
			<!-- BEGIN HEADER -->

            <?php
			//($_POST['value'] == 5) ? (include_once 'header_mobile.php') : ((Yii::$app->user->isGuest) ? include_once 'header_guest.php' :  include_once 'header_not_guest.php');
            (Yii::$app->user->isGuest) ? include_once 'header_guest.php' :  include_once 'header_not_guest.php';
            ?>

        <!-- END HEADER -->        
			<!-- BEGIN CONTAINER -->            
				<?php echo $content; ?>
			<!-- END CONTAINER -->		
                        <?php
                        (!Yii::$app->user->isGuest && (Yii::$app->controller->action->id != 'support') && (Yii::$app->controller->action->id != 'change-password')) ? include_once '_social_tabs.php' : '';
                        ?>
			<!-- BEGIN FOOTER -->            
				<?php include_once 'footer.php'; ?>        
			<!-- END FOOTER -->		    
		</div>    
	<?php $this->endBody() ?>

	<?php if($action_id == 'home'){ ?>
		<script src="<?= Url::to('@frontThemeUrl') ?>/js/loader.js"></script>
	<?php } ?>
	</body>
</html>
<?php $this->endPage() ?>