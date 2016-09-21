
<?php
if($top_posts_by_engagement){
    foreach($top_posts_by_engagement as $post){
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="post-img"><img src="<?= $post['media_url'] ?>"/></div>
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
        <?php
    }
}

    