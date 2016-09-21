

        <div class="row">
            <div class="col-md-6">
                <h3 class="internal-title noneBG ">Existance Overview</h3>
                <div class="internal-content">
                    <?php $total = array_sum($sx); ?>
                    <ul>                        
                        <?php
                        foreach($sx as $key => $value){
                        ?>
                        <div class="row">
                            <li class="col-md-5"><span class="small-title"><?= $key ?> : </span><?= $value ?></li>
    						<li class="col-md-5"><span class="small-title">Percentage : </span><?= round(((($value)/($total))*100), 1) ?>%</li>
                        </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
           <div class="row"> 
            <div class="col-md-12">
            <?php
                if($sx_json_table){
                    $this->registerJs("GoogleCharts.drawCircle(".$sx_json_table.", 'Social Media Existance', 'sx')", yii\web\View::POS_END);
                    echo '<h3 class="internal-title noneBG ">Existance Chart</h3>';
                    echo '<div class="internal-content">';
                    echo '<div id="sx"></div>';
                    echo "</div>";
                }
            ?>            
            </div>

        </div>
