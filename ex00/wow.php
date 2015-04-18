<html>
<head>
<link href="wow.css" rel="stylesheet">
</head>
<body>
<table>
<?php

	class Vaisseau {
		public $xmin = 1;
		public $ymin = 1;
		public $xmax = 4;
		public $ymax = 6;
		public $rotate = 0;
//		public $sprite = array('0' => img_1, '90' => );
	}
 
	if (!file_exists('bdd.bdd')) {
		$black_pearl = new Vaisseau;  
	}
	else
	{
		$black_pearl = unserialize(file_get_contents('bdd.bdd'));
	}

//	$img = (bp->rotat = 90) ? sprite['90'] : sprite['0'];
	$X = 12 * $black_pearl->xmin;
	$Y = 12 * $black_pearl->ymin;
	$SX = 12 * ($black_pearl->xmax - $black_pearl->xmin) - 1;
	$SY = 12 * ($black_pearl->ymax - $black_pearl->ymin) - 1;
//	echo $X." ".$Y. " ".$SX." ".$SY;
	echo '<img src="asteroidBig01.png" alt="asteroid" class="asteroid">';
	echo '<img src="vaisseau.png" style="-webkit-transform: rotate(' . $black_pearl->rotate . 'deg); left:'.$X.'px; top:'.$Y.'px; width:'.$SY.'px;height:'.$SX.'px;" alt="Vaisse11" class="vais">';
	echo '<img src="asteroidBig01.png" alt="asteroid" class="asteroid1">';
	echo '<img src="asteroidBig01.png" alt="asteroid" class="asteroid2">';
	echo '<img src="asteroidBig01.png" alt="asteroid" class="asteroid3">';
	$y = 0;
//	$ast = array();
//	$ast[] = [30,40,20,30];
//	$ast[] = [80,90,30,40];
//	$ast[] = [50,60,60,70];
//	$ast[] = [100,110,70,80];
//	$ast[] = [110,120,10,20];

	while ($y < 100)
	{
		echo '<tr>';
		$x = 0;
		while ($x < 150)
		{
			$i = 0;
//			foreach($ast as $a)
//			{
//				if ($x >= $a[0] && $x < $a[1] && $y >= $a[2] && $y < $a[3])
//				{
					
//					echo '<td class = "ast"></td>';	
//					$i = 1;
//				}
//			}
        echo '<td class = "black" ></td>';
		$x++;
		}
		echo '</tr>';
		$y++;

		
	}
	//echo $black_pearl->x;
	$black_pearl->xmin++;
	$black_pearl->xmax++;
	file_put_contents('bdd.bdd', serialize($black_pearl));
?>
</table>
</body>
</html>
