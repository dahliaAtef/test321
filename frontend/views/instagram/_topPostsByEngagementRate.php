	<?php
		if($top_posts_by_engagement){
		foreach($top_posts_by_engagement as $post){
		echo '<div class="col-lg-3 col-md-4 col-sm-6">';
			echo '<div class="post-item">';
		    	echo '<div class="post-img"><img src="'.$post['media_url'].'" /></div>';
	?>
	<div class="internal-content">
		<ul>
			<li><span class="small-title">Engagement : </span><?= $post['engagement'] ?>%</li>
			<li><span class="small-title">Likes : </span><?= $post['likes'] ?></li>
			<li><span class="small-title">Comments : </span><?= $post['comments'] ?></li>
			<li><a href="<?= $post['link'] ?>" target="_blank">View on instagram</a></li>
		</ul>
	</div>
	</div>

	</div>
    <?php } 
        }else{ ?>
			<div class="waiting-text col-md-12""><p>You haven't posted anything within this month.</p></div>
		<?php } ?>



    