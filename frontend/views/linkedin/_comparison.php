<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="linkeidn">

            <tr>

                <th>Metric</th>
                <?php
                foreach($comparison as $month){
                    ?>
                    <th><?= $month['month'] ?></th>
                <?php } ?>
            </tr>

            <tr>

                <td colspan="12">Connections Overview</td>

            </tr>

            <tr>

                <td>New Organic Connections</td>
                
                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['organic_followers'] ?></td>
                <?php } ?>

            </tr>
			
            <tr>

                <td>New Paid Connections</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['paid_followers'] ?></td>
                <?php } ?>
                    
            </tr>
			
            <tr>

                <td>Net New Connections</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['total_followers'] ?></td>
                <?php } ?>
                 
            </tr>

            <tr>

                <td colspan="12">Interactions Overview</td>

            </tr>

            <tr>

                <td>Clicks</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['statistics']['clicks'] ?></td>
                <?php } ?>
                 
            </tr>

            <tr>

                <td>Impressions</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['statistics']['impressions'] ?></td>
                <?php } ?>
                  
            </tr>

            <tr>

                <td>Likes</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['statistics']['likes'] ?></td>
                <?php } ?>
                  
            </tr>

            <tr>

                <td>Comments</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['statistics']['comments'] ?></td>
                <?php } ?>
                  
            </tr>

            <tr>

                <td>Shares</td>

                <?php
                foreach($comparison as $month){ ?>
                    <td><?= $month['statistics']['shares'] ?></td>
                <?php } ?>
                    
            </tr>

        </table>

    </div>
</div>