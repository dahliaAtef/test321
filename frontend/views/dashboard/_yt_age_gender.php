<div class="row">
    <div class="col-md-12">
		<?php
		use digi\authclient\clients\Youtube;

		//echo '<pre>'; var_dump($fans_gender_age); echo '</pre>'; die;
		$fans_gender_age_json_table = Youtube::getDashboardAnalyticsPerGenderAgesJsonTable($fans_gender_age);
		//echo '<pre>'; var_dump($fans_gender_age_json_table); echo '</pre>'; die;
		if($fans_gender_age_json_table){
		    echo '<h3 class="internal-title youtube short">Youtube</h3>';
          		$max = $fans_gender_age[0];
                foreach($fans_gender_age as $value){
                    ($value[2] > $max[2]) ? ($max = $value) : '';
                }
                $age_range = substr($max[0], 3);
                //var_dump($followers); die;
                echo '<div class="info-title">';
                echo '<span class="bold-title">Majority : '.$max[1].'s of age '.$age_range.' by </span><span class="rounded youtube">'.round(((($max[2])/$followers)*100)).'%</span>';
                echo '</div>';
		    $this->registerJs("GoogleCharts.drawColumns(".$fans_gender_age_json_table.", 'yg', 'yt_fans_age_gender')", yii\web\View::POS_END);
		    echo '<div class="internal-content">';
		    echo '<div id="yt_fans_age_gender"></div>';
		    echo '</div>';
		}


		?>
	</div>
</div>


