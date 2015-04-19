<html>
<head>
<link href="wow.css" rel="stylesheet">
     </head>

     <body>

	 <?php

require_once("Player.class.php");
require_once("Zone.class.php");
require_once("Laser.class.php");
require_once("Destroyer.class.php");
require_once("Vaisseau_mere.class.php");

function init()
{

	$s1 = New Vaisseau_mere();
	$s2 = New Destroyer();
	$s3 = New Vaisseau_mere();
	$s4 = New Destroyer();

/*	$s1->setXMin(100);
	$s1->setXMax(110);
	$s1->setYMin(80);
	$s1->setYMax(84);

	$s2->setXMin(30);
	$s2->setXMax(40);
	$s2->setYMin(60);
	$s2->setYMax(64);

	$s3->setXMin(60);
	$s3->setXMax(70);
	$s3->setYMin(20);
	$s3->setYMax(24);

    $s4->setXMin(40);
    $s4->setXMax(50);
	$s4->setYMin(20);
	$s4->setYMax(24);*/
    $s1->setXMin(142);
    $s1->setXMax(148);
    $s1->setYMin(95);
    $s1->setYMax(97);
    $s1->setActivated(true);
    $s1->setSprite("img/vaisseau_mereLEFT.png");

    $s2->setXMin(138);
    $s2->setXMax(148);
    $s2->setYMin(90);
    $s2->setYMax(92);
    $s2->setSprite("img/destroyerLEFT.png");


    $s3->setXMin(1);
    $s3->setXMax(7);
    $s3->setYMin(2);
    $s3->setYMax(4);



	$p1 = New player([$s1, $s2]);
	$p2 = New player([$s3, $s4]);

	$z = new zone(array("p1" => $p1,
						"p2" => $p2));


    //  echo "<pre>";
//	$s3->rotate("left", $z);
//	$s3->rotate("left", $z);
    $s3->shoot(array( 0 => array(0 => 3, 1 => 4, 2 => 5) ), $z);
    $s3->shoot(array( 0 => array(0 => 3, 1 => 4, 2 => 5) ), $z);
//    print_r($s3->move(10, $z));
//    $p2->isAlive();
//    $p1->isAlive();
//    print_r($p2);
//    echo "</pre>";
    $z->aff_map(1);

	//TODO: SAVE $z TO BDD
}

function gameLoop()
{
	while (42)
	{
		//TODO: LOAD $z FROM BDD
		if (!$p1->play()) //use html form instead (cf. form.html)
		{
			echo "p2 won";
			break ;
		}
		if (!$p2->isAlive())
		{
			echo "p1 won";
			break ;
		}
		//TODO: SAVE $z TO BDD

		//TODO: LOAD $z FROM BDD
		if (!$p2->play()) //use html form instead (cf. form.html)
		{
			echo "p1 won";
			break ;
		}
		if (!$p1->isAlive())
		{
			echo "p2 won";
			break ;
		}
		//TODO: SAVE $z TO BDD
	}
}

init();
gameLoop();
echo "game over";

?>

</body>
</html>
