<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="facebook">

            <tr>

                <th style="border-radius: 10px 0 0 0;">Metric</th>
                <?php
                foreach($comparison as $month){
                    //echo '<pre>'; var_dump($comparison); echo '</pre>'; die;
                    ?>
                    <th><?= $month['month'] ?></th>
                <?php } ?>
            </tr>

            <tr>

                <td colspan="<?= (count($comparison) + 1) ?>" class="second">Likes Overview</td>

            </tr>

            <tr>

                <td>New Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['newlikes'] ?></td>
                <?php } ?>
            </tr>

            <tr>

                <td>New Dislikes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['dislikes'] ?></td>
                <?php } ?>
            </tr>

            <tr>

                <td>Net Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['netlikes'] ?></td>
                <?php } ?>
            </tr>

            <tr>

                <td colspan="<?= (count($comparison) + 1) ?>" class="second">Interactions Overview</td>

            </tr>

            <tr>

                <td>Total Interactions</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= (($month['total']['likes']) + ($month['total']['comments']) + ($month['total']['shares'])) ?></td>
                <?php } ?>
            </tr>

            <tr>

                <td>Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['likes'] ?></td>
                <?php } ?>
            </tr>

            <tr>

                <td>Comments</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['comments'] ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Shares</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['shares'] ?></td>
                <?php } ?>
                
            </tr>

            <tr>

                <td colspan="<?= (count($comparison) + 1) ?>" class="second">Reach Overview</td>

            </tr>

            <tr>

                <td>Post Reach</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['post_reach'] ?></td>
                <?php } ?>
                
            </tr>

        </table>

        <?php
        if(count($comparison) > 6){ ?>
            <table class="facebook">

            <tr>

                <th style="border-radius: 10px 0 0 0;">Metric</th>

                <th colspan="<?= count($comparison) ?>">Paid</th>

            </tr>

            <tr>

                <th style=" border-right: .5px solid #b3b3b3; background: #adadad; color: #fff; font-size: 15px;">Time range</th>

                <?php
                foreach($comparison as $month){ ?>
                    <th style=" border-right: .5px solid #b3b3b3; background: #adadad; color: #fff; font-size: 15px;"><?= $month['month'] ?></th>
                <?php } ?>
            </tr>

            <tr>

                <td>New Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['paid']['newlikes'] ?></td>
                <?php } ?>
            </tr>

            <tr>

                <td>Post Reach</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['paid']['post_reach'] ?></td>
                <?php } ?>
            </tr>

        </table>
        <table class="facebook">

            <tr>

                <th style="border-radius: 10px 0 0 0;">Metric</th>

                <th colspan="<?= count($comparison) ?>">Unpaid</th>

            </tr>

            <tr>

                <th style=" border-right: .5px solid #b3b3b3; color: #fff; font-size: 15px;">Time range</th>

                <?php
                foreach($comparison as $month){ ?>
                    <th style=" border-right: .5px solid #b3b3b3; background: #adadad; color: #fff; font-size: 15px;"><?= $month['month'] ?></th>
                <?php }
                ?>
            </tr>

            <tr>

                <td>New Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['unpaid']['newlikes'] ?></td>
                <?php }
                ?>
            </tr>

            <tr>

                <td>Post Reach</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['unpaid']['post_reach'] ?></td>
                <?php } 
                ?>
            </tr>

        </table>
        <?php }else{
        ?>
        <table class="facebook">

            <tr>

                <th>Metric</th>

                <th colspan="<?= count($comparison) ?>">Paid</th>

                <th colspan="<?= count($comparison) ?>">Unpaid</th>

            </tr>

            <tr>

                <th style=" border-right: .5px solid #b3b3b3; background: #adadad; color: #fff; font-size: 15px;">Time range</th>

                <?php
                foreach($comparison as $month){ ?>
                    <th style=" border-right: .5px solid #b3b3b3; background: #adadad; color: #fff; font-size: 15px;"><?= $month['month'] ?></th>
                <?php } 
                foreach($comparison as $month){ ?>
                    <th style=" border-right: .5px solid #b3b3b3; background: #adadad; color: #fff; font-size: 15px;"><?= $month['month'] ?></th>
                <?php }
                ?>
            </tr>

            <tr>

                <td>New Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['paid']['newlikes'] ?></td>
                <?php } 
                foreach($comparison as $month){ ?>
                    <td><?= $month['unpaid']['newlikes'] ?></td>
                <?php }
                ?>
            </tr>

            <tr>

                <td>Post Reach</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['paid']['post_reach'] ?></td>
                <?php } 
                foreach($comparison as $month){ ?>
                    <td><?= $month['unpaid']['post_reach'] ?></td>
                <?php } 
                ?>
            </tr>

        </table>
        <?php } ?>
    </div>
</div>