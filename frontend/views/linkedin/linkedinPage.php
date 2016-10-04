<?php
$this->title = 'LinkedIn';
$updates = count($statistics['updates']);
?>
<div class="page-content inside linkeidn">

    <div class="container">

	<div class="inner-page">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box">
                        <h2 class="internal-title sec-title"><?= $oModel->name ?></h2>
                        <div class="line-box"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">KPIs Overview</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li><span class="small-title">Updates : </span><?= $updates ?></li>
                                <li><span class="small-title">Avg. Daily updates : </span><?= $statistics['avg_daily_updates'] ?></li>
                                <li><span class="small-title">Interactions : </span><?= $statistics['interactions'] ?></li>
                                <li><span class="small-title">Avg. Daily Interactions : </span><?= $statistics['avg_daily_interactions'] ?></li>
                                <li><span class="small-title">Impressions : </span><?= $statistics['impressions'] ?></li>
                                <li><span class="small-title">Avg. Daily Reach : </span><?= $statistics['avg_daily_reach'] ?></li>
                                <li><span class="small-title">Clicks : </span><?= $statistics['clicks'] ?></li>
                                <li><span class="small-title">Followers : </span><?= $statistics['new_followers'] ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="internal-title linkeidn ">Interactions On Updates</h3>
                    <div class="internal-content">
                        <ul>
                            <div class="row">
                                <li><span class="small-title">Interactions Total : </span><?= $statistics['interactions'] ?></li>
                                <li><span class="small-title">New Updates Total : </span><?= count($statistics['updates']) ?></li>
                                <li><span class="small-title">Interactions on New Updates : </span><?= $statistics['sums_of_all_updates_statistics']['interactions'] ?></li>
                                <li><span class="small-title">Interactions per New Update : </span><?= round((($statistics['sums_of_all_updates_statistics']['interactions'])/$updates), 1) ?></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        echo $this->render('_updatesByDayChart', ['updates_by_day_json_table' => $linkedin->getUpdatesByDayJsonTable($statistics['updates_statistics_by_day'])]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        echo $this->render('_interactionsByDayChart', ['interactions_by_day_json_table' => $linkedin->getInteractionsByDayJsonTable($statistics['days'], $statistics['updates_statistics_by_day'], $statistics['company_views_statistics_by_day'])]);
                    ?>
                </div>
            </div>
	</div>
        
    </div>
    <!-- inner page -->
    
</div>
<!-- page content -->
