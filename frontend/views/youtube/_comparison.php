<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG">Comparison</h3>

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

                <td><?= $comparison['this_month']['gained_followers'] ?></td>
				
				<td><?= $comparison['last_month']['gained_followers'] ?></td>

            </tr>
			
			<tr>

                <td>Lost Subscribers</td>

                <td><?= $comparison['this_month']['lost_followers'] ?></td>
				
				<td><?= $comparison['last_month']['lost_followers'] ?></td>

            </tr>
			
			<tr>

                <td>Net Subscribers</td>

                <td><?= $comparison['this_month']['net_followers'] ?></td>
				
				<td><?= $comparison['last_month']['net_followers'] ?></td>

            </tr>

            <tr>

                <td colspan="3">Interactions Overview</td>

            </tr>

            <tr>

                <td>Views</td>

                <td><?= $comparison['this_month']['views'] ?></td>

                <td><?= $comparison['last_month']['views'] ?></td>

            </tr>

            <tr>

                <td>Likes</td>

                <td><?= $comparison['this_month']['likes'] ?></td>

                <td><?= $comparison['last_month']['likes'] ?></td>

            </tr>

            <tr>

                <td>Dislikes</td>

                <td><?= $comparison['this_month']['dislikes'] ?></td>

                <td><?= $comparison['last_month']['dislikes'] ?></td>

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