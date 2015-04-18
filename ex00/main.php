<?php

require_once("Player.class.php");
require_once("Zone.class.php");
require_once("ExempleGun.class.php");
require_once("ExempleShip.class.php");

function init()
{
    $z = new zone(["3" => 2]);

	$g1 = New gun();
	$g2 = New gun();
	$g3 = New gun();
	$g4 = New gun();

	$s1 = New ship([$g1, $g2, $g3]);
	$s2 = New ship([$g1, $g2, $g3]);
	$s3 = New ship([$g2, $g3]);
	$s4 = New ship([$g1, $g3]);

	$p1 = New player([$s1, $s2]);
	$p2 = New player([$s3, $s4]);

}

function gameLoop()
{
	while (42)
	{
		if (!$p1->play())
		{
			echo "p2 won";
			break ;
		}
		if (!$p2->isAlive())
		{
			echo "p1 won";
			break ;
		}

		if (!$p2->play())
		{
			echo "p1 won";
			break ;
		}
		if (!$p1->isAlive())
		{
			echo "p2 won";
			break ;
		}
	}
}


init();
gameLoop();
echo "game over";

?>