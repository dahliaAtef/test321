<?php

use yii\helpers\Url;
?>
<!-- BEGIN HORIZANTAL MENU -->
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
<div class="hor-menu hidden-sm hidden-xs">
    <ul class="nav navbar-nav">
        <!-- <li>
            <a href="</?= Url::to(['/categories']) ?>"> Categories </a>
        </li>
        <li>
            <a href="</?= Url::to(['/products']) ?>"> Products </a>
        </li>
        <li class="classic-menu-dropdown">
            <a data-toggle="dropdown" href="javascript:;">
                Contents <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-left">
                <li>
                    <a href="</?= Url::to(['/pages']) ?>"><i class="fa fa-pencil"></i> Pages </a>
                </li>
                <li>
                    <a href="</?= Url::to(['/catalogues']) ?>"><i class="fa fa-picture-o"></i> Catalogues </a>
                </li>
                <li>
                    <a href="</?= Url::to(['/showrooms']) ?>"><i class="fa fa-puzzle-piece"></i> Showrooms </a>
                </li>
                <li>
                    <a href="</?= Url::to(['/certificates']) ?>"><i class="fa fa-certificate"></i> Certificates </a>
                </li>
            </ul>
        </li> -->
        <li>
            <a href="<?= Url::to(['/users']) ?>"> Users </a>
        </li>
    </ul>
</div>
