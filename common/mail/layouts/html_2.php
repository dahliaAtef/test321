<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Hype</title>
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		
			@font-face {
			  font-family:'NeoSansStd';
			  font-style:normal;
			  src:url(../shared/themes/frontend/fonts/NeoSansStd-Regular.ttf) format('truetype'),
			  url(http://www.adigitree.org/shared/themes/frontend/fonts/NeoSansStd-Regular.woff2) format('woff2'),
			  url(http://www.adigitree.org/shared/themes/frontend/fonts/NeoSansStd-Regular.woff) format('woff'),
			  url(http://www.adigitree.org/shared/themes/frontend/fonts/neosansstd-regular.otf) format('truetype')
			}

			/*------- 
			general style ------*/
			* { 
				margin: 0; 
				padding: 0; 
			}
			:focus {outline: 0 !important;}
			ul {padding: 0 ;margin: 0}
			.bTn {background: #de1271;color: #fff}
			  .bTn a{text-decoration:none;color: #fff;padding: 6px 12px;display: inline-block;}
			  .bTn:hover ,.bTn a:hover , * a:hover{color: #d0d0d0!important;}
			  .PR8 {padding-right: 8px}
			html{height: 100%}
			body{position:relative;font-family:'NeoSansStd';color: #272727;overflow-x:hidden;height:100%;background: url("http://www.adigitree.org/shared/themes/frontend/images/home-bg.jpg") no-repeat center center fixed;
				    -webkit-background-size: cover;
				    -moz-background-size: cover;
				    -o-background-size: cover;
				    background-size: cover;}
			#page-wrap {min-height:100%;position:absolute;z-index:2;width: 100%;height: 100%;top:0!important;left: 0}

			footer {padding: 10px 0;width:100%;position:absolute;bottom:0;left:0;}
				.inner-footer {padding: 0;margin: 0;line-height:38px;color:#fff;-ms-box-orient: horizontal;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -moz-flex;display: -webkit-flex;display: flex;-webkit-justify-content: space-around;justify-content: space-around;-webkit-flex-flow: row wrap;flex-flow: row wrap;-webkit-align-items: stretch;align-items: stretch;}
				footer .copyRights {flex: 1;-webkit-flex: 1;-ms-flex: 1;-webkit-box-flex: 1;-moz-box-flex: 1;}
					footer .copyRights a{color: #5d5656;font-size: 14px;}
				footer .social-links  {flex: 1;-webkit-flex: 1;-ms-flex: 1;-webkit-box-flex: 1;-moz-box-flex: 1;text-align: right;}
					footer .social-links span{padding-right: 20px;font-size: 15px;}
					footer .social-links div {float: right;margin:6px 10px;background: url("http://www.adigitree.org/shared/themes/frontend/images/social.png");cursor: pointer;}
					footer .social-links div:first-child {margin-right:0px}
						footer .social-links div.fb {width:14px;height:26px;background-position:0 0;}
						footer .social-links div.inst {width:22px;height:24px;background-position:22px 0;}
						footer .social-links div.twit {width:26px;height:24px;background-position:77px 0;}
						footer .social-links div.youTube {width:26px;height:26px;background-position:50px 0;}
			.page-content {padding:30px 0 60px;}
				.page-depth {border-bottom: 1px solid;padding-bottom: 14px;}
					.page-depth ul{margin: 0;padding: 0}
					.page-depth li {display: inline-block;margin-left: 1px;}
						.page-depth li a {display: inline-block;text-decoration: none;transition: all 0.2s ease-in-out;-moz-transition: all 0.2s ease-in-out;-webkit-transition: all 0.2s ease-in-out;-o-transition: all 0.2s ease-in-out;font-size: 13px;line-height:14px;color: #222222;}
						.page-depth li a:hover {color: #666666;}
						.page-depth li:before {content: '';width:11px;height:12px;background:url(http://www.adigitree.org/shared/themes/frontend/images/icons.png)11px 0 ;float:left;margin:2px 3px 0 0;}
						.page-depth li:first-child:before {content: '';width:14px;background-position: 0 0;margin:1px 3px 0 0}
				.inner-page {padding: 40px 0 30px}
					.inner-page p {font-size: 16px}
				.inner-page .side-bg-img {position: absolute;z-index:-1;top: 240px;right: -80px;transition: all 0.2s ease-in-out;-moz-transition: all 0.2s ease-in-out;-webkit-transition: all 0.2s ease-in-out;-o-transition: all 0.2s ease-in-out}
					#page-wrap.consumer .inner-page .side-bg-img {right:0px}

				
				.logo-home {margin:48px 0;text-align: center;}
				  .logo-home img{width: 220px}
				.about-hype {text-align: center}
				  .about-hype p {color: #fff;font-weight:bold;}
				  .about-hype .welcome{color: #DD1371; font-size: 40px;line-height: 40px}
				  .about-hype .thanks{color: #8c767f; font-size: 28px;line-height: 44px;margin-bottom: 0;}
				  .about-hype .stutas{color: #8c767f;font-size: 18px;line-height: 20px;font-weight: normal;margin-bottom: 30px}
				.about-hype .get-start{font-size: 20px;width: 150px ;margin: 10px auto;display: block;}

			/*------- media quiries ------*/
			@media all and (max-width: 1182px) {
			  .logo img {width: 160px}
			}

			@media all and (max-width: 992px) {
			  .logo-home{text-align: center;}

			}
			@media all and (max-width: 974px) { 
			}
			@media all and (max-width: 840px) {
				.logo-home {text-align: center;width: 80px;margin: 20px auto}
				.logo-home img{width: 80px}
			}

			@media all and (max-width: 768px) {
			  .home-logo {width: 120px;top: 12px}
			  .page-depth {display: none}
			.inner-page{padding-top: 20px}
			}

			@media all and (max-width: 498px) {
			  footer {padding: 0}
			  footer .copyRights {text-align:center;flex: 1 100%;-webkit-flex: 1 100%;-ms-flex: 1 100%;-webkit-box-flex: 1 100%;-moz-box-flex: 1 100%;}
			  footer .social-links{text-align:center;flex: 1 100%;-webkit-flex: 1 100%;-ms-flex: 1 100%;-webkit-box-flex: 1 100%;-moz-box-flex: 1 100%;}
				footer .social-links span {display:none;}
				footer .social-links div {float: none;display: inline-block;vertical-align: middle;}
			}





			.field{
			  position: relative;
			}
			.field i{
			  position: absolute;
			  right: 10px;
			  top: 34px;
			  font-size: 18px;
			  display: none;
			}
			form{
			}
			input, button, textarea{
			  position: relative;
			  -webkit-apprearance:none;
			  -moz-apprearance:none;
			  apprearance:none;
			  margin: 0;
			  padding:10px;
			  font-size: 14px;
			  margin-bottom: 10px;
			  width: 100%;
			  border:1px solid #C7C7C7;
			  background-color: #fafafa;
			  -webkit-transition:background-color .3s, border-color .4s;
			  -moz-transition:background-color .3s, border-color .4s;
			  -o-transition:background-color .3s, border-color .4s;
			  transition:background-color .3s, border-color .4s;
			}
			textarea{
			  height: 100px;
			  resize:none;
			}

			input:focus, textarea:focus, input:hover, textarea:hover{
			  outline:none;
			  border-color: #777;
			}
			button{/*color: #fff;font-size: 24px;font-weight: bold;line-height: 26px;height: auto;padding: 10px;display: block;margin: 10px auto;*/
			  display: block;
			  border: none;
			  background-color: #666;
			  color: #fff;
			  position: relative;
			  height: 50px;
			  line-height: 50px;
			  padding: 0;
			  -webkit-transition: all 0.3s;
			  -moz-transition: all 0.3s;
			  transition: all 0.3s;
			  -webkit-transform-style: preserve-3d;
			  -moz-transform-style: preserve-3d;
			  transform-style: preserve-3d;
			  cursor: pointer;
			}
			button:hover{
			  background-color: #555;
			}
			button:before,
			button:after{
			  position: absolute;
			  width: 100%;
			  height: 100%;
			  left: 0;
			  line-height: 50px;
			  cursor: default;
			}
			#bTn {background: #de1271;color: #fff;border-radius:6px;font-size: 22px;font-weight: bold;width:320px;margin: 10px auto;}
			  #bTn a{text-decoration:none;color: #fff;padding: 6px 12px;display: inline-block;}
			  #bTn:hover ,#bTn a:hover {color: #d0d0d0!important;}

	</style>
        <?php $this->head() ?>
</head>
    <body>
    	<!-- <div style="position:absolute;width:100%;height:100%;top:0;left:0;z-index:1">
    		<img src="http://www.adigitree.org/shared/themes/frontend/images/home-bg.jpg" width="100%">
    	</div> -->
        <?php $this->beginBody() ?>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <div id="page-wrap">

		<!-- header not-guest-->
		<div class="page-content">
			<div class="container">
				<div class="inner-page">
					<div class="logo-home">
						<img src="<?= Url::to('@frontThemeUrl/images/home-bg-email.jpg', true) ?>" style="width:100%">
					</div>
					<div class="about-hype">
                        <p class="welcome">WELCOME TO HYPE</p>
                        <?= $content ?>
					</div>
				</div>
				<!-- inner page -->
			</div>
		</div>
		<!-- page content -->

		<footer>
			<div class="container">
				<div class="inner-footer">
					<div class="copyRights" style="text-align:center"><span><a target="_blank" href="//digitreeinc.com">&copy; Hype 2016 powered By Digitree.</a></span></div>
					<!-- <div class="social-links clearfix">
						<span>Follow us </span>
						<div class="social-link youTube"></div>
						<div class="social-link twit"></div>
						<div class="social-link inst"></div>
						<div class="social-link fb"></div>
					</div> -->
				</div>
			</div>
		</footer>
	</div>
</table>
        <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
