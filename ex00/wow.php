<html>
    <head>
        <link href="wow.css" rel="stylesheet">
     </head>

    <body>
         <table>
<?php
     
$X = 12 * $ship->getXMin();
$Y = 12 * $ship->getYMin();
$SX = 12 * ($ship->getXMax() - $ship->getXMin()) - 1;
$SY = 12 * ($ship->getYMax() - $ship->getYMin()) - 1;

echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid">';
echo '<img src="img/vaisseau.png" style="left:'.$X.'px; top:'.$Y.'px; width:'.$SY.'px;height:'.$SX.'px;" alt="Vaisse11" class="vais">';
echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid1">';
echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid2">';
echo '<img src="img/asteroidBig01.png" alt="asteroid" class="asteroid3">';
$y = 0;

while ($y < 100)
{
	echo '<tr>';
	$x = 0;
	while ($x < 150)
	{
		echo '<td class = "black" ></td>';
		$x++;
	}
	echo '</tr>';
	$y++;

}

?>
        </table>
    </body>
</html>
