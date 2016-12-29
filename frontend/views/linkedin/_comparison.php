<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="linkeidn">

            <tr>

                <th>Metric</th>

                <th>Current Month</th>

                <th>Last Month</th>

            </tr>

            <tr>

                <td colspan="3">Connections Overview</td>

            </tr>

            <tr>

                <td>New Organic Connections</td>

                <td><?= $comparison['this_month']['organic_followers'] ?></td>
				
				<td><?= $comparison['last_month']['organic_followers'] ?></td>

            </tr>
			
			<tr>

                <td>New Paid Connections</td>

                <td><?= $comparison['this_month']['paid_followers'] ?></td>
				
				<td><?= $comparison['last_month']['paid_followers'] ?></td>

            </tr>
			
			<tr>

                <td>Net New Connections</td>

                <td><?= $comparison['this_month']['total_followers'] ?></td>
				
				<td><?= $comparison['last_month']['total_followers'] ?></td>

            </tr>

            <tr>

                <td colspan="3">Interactions Overview</td>

            </tr>

            <tr>

                <td>Clicks</td>

                <td><?= $comparison['this_month']['clicks'] ?></td>

                <td><?= $comparison['last_month']['clicks'] ?></td>

            </tr>

            <tr>

                <td>Impressions</td>

                <td><?= $comparison['this_month']['impressions'] ?></td>

                <td><?= $comparison['last_month']['impressions'] ?></td>

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