<?php
use yii\helpers\Url;
use common\models\custom\Dashboard;
use yii\widgets\Pjax;
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
                          switch($key){
                            case "Facebook":
                              $followers = "fans";
                              break;
                            case "Google_plus":
                              $followers = "followers";
                              break;
                            case "Twitter":
                              $followers = "followers";
                              break;
                            case "Instagram":
                              $followers = "followers";
                              break;
                            case "Youtube":
                              $followers = "subscribers";
                              break;
                            case "Linkedin":
                              $followers = "connections";
                              break;
                          }
                        ?>
                            <li class="col-lg-4 col-md-6 col-sm-6"><span class="rounded <?= $key ?>"><?= round(((($value)/($total))*100)) ?>%</span>&nbsp;&nbsp;<span class="small-title" style="font-size:16px"><?= $key ?> : </span><?= $value ?> <?= $followers ?></li>
                        <?php } ?>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-6">
                <?php
						echo '<h3 class="internal-title noneBG">Existance Chart</h3>';
                        echo '<div class="internal-content circleChart">';
                    if($sx_json_table && (array_sum($sx) > 0)){
                        $this->registerJs("GoogleCharts.drawCircle(".$sx_json_table.", 'Social Media Existance', 'sx')", yii\web\View::POS_END);
                        echo '<div id="sx"></div>';
                    }else{
                    	echo '<div id="sx"><div class="dummy_chart"><img src="'.Url::to('@frontThemeUrl').'/images/pie_no.png" /></div></div>';
                    }
					echo "</div>";
                ?>            
            </div>
            <div class="col-md-6">
              <h3 class="internal-title noneBG comp-tit">Competitors</h3>
              <?php
                    if($oCompetitors){ ?>
                        <div class="comp-edit"  data-toggle="modal" data-target="#myModal2" ><span class="glyphicon glyphicon-pencil"></span></div>
		<?php } ?>
              	<div class="internal-content circleChart" data-pjax>
				<?php
					if($oCompetitors){ 
                                            $this->registerJs("GoogleCharts.drawCircle(".Dashboard::getCompetitorsJsonTable(Dashboard::getUserCompetitors($total, $name, $oCompetitors)).", 'Competitors', 'competitors')", yii\web\View::POS_END); ?>
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
