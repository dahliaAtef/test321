<table>
    <tr>
    <th>City</th>
    <th>Color</th>
  </tr>
  
<?php
$counter = 0;
foreach($top_fifteen_cities as $city => $value){ ?>
    <tr>
    <td><?= $city ?></td>
    <td><?= $colors[$counter] ?></td>
  </tr>
<?php
    $counter++;
}
?>
</table>