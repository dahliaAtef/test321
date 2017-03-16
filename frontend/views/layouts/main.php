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
  <meta name="keywords" content="Social media analytics tool, free analytics tool, free social media analytics tool, Campaign report, Campaign kpi, social media performance, social media engagement, social media strategy, social media kpi, social media report, social media custom report">
  <meta name="description" content="Hype Insights is a social media analytics tool that helps you measure, track and get valuable insights about all your social media channels in one place. Hype Insights dashboard is designed to give you easy overview of your social media performance KPI's in an easy way. boost your social media strategy with real-time updated data about your social media engagement, content, performance, community growth, and much more. Automated, visualized, and easy to export social media analytics reports with the ability to customize your report to save your time and effort. Hype insights provides the best social media analytics solutions that perfectly fit your needs whether you're a brand, an agency or a freelancer, you will find what suits you.">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">    
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
                        (!Yii::$app->user->isGuest && (Yii::$app->controller->action->id != 'support') && (Yii::$app->controller->id != 'competitors') && (Yii::$app->controller->action->id != 'change-password')) ? include_once '_social_tabs.php' : '';
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