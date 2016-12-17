<div class="row">
    <div class="col-md-12">
        <h3 class="internal-title sec-title">Top 10 Posts</h3>
    </div>
</div>

    <?php
        if($top_posts){
            $top_ten_posts = array_slice($top_posts, 0, 10);
          ?>
          <div class="row" style="margin:0">
            <?php
            foreach($top_ten_posts as $post){
    ?> 
  
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="post-item">
            <div class="date-time">
                <span class="date"><span class="small-title">Date :  </span><?= date('d M, y', $post->creation_time) ?></span>
                <span class="time"><span class="small-title">Time :  </span><?= date('H:m:s', $post->creation_time) ?></span>
            </div>

            

            <div class="post-img"><img src="<?= (($post->media_url) ? $post->media_url : $post->getFeaturedImgUrl('top_posts')) ?>" alt=""/></div>
                <div class="internal-content">
                    <ul>
                        <li><a href="<?= $post->url ?>"><p class="special-title"><?= $post->content ?></p></a></li>

                        <li><span class="small-title">Total Interactions :  </span><?= $post->interactions ?></li>

                        <li><span class="small-title">Reactions :  </span><?= $post->reactions ?></li>

                        <li><span class="small-title">Comments :  </span><?= $post->comments ?></li>

                        <li><span class="small-title">Shares :  </span><?= $post->shares ?></li>

                        <li><span class="small-title">Interactions per 1000 Fans :  </span><?= (($post->followers) && ($post->followers != 0))? round(((($post->interactions)/($post->followers))* 1000), 2): '___' ?></li>
                    </ul>
                </div>
        </div>
    </div>
        <?php    
            }
          ?>
            </div>   
<?php
               }else{ ?>
        <div class="waiting-text col-md-12""><p>You haven't posted anything within this month.</p></div>
        <?php }
        ?>
     
