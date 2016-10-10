<div class="row">
    <div class="col-md-12">
        <h3 class="internal-title sec-title"><!--?= $page_name ?--> Top 10 Posts</h3>
    </div>
    <?php
        if($top_updates){
            $top_ten_updates = array_slice($top_updates, 0, 10);
            foreach($top_ten_updates as $update){
    ?> 
    
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="post-item">
            <div class="date-time">
                <span class="date"><span class="small-title">Date :  </span><?= date('d M, y', $update->creation_time) ?></span>
                <span class="time"><span class="small-title">Time :  </span><?= date('H:m:s', $update->creation_time) ?></span>
            </div>

            

            <div class="post-img"><img src="<?= (($update->media_url) ? $update->media_url : $update->getFeaturedImgUrl('top_posts')) ?>" alt=""/></div>
                <div class="internal-content">
                    <ul>
                        <li><a href="<?= $update->url ?>"><p class="special-title"><?= $update->content ?></p></a></li>

                        <li><span class="small-title">Likes :  </span><?= $updates_statistics[$update->entity_id]['likes'] ?></li>

                        <li><span class="small-title">Comments :  </span><?= $updates_statistics[$update->entity_id]['comments'] ?></li>

                        <li><span class="small-title">Shares :  </span><?= $updates_statistics[$update->entity_id]['shares'] ?></li>
                        
                        <li><span class="small-title">Clicks :  </span><?= $updates_statistics[$update->entity_id]['clicks'] ?></li>

                        <li><span class="small-title">Impressions :  </span><?= $updates_statistics[$update->entity_id]['impressions'] ?></li>
                    </ul>
                </div>
        </div>
    </div>
        <?php    
            }
               }
        ?>
</div>        
