<?php

//echo '<pre>'; var_dump($age_gender_array["unisex_count"]); echo 'fans count : '; var_dump($fans_count); echo '</pre>'; die;

echo '<h3 class="internal-title facebook " style="background-color:#4066ab">Majority</h3>';
echo '<div class="internal-content"><ul>';
if($fans_count == 0){
	echo '<li><span class="small-title">.... : </span>....%</li>';
}elseif($age_gender_array["male_count"] >= $age_gender_array["female_count"]){
	echo '<li><span class="small-title">male : </span>'.round((($age_gender_array["male_count"]/$fans_count)*100), 2).'%</li>';
}else{
	echo '<li><span class="small-title">female : </span>'.round((($age_gender_array["female_count"]/$fans_count)*100), 2).'%</li>';
}

$sum = array();

foreach($age_gender_array['age_ranges'] as $age_range){

 $sum[$age_range] = ((array_key_exists($age_range, $age_gender_array["female"])) ? $age_gender_array["female"][$age_range] : 0) + ((array_key_exists($age_range, $age_gender_array["male"])) ? $age_gender_array["male"][$age_range] : 0);  

}

if($sum){

    arsort($sum); 

    reset($sum);

    echo '<li><span class="small-title">age range : </span>'.(key($sum)).' years ('.round((($sum[key($sum)]/$fans_count)*100)).'%)</li>';
    echo '</div></ul>';      
}

