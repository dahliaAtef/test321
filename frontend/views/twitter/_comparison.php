<?php
    rsort($comparison);
?>
<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="twitter">

            <tr>

                <th>Metric</th>
                <?php
                foreach($comparison as $month){
                    ?>
                    <th><?= $month['month'] ?></th>
                <?php } ?>
            </tr>

            <tr>

                <td colspan="12">Followers & Listing Overview</td>

            </tr>

            <tr>

                <td>Followers</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['followers'] ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Listing</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['listing'] ?></td>
                <?php } ?>

            </tr>
            <tr>

                <td colspan="12">Interactions Overview</td>

            </tr>

            <tr>

                <td>Total Interactions</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['interactions'] ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['likes'] ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Comments</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['comments'] ?></td>
                <?php } ?>

            </tr>

            <tr>

                <td>Shares</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['shares'] ?></td>
                <?php } ?>

            </tr>

        </table>

    </div>
</div>