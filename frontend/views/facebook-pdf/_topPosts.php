<?php
use yii\helpers\Url;
?>
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
  
    <div class="col-lg-3 col-md-4 col-sm-6" style="width:25%; float:left; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;">
        <div class="post-item" style="margin-bottom:60px; border-left:1px solid #ececec; border-right:1px solid #ececec; background-color:white;">
            <div class="date-time" style="padding:0 14px;">
                <span class="date"><span class="small-title">Date :  </span><?= date('d M, y', $post->creation_time) ?></span>
                <span class="time"><span class="small-title">Time :  </span><?= date('H:m:s', $post->creation_time) ?></span>
            </div>

            

            <div class="post-img" style="padding:14px;">
                <img src="<?= (($post->media_url) ? $post->media_url : (Url::to('@frontThemeUrl/images/twitter_posts_placeholder.png'))) ?>" alt="" style="width:100%; min-height:235px; vertical-align:middle; border:0;"/>
            </div>
                <div class="internal-content" style="padding: 0 14px; margin-bottom: 40px; text-align: center;">
                    <ul style="text-align: left !important; padding: 0; margin: 0;">
                        <li><a href="<?= $post->url ?>"><p class="special-title"><?= substr($post->content, 0, 90).' ...' ?></p></a></li>

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
     
