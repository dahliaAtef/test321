<?php
	if($top_posts_by_engagement){
    foreach($top_posts_by_engagement as $post){ ?>
    <div class="col-md-3 col-sm-6">
        <div class="post-item">
	        <div class="post-img"><img src="<?= $post['media_url'] ?>" /></div>
	        <div class="internal-content">
		     	<ul>
			        <li><span class="small-title">Engagement : </span><?= $post['engagement'] ?>%</li>
			      	<li><span class="small-title">Likes : </span><?= $post['likes'] ?></li>		
			      	<li><span class="small-title">Comments : </span><?= $post['comments'] ?></li>  		
			      	<li><span class="small-title">Shares : </span><?= $post['shares'] ?></li>
			        <li><a href="<?= $post['link'] ?>">View on Google+</a></li>
		    	</ul>
	    	</div>
	    </div>
	</div>
    <?php } 
    }else{ ?>
    	<div class="waiting-text col-md-12""><p>You haven't posted anything within this month.</p></div>
    <?php }
?>