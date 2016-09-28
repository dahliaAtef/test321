
<?php
use yii\helpers\Url;

$this->title = 'Foursquare';
?>

<div class="page-content inside foursquare">
    <div class="container">
	<div class="inner-page">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="internal-title sec-title"><?= $venueInsights->model->name ?> Venue</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
				<h3 class="internal-title foursquare"><?= $venueInsights->model->name ?> KPI Overview</h3>
					<div class="internal-content">				
						<ul>
							<li><span class="small-title">Listed by : </span><?= $venueInsights->listed ?></li>
							<li><span class="small-title">Likes : </span><?= $venueInsights->total_likes ?></li>
							<li><span class="small-title">Chekins : </span><?= $venueInsights->checkins ?></li>
							<li><span class="small-title">Users : </span><?= $venueInsights->followers ?></li>
							<li><span class="small-title">Tips : </span><?= $venueInsights->number_of_posted_media ?></li>
							<li><span class="small-title">Visits : </span><?= $venueInsights->visits ?></li>								
						</ul>
					</div>
				</div>
			</div>
	</div>
	<!-- inner page -->
    </div>
</div>
<!-- page content -->