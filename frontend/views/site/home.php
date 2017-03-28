<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\base\form\Login;

$oUserLoginForm = new Login();

$action_id = Yii::$app->controller->action->id;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Hype insights</title>   
  <meta name="csrf-param" content="_csrf">
  <meta name="csrf-token" content="YXkuT2pxRENQF358Ly4wD1YJYHohFncxPhxaLC89BhYlKV4OHzwPFw==">
  <meta charset="UTF-8" />    
  <meta name="keywords" content="Social media analytics tool, free analytics tool, free social media analytics tool, Campaign report, Campaign kpi, social media performance, social media engagement, social media strategy, social media kpi, social media report, social media custom report">
  <meta name="description" content="Hype Insights is a social media analytics tool that helps you measure, track and get valuable insights about all your social media channels in one place. Hype Insights dashboard is designed to give you easy overview of your social media performance KPI's in an easy way. boost your social media strategy with real-time updated data about your social media engagement, content, performance, community growth, and much more. Automated, visualized, and easy to export social media analytics reports with the ability to customize your report to save your time and effort. Hype insights provides the best social media analytics solutions that perfectly fit your needs whether you're a brand, an agency or a freelancer, you will find what suits you. ">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">   
  <link rel="icon" href="<?= Url::to('@frontThemeUrl') ?>/images/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="/shared/themes/frontend/css/home/jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="/shared/themes/frontend/css/home/hype.home.css" />

	<!--[if IE]>
		<script type="text/javascript">
			 var console = { log: function() {} };
		</script>
	<![endif]-->
<?php
	echo $this->render('../layouts/analyticstracking');
	?>
</head>
<body>
  	<div id="load">
       <!--div class="help-load"-->
       	<div id="loadx">
                  <!--svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                     <style type="text/css" >
                         <![CDATA[
                          @keyframes stroke {
                              0% {stroke: #de1271;}
                              12.5% {stroke: #a71d75;}
                              25% {stroke: #712278;}
                              37.5% {stroke: #6e2279;}
                              50% {stroke: #3a247d;}
                              62.5% {stroke: #6e2279;}
                              75% {stroke: #712278;}
                              87.5% {stroke: #a71d75;}
                              100% {stroke: #de1271;}
                          }

                          #fill {
                              stroke: #57237b;
                              animation-name: stroke;
                              animation-duration: 1.3s;
                              animation-iteration-count: infinite;
                          }
                           ]]>
                       
                       .path {
                        stroke-dasharray: 1000;
                        stroke-dashoffset: 1000;
                        animation: dash 5s linear alternate infinite;
                      }

                      @keyframes dash {
                        from {
                          stroke-dashoffset: 1000;
                        }
                        to {
                          stroke-dashoffset: 0;
                        }
                      }
                    </style>
                    <g>
                        <path class="path" id="fill" fill="red" stroke-width="1" d="M32.1,27.4c0.9,0,1.7,0,2.5,0c5.1,0,10.2,0,15.3,0c5.8,0,9.9,4,10,9.9c0,4.9,0,9.7,0,14.6c0,0.6,0,1.1,0,1.8
		c2.7,0,5.2,0,8,0c0-0.5,0-1.1,0-1.6c0-8.8,0-17.6,0-26.4c0-3.2,1.4-4.6,4.6-4.6c3.2,0,6.3,0,9.5,0c3.4,0,4.6,1.3,4.6,4.7
		c0,11.6,0,23.1,0,34.7c0,7.1,0,14.1,0,21.2c0,3.5-1.2,4.8-4.7,4.8c-3.2,0-6.4,0-9.7,0c-2.9,0-4.3-1.5-4.3-4.4c0-3,0-6.1,0-9.3
		c-0.7,0-1.3,0-1.8,0c-5.1,0-10.1,0-15.2,0c-5.7,0-9.8-4.1-9.9-9.9c0-4.9,0-9.7,0-14.6c0-0.6,0-1.1,0-1.8c-3,0-5.9,0-8.9,0
		c0,0.6,0,1.3,0,1.9c0,11.2,0,22.4,0,33.5c0,3.1-1.4,4.5-4.5,4.5c-3.3,0-6.5,0-9.8,0c-3.1,0-4.4-1.3-4.4-4.6c0-12.5,0-25,0-37.5
		c0-8.5,0-17.1,0-25.6c0-3.7,1.2-4.9,4.9-4.9c3.2,0,6.3,0,9.5,0c2.9,0,4.3,1.5,4.3,4.4C32.1,21.1,32.1,24.2,32.1,27.4z M58.7,54.9"/>
                    </g>
                </svg-->
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                     <style type="text/css" >
                          
                       
	                       .path {
		                      	fill: none;
		                        stroke-dasharray: 1000;
		                        stroke-dashoffset: 1000;
		                        -webkit-animation: dash 8s linear 0s forwards , fill 1s linear 4s alternate infinite none ;
		                        -moz-animation: dash 8s linear 0s forwards, fill 1s linear 4s alternate infinite none ;
		                        -o-animation: dash 8s linear 0s forwards, fill 1s linear 4s alternate infinite none ;
		                        animation: dash 8s linear 0s forwards, fill 1s linear 4s alternate infinite none ;

	                      }
                          -webkit-@keyframes dash {
                              from {
                                stroke-dashoffset: 1000;
                              }
                              to {
                                stroke-dashoffset: 0;
                              }
                            }
                          -moz-@keyframes dash {
                              from {
                                stroke-dashoffset: 1000;
                              }
                              to {
                                stroke-dashoffset: 0;
                              }
                            }
                          -o-@keyframes dash {
                              from {
                                stroke-dashoffset: 1000;
                              }
                              to {
                                stroke-dashoffset: 0;
                              }
                            }
                          @keyframes dash {
                              from {
                                stroke-dashoffset: 1000;
                              }
                              to {
                                stroke-dashoffset: 0;
                              }
                            }

                          -webkit-@keyframes fill {
                               0% {stroke: rgb(222, 18, 113)}
                               25% {stroke: rgba(222, 18, 113, 0.75);}
                               50% {stroke: rgba(222, 18, 113, 0.50);}
                               75% {stroke: rgba(222, 18, 113, 0.25);}
                               100% {stroke: rgba(222, 18, 113, 0.12);}
                          }
                         -moz-@keyframes fill {
                                0% {stroke: rgb(222, 18, 113)}
                                25% {stroke: rgba(222, 18, 113, 0.75);}
                                50% {stroke: rgba(222, 18, 113, 0.50);}
                                75% {stroke: rgba(222, 18, 113, 0.25);}
                                100% {stroke: rgba(222, 18, 113, 0.12);}
                         }
                         -o-@keyframes fill {
                                0% {stroke: rgb(222, 18, 113)}
                                25% {stroke: rgba(222, 18, 113, 0.75);}
                                50% {stroke: rgba(222, 18, 113, 0.50);}
                                75% {stroke: rgba(222, 18, 113, 0.25);}
                                100% {stroke: rgba(222, 18, 113, 0.12);}
                         }
                         @keyframes fill {
                                0% {stroke: rgb(222, 18, 113)}
                                25% {stroke: rgba(222, 18, 113, 0.75);}
                                50% {stroke: rgba(222, 18, 113, 0.50);}
                                75% {stroke: rgba(222, 18, 113, 0.25);}
                                100% {stroke: rgba(222, 18, 113, 0.12);}
                         }

                           
                    </style>
                    <g>
                        <path class="path" id="fill" fill="none" stroke="rgb(222, 18, 113)" stroke-width="2" d="M32.1,27.4c0.9,0,1.7,0,2.5,0c5.1,0,10.2,0,15.3,0c5.8,0,9.9,4,10,9.9c0,4.9,0,9.7,0,14.6c0,0.6,0,1.1,0,1.8
		c2.7,0,5.2,0,8,0c0-0.5,0-1.1,0-1.6c0-8.8,0-17.6,0-26.4c0-3.2,1.4-4.6,4.6-4.6c3.2,0,6.3,0,9.5,0c3.4,0,4.6,1.3,4.6,4.7
		c0,11.6,0,23.1,0,34.7c0,7.1,0,14.1,0,21.2c0,3.5-1.2,4.8-4.7,4.8c-3.2,0-6.4,0-9.7,0c-2.9,0-4.3-1.5-4.3-4.4c0-3,0-6.1,0-9.3
		c-0.7,0-1.3,0-1.8,0c-5.1,0-10.1,0-15.2,0c-5.7,0-9.8-4.1-9.9-9.9c0-4.9,0-9.7,0-14.6c0-0.6,0-1.1,0-1.8c-3,0-5.9,0-8.9,0
		c0,0.6,0,1.3,0,1.9c0,11.2,0,22.4,0,33.5c0,3.1-1.4,4.5-4.5,4.5c-3.3,0-6.5,0-9.8,0c-3.1,0-4.4-1.3-4.4-4.6c0-12.5,0-25,0-37.5
		c0-8.5,0-17.1,0-25.6c0-3.7,1.2-4.9,4.9-4.9c3.2,0,6.3,0,9.5,0c2.9,0,4.3,1.5,4.3,4.4C32.1,21.1,32.1,24.2,32.1,27.4z M58.7,54.9"/>
                    </g>
                </svg>
          <!--div class="loaer-line"></div-->
          <style type="text/css" >
                    @keyframes draw {
                        /*0% {width:0%}
                      	12.5% {width: 25%;}
                        25% {width: 50%}
                      	37.5% {width: 75%}
                        50% {width: 100%}
                        62.5% {width: 75%}
                        75% {width: 50%}
                        87.5% {width: 25%;}
                        100% {width: 0%}*/
                      	0% {width:0%}
                      	12.5% {width: 12.5%;}
                        25% {width:25% }
                      	37.5% {width: 37.5%}
                        50% {width:50%}
                        62.5% {width:62.5%}
                        75% {width: 75% }
                        87.5% {width:87.5%}
                        100% {width: 100%}
                    }

                    .loaer-line {
                        width: 100%;
                      	height:1px;
                      background:#3a247d;
                      height: 3px;
                      border-radius: 28%;
                        animation-name: draw;
                        animation-duration: 1s;
                        animation-iteration-count: infinite;
                    }
              </style>
        <!--/div-->
      </div>
    </div>
  <div id="page-wrap">
    <!-- BEGIN FLASH MSG -->            
    			<?php
				echo $this->render('../layouts/flashMsgHome');
				?>
			<!-- END FLASH MSG -->        
			<!-- BEGIN HEADER -->
    
	<!--div class="svg-container"-->
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-2 -2 504 504" id="menu" class="">
			<g id="symbolsContainer">    
				<symbol class="icon icon-" id="icon-1" viewBox="0 0 30 30" clicked="false" hovered="false">
			        <circle r="24" class="UjIUNKNJ_0"></circle>
			    </symbol>

			    <symbol class="icon icon-" id="icon-2" viewBox="0 0 30 30" clicked="false" hovered="false">
			    	<circle  r="24" class="UjIUNKNJ_1"></circle>
			    </symbol>

			    <symbol class="icon icon-" id="icon-3" viewBox="0 0 30 30" clicked="false" hovered="false">
			    	<circle  r="24" class="UjIUNKNJ_2"></circle>
			    </symbol>

			    <symbol class="icon icon-" id="icon-4" viewBox="0 0 30 30" clicked="false" hovered="false">
			    	<circle  r="24" class="UjIUNKNJ_3"></circle>
			    </symbol>

			    <symbol class="icon icon-" id="icon-5" viewBox="0 0 30 30" clicked="false" hovered="false">
			    	<circle  r="24" class="UjIUNKNJ_4"></circle>
			    </symbol>

			</g>
			<g id="itemsContainer">        
				<a class="item" gocircle="icon-1" id="item-1" role="link" tabindex="1" xlink:href="#welcome_to_hype_insights " xlink:title=" " transform="matrix(1,0,0,1,0,0)" data-svg-origin="250 250" style="">
			        <path fill="none" stroke-width="3" stroke="#fff" d="M500,250 A250,250 0 0,0 327.25424859373686,12.235870926211618" class="sector UjIUNKNJ_5"></path>
			        <use id="nav-1" xlink:href="#icon-1" width="10" height="10" x="430" y="102" transform="rotate(59.14285714285714 431.99114990234375 141.26535034179688)"></use>
			    </a>

			    <a class="item" gocircle="icon-2" id="item-2" role="link" tabindex="2" xlink:href="#dashboard " xlink:title=" " transform="matrix(0.30901,-0.95105,0.95105,0.30901,-65.01837766752521,410.5098804800515)" data-svg-origin="250 250" style="">
			        <path fill="none" stroke-width="3" stroke="#fff" d="M500,250 A250,250 0 0,0 327.25424859373686,12.235870926211618" class="sector UjIUNKNJ_6"></path>
			        <use id="nav-2" xlink:href="#icon-2" width="10" height="10" x="430" y="102" transform="rotate(59.14285714285714 431.99114990234375 141.26535034179688)"></use>
			    </a>

			    <a class="item" gocircle="icon-3" id="item-3" role="link" tabindex="3" xlink:href="#insights_that_matters " xlink:title=" " transform="matrix(-0.80901,-0.58778,0.58778,-0.80901,305.3079355206185,599.2005616668552)" data-svg-origin="250 250" style="">
			       <path fill="none" stroke-width="3" stroke="#fff" d="M500,250 A250,250 0 0,0 327.25424859373686,12.235870926211618" class="sector UjIUNKNJ_7"></path>
			       <use id="nav-3" xlink:href="#icon-3" width="10" height="10" x="430" y="102" transform="rotate(59.14285714285714 431.99114990234375 141.26535034179688)"></use>
			    </a>

			    <a class="item" gocircle="icon-4" id="item-4" role="link" tabindex="4" xlink:href="#tailored_reports " xlink:title=" " transform="matrix(-0.80901,0.58778,-0.58778,-0.80901,599.2005616668552,305.30793552061857)" data-svg-origin="250 250" style="">
			        <path fill="none" stroke-width="3" stroke="#fff" d="M500,250 A250,250 0 0,0 327.25424859373686,12.235870926211618" class="sector UjIUNKNJ_8"></path>
			        <use id="nav-4" xlink:href="#icon-4" width="10" height="10" x="430" y="102" transform="rotate(59.14285714285714 431.99114990234375 141.26535034179688)"></use>
			    </a>

			    <a class="item" gocircle="icon-5" id="item-5" role="link" tabindex="5" xlink:href="#solutions " xlink:title=" " transform="matrix(0.30901,0.95105,-0.95105,0.30901,410.5098804800516,-65.01837766752521)" data-svg-origin="250 250" style="">
			    	<path fill="none" stroke-width="3" stroke="#fff" d="M500,250 A250,250 0 0,0 327.25424859373686,12.235870926211618" class="sector UjIUNKNJ_9"></path>
			    	<use id="nav-5" xlink:href="#icon-5" width="10" height="10" x="430" y="102" transform="rotate(59.14285714285714 431.99114990234375 141.26535034179688)"></use>
				</a>
			</g>
			<g id="trigger" class="trigger menu-trigger" role="button">
				<img id="svg-img" width="140" style="position: absolute;margin: auto;left: 0;right: 0;" src="/shared/themes/frontend/images/home/logo-home.png">
			</g>
			 
			<style>
			.UjIUNKNJ_0{stroke-dasharray:189 191;stroke-dashoffset:190;}
			.start .UjIUNKNJ_0{animation:UjIUNKNJ_draw 214ms ease-out 0ms forwards;}
			.UjIUNKNJ_1{stroke-dasharray:189 191;stroke-dashoffset:190;}
			.start .UjIUNKNJ_1{animation:UjIUNKNJ_draw 214ms ease-out 214ms forwards;}
			.UjIUNKNJ_2{stroke-dasharray:189 191;stroke-dashoffset:190;}
			.start .UjIUNKNJ_2{animation:UjIUNKNJ_draw 214ms ease-out 429ms forwards;}
			.UjIUNKNJ_3{stroke-dasharray:189 191;stroke-dashoffset:190;}
			.start .UjIUNKNJ_3{animation:UjIUNKNJ_draw 214ms ease-out 643ms forwards;}
			.UjIUNKNJ_4{stroke-dasharray:189 191;stroke-dashoffset:190;}
			.start .UjIUNKNJ_4{animation:UjIUNKNJ_draw 214ms ease-out 858ms forwards;}
			.UjIUNKNJ_5{stroke-dasharray:315 317;stroke-dashoffset:316;}
			.start .UjIUNKNJ_5{animation:UjIUNKNJ_draw 356ms ease-out 1072ms forwards;}
			.UjIUNKNJ_6{stroke-dasharray:315 317;stroke-dashoffset:316;}
			.start .UjIUNKNJ_6{animation:UjIUNKNJ_draw 356ms ease-out 1429ms forwards;}
			.UjIUNKNJ_7{stroke-dasharray:315 317;stroke-dashoffset:316;}
			.start .UjIUNKNJ_7{animation:UjIUNKNJ_draw 356ms ease-out 1786ms forwards;}
			.UjIUNKNJ_8{stroke-dasharray:315 317;stroke-dashoffset:316;}
			.start .UjIUNKNJ_8{animation:UjIUNKNJ_draw 356ms ease-out 2143ms forwards;}
			.UjIUNKNJ_9{stroke-dasharray:315 317;stroke-dashoffset:316;}
			.start .UjIUNKNJ_9{animation:UjIUNKNJ_draw 356ms ease-out 2499ms forwards;}
			.UjIUNKNJ_10{stroke-dasharray:126 128;stroke-dashoffset:127;}
			.start .UjIUNKNJ_10{animation:UjIUNKNJ_draw 143ms ease-out 2856ms forwards;}
			@keyframes UjIUNKNJ_draw{100%{stroke-dashoffset:0;}}
			@keyframes UjIUNKNJ_fade{0%{stroke-opacity:1;}94.44444444444444%{stroke-opacity:1;}100%{stroke-opacity:0;}}
			</style>
		</svg>
	<!--/div-->
	<header class="animated fadeInDown">
		<div class="container">
			<div class="inner-header">
				<nav class="nav-menu">
					<ul class="menu-list">
						<li><a href="<?= Url::to(['/']) ?>"  class="<?= ($action_id == 'home') ? 'active' : '' ?>">Home</a></li>
						<li class="not-inside"><a class="<?= ($action_id == 'subscribe') ? 'active' : '' ?>" href="<?= Url::to(['/subscribe']) ?>">Subscribe</a></li>
						<li><a class="<?= ($action_id == 'contact-us') ? 'active' : '' ?>" href="<?= Url::to(['/contact-us']) ?>">Contact Us</a></li>
						<li class="sub-menu not-inside">
							<a href="#">Login</a>
							<ul class="sub-menu-ul">
								<?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => Url::to(['/login'])]); ?>
									<p>Email<p>
                                    <?= $form->field($oUserLoginForm, 'email')->textInput()->label(false) ?>
                                    
                                    <p>Password<p>
                                    <?= $form->field($oUserLoginForm, 'password')->passwordInput()->label(false); ?>
                                        
                                    <a class="forgotLink" href="<?= Url::to(['/forgot-password']) ?>">Forgot password</a>
									<?= Html::submitButton('login', ['id' => 'btn2', 'name' => 'submit2', 'class' => 'btn' ,   'data-error'=>'Something is wrong', 'data-success'=>'Success']) ?>
								<?php ActiveForm::end(); ?>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
    <header class=" mobile">
    <div class="container">
        <div class="inner-header">
            <div class="logo"><a href="/"><img src="/shared/themes/frontend/images/logoMob.png"></a></div>
            <nav class="nav-menu">
                <ul class="menu-list">
                    <li><a class="<?= ($action_id == 'home') ? 'active' : '' ?>" href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li><a class="<?= ($action_id == 'subscribe') ? 'active' : '' ?>" href="<?= Url::to(['/subscribe']) ?>">Subscribe</a></li>
                    <li><a class="<?= ($action_id == 'contact-us') ? 'active' : '' ?>" href="<?= Url::to(['/contact-us']) ?>">Contact Us</a></li>
                    <li class="sub-menu">
                        <a href="<?= Url::to(['/mobile-login']) ?>">Login</a>
                    </li>
                </ul>
            </nav>
            <div class="icon">
                <a href="javascript:void(0);" onclick="toggleMenu()" class="glyphicon glyphicon-menu-hamburger"></a>
            </div>
        </div>
    </div>
</header>
	<div id="fullpage">
		<div class="section" id="section1" gocircle="icon-1">
			<div class="indicator-line"></div>
			<div class="section-icon animated zoomIn">
				<img  src="/shared/themes/frontend/images/home/logo1.png">
			</div>
			<div class="section-info animated fadeIn">
				<h3>Welcome to Hype Insights </h3>
				<p>Hype Insights is a social media analytics tool that helps you measure, track and get valuable insights about all your social media channels in one place.</p>
              <div class="subscribe-now btn"><a href="<?= Url::to(['subscribe']) ?>">Subscribe Now</a></div>
			</div>
		</div>
		<div class="section" id="section2" gocircle="icon-2">
			<div class="indicator-line"></div>
			<div class="section-icon animated zoomIn">
				<img  src="/shared/themes/frontend/images/home/logo4.png">
			</div>
			<div class="section-info animated fadeIn">
				<h3>Dashboard</h3>
				<p>Hype Insights dashboard is designed to give you easy overview of your social media performance KPI's in an easy way.</p>
              <div class="subscribe-now btn"><a href="<?= Url::to(['subscribe']) ?>">Subscribe Now</a></div>
			</div>
		</div>
		<div class="section" id="section3" gocircle="icon-3">
			<div class="indicator-line"></div>
			<div class="section-icon animated zoomIn">
				<img  src="/shared/themes/frontend/images/home/logo3.png">
			</div>
			<div class="section-info animated fadeIn">
				<h3>Insights that matters</h3>
				<p>boost your social media strategy with real-time updated data about your social media engagement, content, performance, community growth, and much more.</p>
              <div class="subscribe-now btn"><a href="<?= Url::to(['subscribe']) ?>">Subscribe Now</a></div>
			</div>
		</div>
		<div class="section" id="section4" gocircle="icon-4">
			<div class="indicator-line"></div>
			<div class="section-icon animated zoomIn">
				<img  src="/shared/themes/frontend/images/home/logo2.png">
			</div>
			<div class="section-info animated fadeIn">
				<h3>Tailored Reports</h3>
				<p>Automated, visualized, and easy to export social media analytics reports with the ability to customize your report to save your time and effort .</p>
              <div class="subscribe-now btn"><a href="<?= Url::to(['subscribe']) ?>">Subscribe Now</a></div>
			</div>
		</div>
		<div class="section" id="section5" gocircle="icon-5">
			<div class="indicator-line"></div>
			<div class="section-icon animated zoomIn">
				<img  src="/shared/themes/frontend/images/home/logo5.png">
			</div>
			<div class="section-info animated fadeIn">
				<h3>Hype Insights solutions</h3>
				<p>Hype insights provides the best social media analytics solutions that perfectly fit your needs whether you're a brand, an agency or a freelancer, you will find what suits you.  </p>
              <div class="subscribe-now btn"><a href="<?= Url::to(['subscribe']) ?>">Subscribe Now</a></div>
			</div>
		</div>
	</div>
	<div id="hovered-sections">	
			<div class="hovered-content animated" gocircle="icon-1">
				<img  src="/shared/themes/frontend/images/home/logo1.png">
			</div><!-- hoverd content -->
			<div class="hovered-content animated" gocircle="icon-2">
				<img  src="/shared/themes/frontend/images/home/logo4.png">
			</div><!-- hoverd content -->
			<div class="hovered-content animated" gocircle="icon-3">
				<img  src="/shared/themes/frontend/images/home/logo3.png">
			</div><!-- hoverd content -->
			<div class="hovered-content animated" gocircle="icon-4">
				<img  src="/shared/themes/frontend/images/home/logo2.png">
			</div><!-- hoverd content -->
			<div class="hovered-content animated" gocircle="icon-5">
				<img  src="/shared/themes/frontend/images/home/logo5.png">
			</div><!-- hoverd content -->
	</div>
	<footer class="animated fadeInUp">
		<div class="container">
			<div class="inner-footer">
				<div class="copyRights"><span><a target="_blank" href="//digitreeinc.com">&copy; Hype 2017 powered By Digitree.</a></span></div>
				<div class="social-links clearfix">
					<span>Follow us </span>
					<!--<div class="social-link youTube"></div>-->
                    <div class="social-link twit"><a href="https://twitter.com/HypeInsights/" target="_blank"></a></div>
                    <div class="social-link inst"><a href="https://www.instagram.com/hypeinsights/" target="_blank"></a></div>
                    <div class="social-link fb"><a href="https://www.facebook.com/Hype-Insights-713855192098064/?fref=ts" target="_blank"></a></div>
				</div>
			</div>
		</div>
	</footer>
  </div>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/shared/themes/frontend/js/home/scrolloverflow.min.js"></script>
	<script type="text/javascript" src="/shared/themes/frontend/js/home/jquery.fullPage.js"></script>
	<script type="text/javascript" src="/shared/themes/frontend/js/home/hype.home.js"></script>
	<script type="text/javascript">
		
	</script>
	<script type="text/javascript">
		

	</script>
	<script type="text/javascript">
		
	</script>
</body>
</html>
