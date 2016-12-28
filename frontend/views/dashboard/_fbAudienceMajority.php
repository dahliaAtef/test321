<?php
		
	
	$males_percentage = (round(($fans_gender_age['male_count']/$followers),1)*100);
	$females_percentage = (round(($fans_gender_age['female_count']/$followers),1)*100);
	if($males_percentage >= $$females_percentage){
    	$max_gender_type = 'males';
     	 $max_gender_value = $males_percentage;
    }else{
    	$max_gender_type = 'females';
     	 $max_gender_value = $females_percentage;
    }
	$range =[];
 
	foreach($fans_gender_age['age_ranges'] as $age_range){
		$males = (array_key_exists($age_range, $fans_gender_age['male'])) ?  $fans_gender_age['male'][$age_range] : 0;
     
		$females = (array_key_exists($age_range, $fans_gender_age['female'])) ?  $fans_gender_age['female'][$age_range] : 0;
		$range[$age_range] = $males + $females;
	}
	$max_age_range = array_keys($range, max($range))[0];
	$max_age_range_value = ($followers != 0) ? (round((($range[$max_age_range])/$followers), 1)*100) : 0;
	$devices_sum = array_sum($devices);
	$max_device_type = array_keys($devices, max($devices))[0];
	$max_device_value = ($devices_sum != 0) ? (round((($devices[$max_device_type])/$devices_sum), 1)*100) : 0;
	$countries_sum = array_sum($countries);
	$max_country_type = array_keys($countries, max($countries))[0];
	$max_country_value = ($devices_sum != 0) ? (round((($countries[$max_country_type])/$countries_sum), 1)*100) : 0;
?>


<h3 class="internal-title facebook">Facebook</h3>
<div class="internal-content">
	<ul>
		<div class="row">
		    <li class="col-lg-5 col-md-6"><span class="small-title">Age Range : </span><?= $max_age_range.' '.$max_age_range_value.'% ' ?></li>
		    <li class="col-lg-5 col-md-6"><span class="small-title">Gender : </span><?= $max_gender_type.' '.$max_gender_value.'% ' ?></li>
		    <li class="col-lg-5 col-md-6"><span class="small-title">Device : </span><?= $max_device_type.' '.$max_device_value.'% ' ?></li>
		    <li class="col-lg-5 col-md-6"><span class="small-title">Country : </span><?= $max_country_type.' '.$max_country_value.'% ' ?></li>
		</div>
	</ul>
</div>