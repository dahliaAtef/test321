<?php
	$males = $females = 0; $age = [];
	foreach($fans_gender_age as $value){
    	(array_key_exists($value[0], $age)) ? ($age[$value[0]] += $value[2]) : ($age[$value[0]] = $value[2]);
        ($value[1] == 'male') ? ($males += $value[2]) : ($females += $value[2]);
    }
	$viweres = $males + $females;
	$males_percentage = (round(($males/$viweres),1)*100);
	$females_percentage = (round(($females/$viweres),1)*100);
	if($males_percentage >= $$females_percentage){
    	$max_gender_type = 'males';
     	 $max_gender_value = $males_percentage;
    }else{
    	$max_gender_type = 'females';
     	 $max_gender_value = $females_percentage;
    }
	$max_age_range = array_keys($age, max($age))[0];
	$max_age_range_value = ($viweres != 0) ? (round((($age[$max_age_range])/$viweres), 1)*100) : 0;
	$devices_sum = array_sum($devices);
	$max_device_type = array_keys($devices, max($devices))[0];
	$max_device_value = ($devices_sum != 0) ? (round((($devices[$max_device_type])/$devices_sum), 1)*100) : 0;
	$top_fifteen_locations = ($countries > 15) ? array_slice($countries, 0, 15) : $countries;
	$country = [];
    foreach($top_fifteen_locations as $value){
    	$country[$value[0]] = $value[1];
    }
	$countries_sum = array_sum($country);
	$max_country_type = array_keys($country, max($country))[0];
	$max_country_value = ($devices_sum != 0) ? (round((($country[$max_country_type])/$countries_sum), 1)*100) : 0;
?>


<h3 class="internal-title youtube">Youtube</h3>
<div class="internal-content">
	<ul>
		<div class="row">
		    <li class="col-lg-5 col-md-6"><span class="small-title">Age Range : </span><?= substr($max_age_range,3).' '.$max_age_range_value.'% ' ?></li>
		    <li class="col-lg-5 col-md-6"><span class="small-title">Gender : </span><?= $max_gender_type.' '.$max_gender_value.'% ' ?></li>
		    <li class="col-lg-5 col-md-6"><span class="small-title">Device : </span><?= $max_device_type.' '.$max_device_value.'% ' ?></li>
		    <li class="col-lg-5 col-md-6"><span class="small-title">Country : </span><?= $max_country_type.' '.$max_country_value.'% ' ?></li>
		</div>
	</ul>
</div>