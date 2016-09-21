<?php

use yii\helpers\Url;
?>
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu page-sidebar-menu-closed" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>

            <li class="start <?= (in_array(Yii::$app->controller->id, ['clients', 'industries', 'offering', 'projects']) ) ? 'active open' : '' ?>">
                <a href="javascript:;">
                    <i class="fa fa-database"></i>
                    <span class="title">Work</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

                <ul class="sub-menu">
                    <li class="<?= (Yii::$app->controller->id == 'clients') ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/clients']) ?>"><i class="fa fa-briefcase"></i> Clients </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'industries') ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/industries']) ?>"><i class="fa fa-paw"></i> Industries </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'offering') ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/offering']) ?>"><i class="fa fa-cloud"></i> Offering </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'projects') ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/projects']) ?>"><i class="fa fa-cubes"></i> Projects </a>
                    </li>
                </ul>
            </li>

            <li class="<?= (Yii::$app->controller->id == 'pages') ? 'active' : '' ?>">
                <a href="<?= Url::to(['/pages']) ?>">
                    <i class="fa fa-pencil"></i>
                    <span class="title">Pages</span> 
                </a>
            </li>
            
            <li class="<?= (Yii::$app->controller->id == 'careers') ? 'active' : '' ?>">
                <a href="<?= Url::to(['/careers']) ?>">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="title">Careers</span> 
                </a>
            </li>

            <li class="<?= (Yii::$app->controller->id == 'users') ? 'active' : '' ?>">
                <a href="<?= Url::to(['/users']) ?>">
                    <i class="fa fa-user"></i>
                    <span class="title">Users</span> 
                </a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>