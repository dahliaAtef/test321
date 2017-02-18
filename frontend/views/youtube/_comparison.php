<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="youtube">

            <tr>

                <th>Metric</th>
                <?php
                foreach($comparison as $month){
                    ?>
                    <th><?= $month['month'] ?></th>
                <?php } ?>
            </tr>

            <tr>

                <td colspan="12" class="second">Subscribers Overview</td>

            </tr>

            <tr>

                <td>Gained Subscribers</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['gained_followers'] ? $month['gained_followers'] : 0) ?></td>
                <?php } ?>
                    
            </tr>
			
            <tr>

                <td>Lost Subscribers</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['lost_followers'] ? $month['lost_followers'] : 0) ?></td>
                <?php } ?>
                    
            </tr>
			
            <tr>

                <td>Net Subscribers</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['net_followers'] ? $month['net_followers'] : 0) ?></td>
                <?php } ?>
                    
            </tr>

            <tr>

                <td colspan="12" class="second">Interactions Overview</td>

            </tr>

            <tr>

                <td>Views</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['views'] ? $month['views'] : 0) ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['likes'] ? $month['likes'] : 0) ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Dislikes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['dislikes'] ? $month['dislikes'] : 0) ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Comments</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['comments'] ? $month['comments'] : 0) ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Shares</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= ($month['shares'] ? $month['shares'] : 0) ?></td>
                <?php } ?>

            </tr>

        </table>

    </div>
</div>