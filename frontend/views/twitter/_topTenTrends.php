<?php
    if($top_ten_trends){ ?>
        <h3 class="internal-title noneBG" style="text-align:left">Top 10 Trends</h3>
        <div class="internal-content">
            <div class="row">
            <ul>
            <?php
            foreach($top_ten_trends as $trend){ ?>
                
                <li class="col-md-6 col-sm-6"><a href="<?= $trend['url'] ?>"><?= $trend['name'] ?></a></li>
            <?php    
            } ?>
            </ul>
            </div>
        </div>
        <?php
    }

    