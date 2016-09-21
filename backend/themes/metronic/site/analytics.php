<?php

use infoweb\analytics\Analytics;
?>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-bar-chart-o"></i>
            <a href="#">Statistics</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div data-placement="top" class="pull-right btn btn-fit-height grey-salt" id="dashboard-report-range" style="cursor: default;">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block">
                <?= Yii::$app->formatter->asDate(date('d-m-Y', strtotime('-1 month')), 'medium'); ?>&nbsp;-&nbsp;<?= Yii::$app->formatter->asDate(date('d-m-Y'), 'medium'); ?>
            </span>
        </div>
    </div>
</div>

<div class="site-index">
    <div class="body-content">

        <div class="row">
            <?= Analytics::widget(['dataType' => Analytics::TOTAl_SESSIONS]); ?>
            <?= Analytics::widget(['dataType' => Analytics::TOTAL_USERS]); ?>
            <?= Analytics::widget(['dataType' => Analytics::TOTAL_PAGE_VIEWS]); ?>
            <?= Analytics::widget(['dataType' => Analytics::AVERAGE_SESSION_LENGTH]); ?>
        </div>

        <div class="row">
            <?= Analytics::widget(['dataType' => Analytics::SESSIONS]); ?>
        </div>
        <div class="row">
            <?= Analytics::widget(['dataType' => Analytics::VISITORS]); ?>
            <?php echo Analytics::widget(['dataType' => Analytics::COUNTRIES]); ?>
        </div>

    </div>
</div>