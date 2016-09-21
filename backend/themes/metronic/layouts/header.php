<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a class="logo-bg" href="<?= Url::home(); //Url::to('/');   ?>">
                    <img src="<?= Url::to(['/images/logo.png']); ?>" alt="logo" class="logo-default"/>
                </a>
                <div class="menu-toggler sidebar-toggler hide">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN TOP MENU -->
            <?php include_once 'topMenu.php'; ?>
            <!-- END TOP MENU -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    
                    <!-- BEGIN TODO DROPDOWN -->
                    <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="iconSetting"></i>
                            <!--<span class="badge badge-default">
                                3 </span>-->
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= Url::to(['/settings']) ?>">
                                    <i class="icon-settings"></i> Settings </a>
                            </li>
                            <li>
                                <a href="<?= Url::to(['/users/change-password', 'id' => 1]) ?>">
                                    <i class="icon-key"></i> Change Password </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li><?php
                                echo Html::a('<i class="icon-logout"></i> Log Out', Url::to(['/site/logout']), [
                                    'data-method' => 'post',
                                ]);
                                ?>
                            </li>
                        </ul>

                        <!--<ul class="dropdown-menu extended tasks">
                            <li>
                                <p>
                                    You have 12 pending tasks
                                </p>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;">
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    New release v1.2 </span>
                                                <span class="percent">
                                                    30% </span>
                                            </span>
                                            <span class="progress">
                                                <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        40% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    Application deployment </span>
                                                <span class="percent">
                                                    65% </span>
                                            </span>
                                            <span class="progress progress-striped">
                                                <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        65% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    Mobile app release </span>
                                                <span class="percent">
                                                    98% </span>
                                            </span>
                                            <span class="progress">
                                                <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        98% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    Database migration </span>
                                                <span class="percent">
                                                    10% </span>
                                            </span>
                                            <span class="progress progress-striped">
                                                <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        10% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    Web server upgrade </span>
                                                <span class="percent">
                                                    58% </span>
                                            </span>
                                            <span class="progress progress-striped">
                                                <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        58% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    Mobile development </span>
                                                <span class="percent">
                                                    85% </span>
                                            </span>
                                            <span class="progress progress-striped">
                                                <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        85% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="task">
                                                <span class="desc">
                                                    New UI release </span>
                                                <span class="percent">
                                                    18% </span>
                                            </span>
                                            <span class="progress progress-striped">
                                                <span style="width: 18%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">
                                                        18% Complete </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="external">
                                <a href="#">
                                    See all tasks <i class="m-icon-swapright"></i>
                                </a>
                            </li>
                        </ul>-->
                    </li>
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!--<li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle hide1" src="<?= Url::to('@metronicUrl/assets/admin/layout/img/avatar3_small.jpg'); ?>"/>
                            <span class="username username-hide-on-mobile">
                                Bob </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="extra_profile.html">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="page_calendar.html">
                                    <i class="icon-calendar"></i> My Calendar </a>
                            </li>
                            <li>
                                <a href="inbox.html">
                                    <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
                                        3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
                                        7 </span>
                                </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="extra_lock.html">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li>
                            <li>
                                <a href="<?= Url::to(['site/logout']); ?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!--<li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>-->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER INNER -->
</div>