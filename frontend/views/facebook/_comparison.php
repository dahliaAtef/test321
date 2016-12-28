<div class="row">
    <div class="col-md-12">        
        <h3 class="internal-title noneBG">Comparison</h3>

        <table class="facebook">

            <tr>

                <th>Metric</th>

                <th>Current Month</th>

                <th>Last Month</th>

            </tr>

            <tr>

                <td colspan="3">Likes Overview</td>

            </tr>

            <tr>

                <td>New Likes</td>

                <td><?= $comparison['this_month']['total']['newlikes'] ?></td>

                <td><?= $comparison['last_month']['total']['newlikes'] ?></td>

            </tr>

            <tr>

                <td>New Dislikes</td>

                <td><?= $comparison['this_month']['total']['dislikes'] ?></td>

                <td><?= $comparison['last_month']['total']['dislikes'] ?></td>

            </tr>

            <tr>

                <td>Net Likes</td>

                <td><?= $comparison['this_month']['total']['netlikes'] ?></td>

                <td><?= $comparison['last_month']['total']['netlikes'] ?></td>

            </tr>

            <tr>

                <td colspan="3">Interactions Overview</td>

            </tr>

            <tr>

                <td>Total Interactions</td>

                <td><?= (($comparison['this_month']['total']['likes']) + ($comparison['this_month']['total']['comments']) + ($comparison['this_month']['total']['shares'])) ?></td>

                <td><?= (($comparison['last_month']['total']['likes']) + ($comparison['last_month']['total']['comments']) + ($comparison['last_month']['total']['shares'])) ?></td>

            </tr>

            <tr>

                <td>Likes</td>

                <td><?= $comparison['this_month']['total']['likes'] ?></td>

                <td><?= $comparison['last_month']['total']['likes'] ?></td>

            </tr>

            <tr>

                <td>Comments</td>

                <td><?= $comparison['this_month']['total']['comments'] ?></td>

                <td><?= $comparison['last_month']['total']['comments'] ?></td>

            </tr>

            <tr>

                <td>Shares</td>

                <td><?= $comparison['this_month']['total']['shares'] ?></td>

                <td><?= $comparison['last_month']['total']['shares'] ?></td>

            </tr>

            <tr>

                <td colspan="3">Reach Overview</td>

            </tr>

            <tr>

                <td>Post Reach</td>

                <td><?= $comparison['this_month']['total']['post_reach'] ?></td>

                <td><?= $comparison['last_month']['total']['post_reach'] ?></td>

            </tr>

        </table>

        <table class="facebook">

            <tr>

                <th>Metric</th>

                <th colspan="2">Paid</th>

                <th colspan="2">Unpaid</th>

            </tr>

            <tr>

                <th class="second">Time range</th>

                <th class="second">Prev month</th>

                <th class="second">Current month</th>

                <th class="second">Prev month</th>

                <th class="second">Current month</th>

            </tr>

            <tr>

                <td>New Likes</td>

                <td><?= $comparison['last_month']['paid']['newlikes'] ?></td>

                <td><?= $comparison['this_month']['paid']['newlikes'] ?></td>

                <td><?= $comparison['last_month']['unpaid']['newlikes'] ?></td>

                <td><?= $comparison['this_month']['unpaid']['newlikes'] ?></td>

            </tr>

            <tr>

                <td>Post Reach</td>

                <td><?= $comparison['last_month']['paid']['post_reach'] ?></td>

                <td><?= $comparison['this_month']['paid']['post_reach'] ?></td>

                <td><?= $comparison['last_month']['unpaid']['post_reach'] ?></td>

                <td><?= $comparison['this_month']['unpaid']['post_reach'] ?></td>

            </tr>

        </table>
    </div>
</div>