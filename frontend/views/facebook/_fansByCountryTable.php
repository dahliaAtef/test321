        <table  class="facebook">

            <tr>

            <th>Country</th>

            <th>Local fans</th> 

            <th>Percentage of Fans Base</th>

            <th>Growth</th>

            <th>Percentage of Growth</th>

          </tr>

          

        <?php
		//echo '<pre>'; var_dump($fans_by_country_table); echo '</pre>'; die;
        foreach($fans_by_country_table as $country => $values){ ?>

            <tr>

            <td><?= $country ?></td>

            <td><?= $values['fans'] ?></td> 

            <td><?= round($values['percentage'], 2) ?></td>

            <td><?= $values['growth'] ?></td>

            <td><?= round($values['growth_percentage'], 2) ?></td>

          </tr>

        <?php }

        ?>

        </table>