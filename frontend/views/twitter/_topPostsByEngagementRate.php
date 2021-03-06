<?php
use yii\helpers\Url;

if($top_posts_by_engagement){
  
    foreach($top_posts_by_engagement as $post){
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="post-item">
                <div class="post-img"><img src="<?= (($post['media_url']) ? ($post['media_url']) : (Url::to('@frontThemeUrl/images/twitter_posts_placeholder.png'))) ?>"/></div>
                <div class="internal-content">
                    <ul>
                        <li class="special-height"><?= $post['content'] ?></li>
                        <li><span class="small-title">Total Interactions : </span><?= ($post['favourites'] + $post['retweets'] + $post['replies']) ?></li>
                        <li><span class="small-title">Likes : </span><?= $post['favourites'] ?></li>
                        <li><span class="small-title">Retweets : </span><?= $post['retweets'] ?></li>
                        <li><span class="small-title">Replies : </span><?= $post['replies'] ?></li>
                        <li><span class="small-title">Interactions per 1000 followers : </span><?= $post['engagement'] ?></li>
                    </ul>
                    <a href="<?= $post['url'] ?>" target="_blank">View on Twitter</a>
                </div>
            </div>
        </div>
        <?php
    }
}else{ ?>
	<div class="waiting-text col-md-12""><p>You haven't posted anything within this month.</p></div>
<?php } ?>

    