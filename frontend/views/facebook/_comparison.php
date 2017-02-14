<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="facebook">

            <tr>

                <th>Metric</th>
                <?php
                foreach($comparison as $month){
                    ?>
                    <th><?= $month['month'] ?></th>
                <?php } ?>
            </tr>

            <tr>

                <td colspan="12">Likes Overview</td>

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

                <td colspan="12">Interactions Overview</td>

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

                <td colspan="12">Reach Overview</td>

            </tr>

            <tr>

                <td>Post Reach</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total']['post_reach'] ?></td>
                <?php } ?>
                
            </tr>

        </table>

        <table class="facebook">

            <tr>

                <th>Metric</th>

                <th colspan="12">Paid</th>

                <th colspan="12">Unpaid</th>

            </tr>

            <tr>

                <th class="second">Time range</th>

                <?php
                foreach($comparison as $month){ ?>
                    <th class="second"><?= $month['month'] ?></th>
                <?php }
                foreach($comparison as $month){ ?>
                    <th class="second"><?= $month['month'] ?></th>
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
    </div>
</div>