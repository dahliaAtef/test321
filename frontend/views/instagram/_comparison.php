<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG">Comparison</h3>

        <table class="instagram">

            <tr>

                <th>Metric</th>

                <th>Current Month</th>

                <th>Last Month</th>

            </tr>

            <tr>

                <td colspan="3">Followers</td>

            </tr>

            <tr>

                <td>Followers</td>

                <td><?= $comparison['this_month']['followers'] ?></td>
				
                <td><?= $comparison['last_month']['followers'] ?></td>
              
            </tr>

            <tr>

                <td colspan="3">Interactions Overview</td>

            </tr>

            <tr>

                <td>Total Interactions</td>

                <td><?= $comparison['this_month']['interactions'] ?></td>

                <td><?= $comparison['last_month']['interactions'] ?></td>

            </tr>

            <tr>

                <td>Likes</td>

                <td><?= $comparison['this_month']['likes'] ?></td>

                <td><?= $comparison['last_month']['likes'] ?></td>

            </tr>

            <tr>

                <td>Comments</td>

                <td><?= $comparison['this_month']['comments'] ?></td>

                <td><?= $comparison['last_month']['comments'] ?></td>

            </tr>

            <tr>

                <td>Shares</td>

                <td><?= $comparison['this_month']['shares'] ?></td>

                <td><?= $comparison['last_month']['shares'] ?></td>

            </tr>

        </table>

    </div>
</div>