<?php
use yii\helpers\Url;
use common\models\custom\Dashboard;
?>

        <div class="row">
            <div class="col-md-12">
                <!-- <h3 class="internal-title noneBG ">Existance Overview</h3> -->
                <div class="internal-content">
                    <?php $total = array_sum($sx); ?>
                    <ul>                        
                        <div class="row">
                        <?php
                        foreach($sx as $key => $value){
                        ?>
                            <li class="col-md-4"><span class="small-title"><?= $key ?> : </span><?= $value ?> followers&nbsp;&nbsp;<span class="rounded <?= $key ?>"><?= round(((($value)/($total))*100)) ?>%</span></li>
                        <?php } ?>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-6">
                <?php
                    if($sx_json_table){
                        $this->registerJs("GoogleCharts.drawCircle(".$sx_json_table.", 'Social Media Existance', 'sx')", yii\web\View::POS_END);
                        echo '<h3 class="internal-title noneBG">Existance Chart</h3>';
                        echo '<div class="internal-content circleChart">';
                        echo '<div id="sx"></div>';
                        echo "</div>";
                    }
                ?>            
            </div>
            <div class="col-md-6">
                <h3 class="internal-title noneBG ">Competitors</h3>
                <div class="internal-content circleChart">
				<?php
					if($competitors_existance = Dashboard::getUserCompetitors($total, $name)){ 
						$this->registerJs("GoogleCharts.drawCircle(".Dashboard::getCompetitorsJsonTable($competitors_existance).", 'Competitors', 'competitors')", yii\web\View::POS_END); ?>
						<div id="competitors"></div>
				<?php	}else{
				?>
                    <div class="dummyChart">
                        <div class="dummy-img"><img src="<?= Url::to('@frontThemeUrl') ?>/images/dummy-chart.png"></div>
                    </div>
                    <div class="addCompatitors">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                        Name Your Competitors
                        </button>
                    </div>
				<?php } ?>
                </div>
            </div>

        </div>
