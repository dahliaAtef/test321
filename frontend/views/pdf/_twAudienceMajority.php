<?php
	$devices_sum = array_sum($devices);
	$max_device_type = array_keys($devices, max($devices))[0];
	$max_device_value = ($devices_sum != 0) ? (round((($devices[$max_device_type])/$devices_sum), 1)*100) : 0;
?>


<h3 class="internal-title twitter">Twitter</h3>
<div class="internal-content">
	<ul>
		<div class="row">
		    <li class="col-lg-5 col-md-6"><span class="small-title">Device : </span><?= $max_device_type.' '.$max_device_value.'% ' ?></li>
		</div>
	</ul>
</div>