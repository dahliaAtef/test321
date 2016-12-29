<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG circleChart-title">Comparison</h3>

        <table class="youtube">

            <tr>

                <th>Metric</th>

                <th>Current Month</th>

                <th>Last Month</th>

            </tr>

            <tr>

                <td colspan="3">Subscribers Overview</td>

            </tr>

            <tr>

                <td>Gained Subscribers</td>

                <td><?= ($comparison['this_month']['gained_followers'] ? $comparison['this_month']['gained_followers'] : 0) ?></td>
				
				<td><?= ($comparison['last_month']['gained_followers'] ? $comparison['last_month']['gained_followers'] : 0) ?></td>

            </tr>
			
			<tr>

                <td>Lost Subscribers</td>

                <td><?= ($comparison['this_month']['lost_followers'] ? $comparison['this_month']['lost_followers'] : 0) ?></td>
				
				<td><?= ($comparison['last_month']['lost_followers'] ? $comparison['last_month']['lost_followers'] : 0) ?></td>

            </tr>
			
			<tr>

                <td>Net Subscribers</td>

                <td><?= ($comparison['this_month']['net_followers'] ? $comparison['this_month']['net_followers'] : 0) ?></td>
				
				<td><?= ($comparison['last_month']['net_followers'] ? $comparison['last_month']['net_followers'] : 0) ?></td>

            </tr>

            <tr>

                <td colspan="3">Interactions Overview</td>

            </tr>

            <tr>

                <td>Views</td>

                <td><?= ($comparison['this_month']['views'] ? $comparison['this_month']['views'] : 0) ?></td>

                <td><?= ($comparison['last_month']['views'] ? $comparison['last_month']['views'] : 0) ?></td>

            </tr>

            <tr>

                <td>Likes</td>

                <td><?= ($comparison['this_month']['likes'] ? $comparison['this_month']['likes'] : 0) ?></td>

                <td><?= ($comparison['last_month']['likes'] ? $comparison['last_month']['likes'] : 0) ?></td>

            </tr>

            <tr>

                <td>Dislikes</td>

                <td><?= ($comparison['this_month']['dislikes'] ? $comparison['this_month']['dislikes'] : 0) ?></td>

                <td><?= ($comparison['last_month']['dislikes'] ? $comparison['last_month']['dislikes'] : 0) ?></td>

            </tr>

            <tr>

                <td>Comments</td>

                <td><?= ($comparison['this_month']['comments'] ? $comparison['this_month']['comments'] : 0) ?></td>

                <td><?= ($comparison['last_month']['comments'] ? $comparison['last_month']['comments'] : 0) ?></td>

            </tr>

            <tr>

                <td>Shares</td>

                <td><?= ($comparison['this_month']['shares'] ? $comparison['this_month']['shares'] : 0) ?></td>

                <td><?= ($comparison['last_month']['shares'] ? $comparison['last_month']['shares'] : 0) ?></td>

            </tr>

        </table>

    </div>
</div>