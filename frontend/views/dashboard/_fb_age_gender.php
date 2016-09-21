<div class="row">
    <div class="col-md-12">
		<?php
		use digi\authclient\clients\Facebook;

		$fans_gender_age_json_table = Facebook::getFansByAgeGenderJsonTable($fans_gender_age);
		if($fans_gender_age_json_table){
		    echo '<h3 class="internal-title facebook short">Facebook</h3>';
		    $this->registerJs("GoogleCharts.drawColumns(".$fans_gender_age_json_table.", 'Distribution of fans by gender and age ranges', 'fb_fans_age_gender')", yii\web\View::POS_END);
		    echo '<div class="internal-content">';
		    	echo '<div id="fb_fans_age_gender"></div>';
		    echo '</div>';
		}

		$max_male = max($fans_gender_age['male']);
		$max_female = max($fans_gender_age['female']);
		$max_fans = (($max_male >= $max_female) ? $max_male : $max_female);
		$check_existance = array_search($max_fans, $fans_gender_age['male']);
		($check_existance) ? ($max_range['male'] = $check_existance) :($max_range['male'] = array_search($max_fans, $fans_gender_age['female']));
		$max_gender = key($max_range);
		echo '<div class="internal-content">';
			echo '<span class="bold-title">Majority : '.$max_gender.'s of age '.$max_range[$max_gender].' by </span><span class="rounded facebook">'.round(((($max_fans)/ $followers)*100)).'%</span>';
		echo '</div>';
		?>
	</div>
</div>

