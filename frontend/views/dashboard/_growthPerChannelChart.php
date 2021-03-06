<?php
use yii\helpers\Url;
use common\models\custom\Dashboard;

?>
<div class="row">
	<div class="col-md-12">
		<?php
			echo '<h3 class="internal-title noneBG ">Growth Per Channel</h3>';
            echo '<div class="internal-content">';
		$growth_per_channel_json_table = Dashboard::getGrowthPerChannelJsonTable($growth_per_channel);
		if($growth_per_channel_json_table && (array_sum($growth_per_channel) > 0)){
		    $this->registerJs("GoogleCharts.drawBars(".$growth_per_channel_json_table.", 'Growth Per Channel', 'growth_per_channel')", yii\web\View::POS_END);
		    echo '<div id="growth_per_channel"></div>';
		}else{
        	echo '<div id="growth_per_channel"><div class="dummy_chart" ><img src="'.Url::to('@frontThemeUrl').'/images/bar_no.png" /></div></div>';
        }
		echo '</div>';
		?>
	</div>
</div>

<!-- New -->
<div class="row">
	<div class="col-md-12" style="">
		<div class="element-container">
			<?php 
			foreach($growth_per_channel as $social => $growth){ ?>
					
					<style type="text/css">
					</style>
			<div class="element-list" style="">		
				<div class="element <?= $social ?> <?= ($growth > 0) ? 'up' : 'down'?>">
					<div style="display:block;margin:auto" class="img"><img  width="100%" src="<?= Url::to('@frontThemeUrl') ?>/images/social/<?= $social ?>.png"></div>
				</div>
				<div class="growth">
					<p class="account-name"><?= ucwords($social) ?></p>
					<p class="account-growth"><?= abs($growth) ?></p>
				</div>
			</div>

			<?php } ?>
		</div>
	</div>
</div>