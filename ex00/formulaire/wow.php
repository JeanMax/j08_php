<html>
<body>
<head>
<link href="wow.css" rel="stylesheet">
</head><table style="height:100%;width:100%;">
#<table>
<?php
#	$a = $_GET['X'];
#	echo "<a>$a</a>";
	$y = 0;
	$ast = array();
	$ast[] = [30,40,20,30];
	$ast[] = [80,90,30,40];
	$ast[] = [50,60,60,70];
	$ast[] = [100,110,70,80];
	$ast[] = [110,120,10,20];
	

$bat = array('x' => 1, 'y' => 1);
print($bat['x']);

if ($_GET['X'] !== NULL && $_GET['Y'] !== NULL)
{
	$bat['x'] = $_GET['X'];
	$bat['y'] = $_GET['Y'];
}

	while ($y < 100)
	{
		echo '<tr>';
		$x = 0;
		while ($x < 150)
		{
			$i = 0;
			foreach($ast as $a)
			{
				if ($x >= $a[0] && $x < $a[1] && $y >= $a[2] && $y < $a[3])
				{
					
					echo '<td class = "ast"></td>';	
					$i = 1;
				}
			}
			if ($x == $bat['x'] && $y == $bat['y'] && $i != 1)
			{
				echo '<td class = "red" ><a href = "http://rush.local.42.fr:8080/wow.php?X='.$x.'&Y='.$y.'" ></a></td>';
			}
			else if (!$i)
            	echo '<td class = "black" ><a href = "http://rush.local.42.fr:8080/wow.php?X='.$x.'&Y='.$y.'" ></a></td>';
			$x++;
		}
		echo '</tr>';
		$y++;
	}

?>
</table>
</body>
</html>
